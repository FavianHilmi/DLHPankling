<?php

namespace App\Http\Controllers;

use App\Models\DataPassive;
use App\Models\DataKawasan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataPassiveRequest;

class DataPassiveController extends Controller
{
    // Tampilkan daftar data
    public function index()
    {
        $data_passives = DataPassive::all();
        return view('data_passive_sample', compact('data_passives'));
    }

    // Show form untuk buat data baru
    public function create()
    {
        $data_kawasans = DataKawasan::all();
        // dd($data_kawasans); // Debugging
        return view('form_data_passive', compact('data_kawasans'));
    }

    // Simpan data
    public function store(DataPassiveRequest $request)
    {
        $dataPassive = new DataPassive($request->validated());
        $dataPassive->status = 'Sedang Diajukan';
        $dataPassive->user_id = Auth::id();
        $dataPassive->save();

        return redirect()->route('data_passive.index')->with('success', 'Data berhasil disimpan!');
    }
    public function approve($id)
    {
        $data = DataPassive::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('data_passive.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = DataPassive::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('data_passive.index')->with('success', 'Data perlu revisi.');
    }
    // Show detail data
    public function show(DataPassive $dataPassive)
    {
        return view('data_passive.show', compact('dataPassive'));
    }

    // Show form untuk mengedit data
    public function edit($id)
    {
        $dataPassive = DataPassive::findOrFail($id);
        $data_kawasans = DataKawasan::all();
        return view('edit_data_passive', compact('dataPassive', 'data_kawasans'));
    }

    // Update data
    public function update(DataPassiveRequest $request, DataPassive $dataPassive)
    {
        $dataPassive->update($request->validated());
        return redirect()->route('data_passive.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(DataPassive $dataPassive)
    {
        $dataPassive->delete();
        return redirect()->route('data_passive.index')->with('success', 'Data berhasil dihapus.');
    }
}
