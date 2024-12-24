<?php

namespace App\Http\Controllers;

use App\Models\DataSPKUA;  // Make sure this is the correct model for your data_spkuas table
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // Query the data_spkuas table for the necessary columns
    //     $data = DataSPKUA::select('PM10', 'PM2_5', 'tanggal')
    //         ->orderBy('tanggal', 'asc')
    //         ->get();

    //     // Extract data into arrays for use in the chart
    //     // $TPM = $data->pluck('TPM')->toArray();
    //     $PM10 = $data->pluck('PM10')->toArray();
    //     $PM2_5 = $data->pluck('PM2_5')->toArray();
    //     $labels = $data->pluck('tanggal')->toArray();

    //     // Send data to the view
    //     return view('dashboard', [
    //         'PM10' => json_encode($PM10),
    //         'PM2_5' => json_encode($PM2_5),
    //         'labels' => json_encode($labels),
    //     ]);
    // }

    public function generateChart()
    {
        // Path to the Python script
        $pythonScript = base_path('python-scripts/prediksi.py');

        // Execute the Python script
        $output = shell_exec("python3 $pythonScript");

        // Return a view with the generated chart image
        return view('dashboard', ['chartImage' => asset('air_quality_chart.png')]);
    }
}
