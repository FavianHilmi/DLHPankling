<?php

namespace App\Http\Controllers;

use App\Models\DataBeritaAcara;
use App\Models\DataPenguji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataBeritaAcaraRequest;
use App\Http\Requests\DataPengujiRequest;
use PDF;
use Illuminate\Support\Facades\Log;

class DataBeritaAcaraController extends Controller
{

    public function download(Request $request)
    {
        $id = $request->input('id');
        $berita = DataBeritaAcara::findOrFail($id);

        Log::info('Path to PDF:', ['path' => storage_path('app/public/pdfs/' . $berita->pdf_file)]);

        $pathToFile = storage_path('app/public/pdfs/' . $berita->pdf_file);

        if (!file_exists($pathToFile)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->file($pathToFile);
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
        // dd($validated);
        // dd($request->all());
        // Validasi request
        $validated = $request->validate([
            'judul' => 'required|string',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'nama_kolom_penguji' => 'required|string',
            'penguji.*.nama_penguji' => 'required|string',
            'penguji.*.instansi' => 'required|string',
            'penguji.*.ttd' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berita = DataBeritaAcara::create([
            'judul' => $validated['judul'],
            'tanggal' => $validated['tanggal'],
            'deskripsi' => $validated['deskripsi'],
            'nama_kolom_penguji' => $validated['nama_kolom_penguji'],
            'status' => 'Sedang Diajukan',
            'user_id' => auth()->user()->id,
        ]);


        foreach ($validated['penguji'] as $pengujiData) {
            $filePath = isset($pengujiData['ttd'])
                ? $pengujiData['ttd']->store('ttd', 'public')
                : null;

            DataPenguji::create([
                'nama_kolom_penguji' => $berita->nama_kolom_penguji,
                'nama_penguji' => $pengujiData['nama_penguji'],
                'instansi' => $pengujiData['instansi'],
                // 'ttd' => isset($pengujiData['ttd']) ? $pengujiData['ttd']->store('ttd', 'public') : null,
                'ttd' => $filePath,
                'berita_id' => $berita->id,
            ]);




        }


        return redirect()->route('berita_acara.index')->with('success', 'Berita acara dan penguji berhasil disimpan.');
    }



    public function edit($id)
    {
        $beritaAcara = DataBeritaAcara::findOrFail($id);
        return view('edit_berita_acara', compact('beritaAcara'));
    }

    public function update(DataBeritaAcaraRequest $request, $id)
{
    $validatedData = $request->validated();
    $beritaAcara = DataBeritaAcara::findOrFail($id);
    $beritaAcara->update($validatedData);

    // Delete all previous penguji data (this ensures no old records are left)
    $beritaAcara->penguji()->delete();

    // To handle the uploaded files for each penguji (if any)
    $uploadedFiles = [];
    foreach ($request->penguji as $key => $penguji) {
        if (isset($penguji['ttd']) && is_file($penguji['ttd'])) {
            $file = $penguji['ttd'];
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('ttd', $filename, 'public');
            $uploadedFiles[$key] = $path; // Store file path
        }
    }

    // Now process the penguji data (adding new penguji or updating them)
    foreach ($request->penguji as $key => $penguji) {
        // Add new penguji after deleting old data
        $beritaAcara->penguji()->create([
            'nama_penguji' => $penguji['nama_penguji'],
            'instansi' => $penguji['instansi'],
            'ttd' => $uploadedFiles[$key] ?? null, // Save file if uploaded
        ]);
    }

    return redirect()->route('berita_acara.index')->with('success', 'Data berhasil diperbarui.');
}




    public function approve($id)
    {
        $data = DataBeritaAcara::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('berita_acara.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = DataBeritaAcara::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('berita_acara.index')->with('success', 'Data perlu revisi.');
    }


    public function destroy($id)
    {
        $berita = DataBeritaAcara::findOrFail($id);
        $berita->delete();
        return redirect()->route('berita_acara.index')->with('success', 'Berita Acara deleted successfully.');
    }


}
