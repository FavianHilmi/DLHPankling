<?php

namespace App\Http\Controllers;

use App\Models\UjiAirInternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UjiAirInternalRequest;

class UjiAirInternalController extends Controller
{
    // Tampilkan daftar data
    public function index()
    {
        $uji_air_internals = UjiAirInternal::all();
        return view('uji_air_internal', compact('uji_air_internals'));
    }

    // Show form untuk buat data baru
    public function create()
    {
        // $uji_air_internal = UjiAirInternal::all();
        return view('form_uji_air_internal');
    }

    // Simpan data
    public function store(UjiAirInternalRequest $request)
    {
    $ujiAirInternal = new UjiAirInternal($request->validated());
    $ujiAirInternal->status = 'Sedang Diajukan';
    $ujiAirInternal->user_id = Auth::id();
    $ujiAirInternal->save();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil disimpan!');
    }

    public function approve($id)
    {
        $data = UjiAirInternal::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = UjiAirInternal::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data perlu revisi.');
    }

    // Show detail data
    public function show(UjiAirInternal $ujiAirInternal)
    {
        return view('uji_air_internal.show', compact('ujiAirInternal'));
    }

    // Show form untuk mengedit data
    public function edit($id)
    {
        $ujiAirInternal = UjiAirInternal::findOrFail($id);
        // $data_kawasans = DataKawasan::all();
        return view('edit_uji_air_internal', compact('ujiAirInternal'));
    }

    // Update data
    public function update(UjiAirInternalRequest $request, $id)
    {
        $ujiAirInternal = UjiAirInternal::findOrFail($id);
        $ujiAirInternal->update($request->validated());
        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $ujiAirInternal = UjiAirInternal::findOrFail($id);
        $ujiAirInternal->delete();
        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil dihapus.');
    }
}
