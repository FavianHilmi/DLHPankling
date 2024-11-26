<?php

namespace App\Http\Controllers;

use App\Models\DataKawasan;
use Illuminate\Http\Request;

class DataKawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_kawasans = DataKawasan::all(); // Assuming Kawasan is your model
        return view('form_data_passive', compact('data_kawasans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataKawasan $dataKawasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataKawasan $dataKawasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataKawasan $dataKawasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataKawasan $dataKawasan)
    {
        //
    }
}
