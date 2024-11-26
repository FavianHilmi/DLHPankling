<?php

namespace App\Http\Controllers;

use App\Models\DataSPKUA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataSPKUARequest;

class DataSPKUAController extends Controller
{
    // Tampilkan daftar data
    public function index()
    {
        $data_spkuas = DataSPKUA::all();
        return view('data_spkua', compact('data_spkuas'));
    }

    // Show form untuk buat data baru
    public function create()
    {
        return view('form_data_spkua');
    }

    // Simpan data
    public function store(DataSPKUARequest $request)
    {
    $DataSPKUA = new DataSPKUA($request->validated());
    $DataSPKUA->status = 'Sedang Diajukan';
    $DataSPKUA->user_id = Auth::id();
    $DataSPKUA->save();

        return redirect()->route('data_spkua.index')->with('success', 'Data berhasil disimpan!');
    }

    public function approve($id)
    {
        $data = DataSPKUA::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('data_spkua.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = DataSPKUA::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('data_spkua.index')->with('success', 'Data perlu revisi.');
    }

    // Show detail data
    public function show(DataSPKUA $DataSPKUA)
    {
        return view('data_spkua.show', compact('DataSPKUA'));
    }

    // Show form untuk mengedit data
    public function edit($id)
    {
        $DataSPKUA = DataSPKUA::findOrFail($id);
        // $data_kawasans = DataKawasan::all();
        return view('edit_data_spkua', compact('DataSPKUA'));
    }

    // Update data
    public function update(DataSPKUARequest $request, $id)
    {
        $DataSPKUA = DataSPKUA::findOrFail($id);
        $DataSPKUA->update($request->validated());
        return redirect()->route('data_spkua.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $DataSPKUA = DataSPKUA::findOrFail($id);
        $DataSPKUA->delete();
        return redirect()->route('data_spkua.index')->with('success', 'Data berhasil dihapus.');
    }
}
