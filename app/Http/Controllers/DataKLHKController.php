<?php

namespace App\Http\Controllers;

use App\Models\DataKLHK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataKLHKRequest;

class DataKLHKController extends Controller
{
    public function index()
    {
        $data_klhks = DataKLHK::with('user')->get();
        // $data_partikulats = DataPartikulat::all();
        return view('data_klhk', compact('data_klhks'));
    }

    public function create()
    {
        return view('form_data_klhk');
    }

    public function store(DataKLHKRequest $request)
    {
        // Simpan data baru
        $dataKlhk = new DataKLHK($request->validated());
        $dataKlhk->status = 'Sedang Diajukan';
        $dataKlhk->user_id = Auth::id();
        $dataKlhk->save();
        return redirect()->route('data_klhk.index')->with('success', 'Data berhasil disimpan!');
    }

    public function verify($id)
    {
        $dataKlhk = DataKLHK::findOrFail($id);
        $dataKlhk->status = 'Terverifikasi';
        $dataKlhk->save();

        return redirect()->route('data_klhk.index')->with('success', 'Data berhasil diverifikasi.');
    }

    public function approve($id)
    {
        $data = DataKLHK::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('data_klhk.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = DataKLHK::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('data_klhk.index')->with('success', 'Data perlu revisi.');
    }

    public function show(DataKLHK $dataKlhk)
    {
        return view('data_klhk.show', compact('dataKlhk'));
    }

    public function edit($id)
    {
        $dataKlhk = DataKLHK::findOrFail($id);
        return view('edit_data_klhk', compact('dataKlhk'));
    }

    public function update(DataKLHKRequest $request, $id)
    {
        // $validatedData = $request->validated();
        $dataKlhk = DataKLHK::findOrFail($id);
        $dataKlhk->update($request->validated());
        return redirect()->route('data_klhk.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dataKlhk = DataKLHK::findOrFail($id);
        $dataKlhk->delete();
        return redirect()->route('data_klhk.index')->with('success', 'Data berhasil dihapus.');
    }
}
