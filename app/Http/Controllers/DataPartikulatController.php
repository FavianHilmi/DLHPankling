<?php

namespace App\Http\Controllers;

use App\Models\DataPartikulat;
use App\Models\DataKawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataPartikulatRequest;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DataPartikulatController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tahun' => 'nullable|digits:4|numeric|min:2000|max:' . date('Y'),
            'nama_lokasi' => 'nullable|string|max:255',
        ]);

        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        $tahun = $request->get('tahun');
        $nama_lokasi = $request->get('nama_lokasi');

        $data_partikulats = DataPartikulat::with('user')
            ->when($tahun, function ($query) use ($tahun) {
                return $query->where('tahun', $tahun);
            })
            ->when($nama_lokasi, function ($query) use ($nama_lokasi) {
                return $query->where('nama_lokasi', 'like', '%' . $nama_lokasi . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(50);

        return view('data_partikulat', compact('data_partikulats'));
    }



    // public function index(Request $request)
    // {

    //     $request->validate([
    //         'tahun' => 'nullable|digits:4|numeric|min:2000|max:' . date('Y'),
    //         'lokasi' => 'nullable|string|max:255',
    //     ]);

    //     $sortBy = $request->get('sort_by', 'id');
    //     $sortOrder = $request->get('sort_order', 'asc');
    //     $tahun = $request->get('tahun');

    //     $data_spkuas = DataPartikulat::with('user')
    //         ->when($request->lokasi, function ($query) use ($request) {
    //             return $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
    //         })
    //         ->when($tahun, function ($query) use ($tahun) {
    //             return $query->whereYear('tanggal', $tahun);
    //         })
    //         ->orderBy($sortBy, $sortOrder)
    //         ->paginate(50);

    //     return view('data_partikulat', compact('data_partikulats'));
    // }


    // public function __invoke()
    // {
    //     $path = storage_path('app/templates/data_partikulat_entry_form.xlsx');

    //     if (Storage::exists('templates/data_partikulat_entry_form.xlsx')) {
    //         // Mengembalikan response untuk mendownload file
    //         return response()->download($path, 'data_partikulat_entry_form.xlsx');
    //     }

    //     abort(404, 'File not found');
    // }

    public function create()
    {
        $data_kawasans = DataKawasan::all();
        return view('form_data_partikulat', compact('data_kawasans'));
    }

    public function store(DataPartikulatRequest $request)
    {
        // Simpan data baru
        // dd($request)->all();
        // dd($request->all());
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
        $data_kawasans = DataKawasan::all();
        return view('edit_data_partikulat', compact('dataPartikulat', 'data_kawasans'));
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

    public function import(Request $request)
    {
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return back()->with('error', 'File tidak valid!');
        }

        $extension = $request->file('file')->getClientOriginalExtension();
        if (!in_array($extension, ['xls', 'xlsx'])) {
            return back()->with('error', 'File harus berupa Excel dengan ekstensi .xls atau .xlsx!');
        }

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $worksheet = $spreadsheet->getSheetByName('Sheet1');

        if (!$worksheet) {
            return back()->with('error', 'Data Gagal Ditambahkan, "Sheet1" tidak ditemukan!');
        }

        $rows = $worksheet->toArray();
        $data = [];
        $errors = [];

        foreach ($rows as $index => $row) {
            if ($index == 0)
                continue;

            if (empty(array_filter($row))) {
                continue;
            }



            $data[] = [

                'nama_lokasi' => $row[1],
                'longitude' => $row[2] ?? null,
                'latitude' => $row[3] ?? null,
                'tahun' => $row[4],
                'TPM' => $row[5],
                'PM10' => $row[6],
                'PM2_5' => $row[7],
                'kawasan_id' => $row[8],
                'user_id' => Auth::id(),
                'status' => 'Sedang Diajukan',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            DataPartikulat::insert($data);
        }

        if (!empty($errors)) {
            return back()->with('error', 'Beberapa baris gagal diunggah: ' . implode(', ', $errors));
        }

        return redirect()->route('data_partikulat.index')->with('success', 'Data berhasil diunggah!');
    }
    public function downloadTemplate()
    {
        $filePath = 'templates/data_partikulat_entry_form.xlsx';
        if (Storage::exists($filePath)) {
            return response()->download(storage_path('app/' . $filePath), 'data_partikulat_entry_form.xlsx');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
