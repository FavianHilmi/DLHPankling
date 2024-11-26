<?php

namespace App\Http\Controllers;

use App\Models\DataPartikulat;
use Illuminate\Http\Request;
use App\Http\Requests\DataPartikulatRequest;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari tabel 'data_partikulats'
        $data = DataPartikulat::select('TPM', 'PM10', 'PM2_5', 'tanggal')
                              ->orderBy('tahun', 'asc')  // Mengurutkan berdasarkan tanggal
                              ->get();

        // Menyiapkan array untuk grafik
        $TPM = $data->pluck('TPM')->toArray();
        $PM10 = $data->pluck('PM10')->toArray();
        $PM2_5 = $data->pluck('PM2_5')->toArray();
        $labels = $data->pluck('tahun')->map(function($date) {
            return $date->format('Y-m-d'); // Format tanggal sesuai kebutuhan (misal Y-m-d)
        })->toArray();

        // Mengirim data ke view
        return view('dashboard', compact('TPM', 'PM10', 'PM2_5', 'labels'));
    }




}
