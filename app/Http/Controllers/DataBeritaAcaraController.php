<?php

namespace App\Http\Controllers;

use App\Models\DataBeritaAcara;
use App\Models\DataPenguji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataBeritaAcaraRequest;
use App\Http\Requests\DataPengujiRequest;
use PDF;

class DataBeritaAcaraController extends Controller
{

    public function download(Request $request)
    {
        $id = $request->input('id');
        $berita = DataBeritaAcara::findOrFail($id);

        // Log untuk memeriksa file path
        \Log::info('Path to PDF:', ['path' => storage_path('app/public/pdfs/' . $berita->pdf_file)]);

        $pathToFile = storage_path('app/public/pdfs/' . $berita->pdf_file);

        if (!file_exists($pathToFile)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->file($pathToFile); // This will return the file to the browser
    }



    public function index()
    {
        $beritas = DataBeritaAcara::with('user')->get();
        return view('berita_acara', compact('beritas'));
    }


    public function create()
    {
        return view('form_berita_acara');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'nama_kolom_penguji' => 'required|string',
            'nama_penguji' => 'required|array',
            'nama_penguji.*' => 'required|string',
            'asal_instansi.*' => 'required|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Simpan data
        $beritaAcara = DataBeritaAcara::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'nama_kolom_penguji' => $request->nama_kolom_penguji,
            'user_id' => Auth::id(),
            'status' => 'Sedang Diajukan',
        ]);

        // Simpan file
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $path = $file->store('public/pdf');
            $beritaAcara->update(['pdf_file' => $path]);
        }

        // Simpan data penguji (looping karena array)
        foreach ($request->nama_penguji as $key => $namaPenguji) {
            $beritaAcara->penguji()->create([
                'nama_penguji' => $namaPenguji,
                'instansi' => $request->asal_instansi[$key],
                'ttd' => null, // Tambahkan logika untuk upload TTD jika diperlukan
            ]);
        }

        return redirect()->route('berita_acara.index')->with('success', 'Data berhasil disimpan.');
    }



    public function edit($id)
    {
        // Ambil berita acara berdasarkan ID
        $beritaAcara = DataBeritaAcara::findOrFail($id);
        return view('berita_acara', compact('beritaAcara'));
    }


    public function update(DataBeritaAcaraRequest $request, $id)
    {
        $validatedData = $request->validated();
        $beritaAcara = DataBeritaAcara::findOrFail($id);
        $beritaAcara->update($validatedData);
        return redirect()->route('berita_acara.index')->with('success', 'Data berhasil diperbarui.');

    }




    public function destroy($id)
    {
        $berita = DataBeritaAcara::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara deleted successfully.');
    }


}
