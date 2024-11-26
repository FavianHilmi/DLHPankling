<?php

namespace App\Http\Controllers;

use App\Models\DataPartikulat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataPartikulatRequest;

class DataPartikulatController extends Controller
{
    public function index()
    {
        $data_partikulats = DataPartikulat::with('user')->get();
        // $data_partikulats = DataPartikulat::all();
        return view('data_partikulat', compact('data_partikulats'));
    }

    public function create()
    {
        return view('form_data_partikulat');
    }

    public function store(DataPartikulatRequest $request)
    {
        // Simpan data baru
        $dataPartikulat = new DataPartikulat($request->validated());
        $dataPartikulat->status = 'Sedang Diajukan';
        $dataPartikulat->user_id = Auth::id();
        $dataPartikulat->save();
        return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil disimpan!');
    }

    public function verify($id)
    {
        $dataPartikulat = DataPartikulat::findOrFail($id);
        $dataPartikulat->status = 'Terverifikasi';
        $dataPartikulat->save();

        return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil diverifikasi.');
    }

    // public function batchApprove(Request $request)
    // {
    //     $selectedIds = $request->input('selected_ids');
    //     if ($selectedIds) {
    //         DataPartikulat::whereIn('id', $selectedIds)->update(['status' => 'Terverifikasi']);
    //         return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil disetujui.');
    //     }
    //     return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    // }

    public function approve($id)
    {
        $data = DataPartikulat::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = DataPartikulat::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('data_partikulat.index')->with('success', 'Data perlu revisi.');
    }


    public function showDashboard()
    {
        // Ambil data dari tabel 'data_partikulats'
        $data = DataPartikulat::select('TPM', 'PM10', 'PM2_5', 'tanggal')
            ->orderBy('tanggal', 'asc')  // Mengurutkan berdasarkan tanggal
            ->get();

        // Menyiapkan array untuk grafik
        $TPM = $data->pluck('TPM')->toArray();
        $PM10 = $data->pluck('PM10')->toArray();
        $PM2_5 = $data->pluck('PM2_5')->toArray();
        $labels = $data->pluck('tanggal')->map(function ($date) {
            return $date->format('Y-m-d'); // Format tanggal sesuai kebutuhan (misal Y-m-d)
        })->toArray();

        // Tambahkan ini untuk melihat data yang dikirim
        dd($TPM, $PM10, $PM2_5, $labels);

        return view('dashboard', compact('TPM', 'PM10', 'PM2_5', 'labels'));
    }

    public function show(DataPartikulat $dataPartikulat)
    {
        return view('data_partikulat.show', compact('dataPartikulat'));
    }

    public function edit($id)
    {
        $dataPartikulat = DataPartikulat::findOrFail($id);
        return view('edit_data_partikulat', compact('dataPartikulat'));
    }

    public function update(DataPartikulatRequest $request, $id)
    {
        // $validatedData = $request->validated();
        $dataPartikulat = DataPartikulat::findOrFail($id);
        $dataPartikulat->update($request->validated());
        return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dataPartikulat = DataPartikulat::findOrFail($id);
        $dataPartikulat->delete();
        return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil dihapus.');
    }
}
