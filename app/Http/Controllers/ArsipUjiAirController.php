<?php

namespace App\Http\Controllers;

use App\Models\ArsipUjiAir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArsipUjiAirRequest;

class ArsipUjiAirController extends Controller
{
    public function index()
    {
        $arsip_data_air_internals = ArsipUjiAir::with('user')->get();
        // $data_partikulats = ArsipUjiAir::all();
        return view('arsip_uji_air', compact('arsip_data_air_internals'));
    }

    public function create()
    {
        return view('form_arsip_uji_air');
    }
    public function approve($id)
    {
        $data = ArsipUjiAir::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = ArsipUjiAir::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data perlu revisi.');
    }
    public function store(ArsipUjiAirRequest $request)
    {
        // dd($request->all());
        // Simpan data baru
        $arsipUjiAir = new ArsipUjiAir($request->validated());
        $arsipUjiAir->status = 'Sedang Diajukan';
        $arsipUjiAir->user_id = Auth::id();
        $arsipUjiAir->save();
        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil disimpan!');
    }

    public function verify($id)
    {
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        $arsipUjiAir->status = 'Terverifikasi';
        $arsipUjiAir->save();

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil diverifikasi.');
    }

    public function batchApprove(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        if ($selectedIds) {
            ArsipUjiAir::whereIn('id', $selectedIds)->update(['status' => 'Terverifikasi']);
            return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil disetujui.');
        }
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }

    public function show(ArsipUjiAir $arsipUjiAir)
    {
        return view('arsip_uji_air.show', compact('arsip_uji_air'));
    }

    public function edit($id)
    {
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        return view('edit_arsip_uji_air', compact('arsipUjiAir'));
    }

    public function update(ArsipUjiAirRequest $request, $id)
    {
        // $validatedData = $request->validated();
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        $arsipUjiAir->update($request->validated());
        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        $arsipUjiAir->delete();
        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil dihapus.');
    }
}
