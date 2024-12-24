<?php

namespace App\Http\Controllers;

use App\Models\DataKawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataKawasanRequest;

class DataKawasanController extends Controller
{
    public function index()
    {
        $data_kawasans = DataKawasan::all();
        return view('data_kawasan.index', compact('data_kawasans'));
    }

    public function create()
    {
        return view('data_kawasan.create');
    }

    public function store(DataKawasanRequest $request)
    {
        DataKawasan::create($request->validated());
        return redirect()->route('data_kawasan.index')->with('success', 'Data Kawasan berhasil disimpan.');
    }

    public function edit(DataKawasan $dataKawasan)
    {
        return view('data_kawasan.edit', compact('dataKawasan'));
    }

    public function update(DataKawasanRequest $request, DataKawasan $dataKawasan)
    {
        $dataKawasan->update($request->validated());
        return redirect()->route('data_kawasan.index')->with('success', 'Data Kawasan berhasil diperbarui.');
    }

    public function destroy(DataKawasan $dataKawasan)
    {
        $dataKawasan->delete();
        return redirect()->route('data_kawasan.index')->with('success', 'Data Kawasan berhasil dihapus.');
    }
}
