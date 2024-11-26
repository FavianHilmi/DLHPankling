<?php

namespace App\Http\Controllers;

use App\Models\UjiAirEksternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UjiAirEksternalRequest;

class UjiAirEksternalController extends Controller
{
    // Tampilkan daftar data
    public function index()
    {
        $uji_air_eksternals = UjiAirEksternal::all();
        return view('uji_air_eksternal', compact('uji_air_eksternals'));
    }

    // Show form untuk buat data baru
    public function create()
    {
        // $uji_air_internal = UjiAirEksternal::all();
        return view('form_uji_air_eksternal');
    }

    // Simpan data
    public function store(UjiAirEksternalRequest $request)
    {
    $ujiAirEksternal = new UjiAirEksternal($request->validated());
    $ujiAirEksternal->status = 'Sedang Diajukan';
    $ujiAirEksternal->user_id = Auth::id();
    $ujiAirEksternal->save();

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil disimpan!');
    }

    public function approve($id)
    {
        $data = UjiAirEksternal::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = UjiAirEksternal::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data perlu revisi.');
    }

    // Show detail data
    public function show(UjiAirEksternal $ujiAirEksternal)
    {
        return view('uji_air_eksternal.show', compact('ujiAirEksternal'));
    }

    // Show form untuk mengedit data
    public function edit($id)
    {
        $ujiAirEksternal = UjiAirEksternal::findOrFail($id);
        // $data_kawasans = DataKawasan::all();
        return view('edit_uji_air_eksternal', compact('ujiAirEksternal'));
    }

    // Update data
    public function update(UjiAirEksternalRequest $request, $id)
    {
        $ujiAirEksternal = UjiAirEksternal::findOrFail($id);
        $ujiAirEksternal->update($request->validated());
        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $ujiAirEksternal = UjiAirEksternal::findOrFail($id);
        $ujiAirEksternal->delete();
        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil dihapus.');
    }
}
