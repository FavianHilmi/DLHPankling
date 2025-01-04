<?php

namespace App\Http\Controllers;

use App\Models\DataKLHK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataKLHKRequest;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

class DataKLHKController extends Controller
{
    // public function index()
    // {
    //     $data_klhks = DataKLHK::with('user')->get();
    //     // $data_partikulats = DataPartikulat::all();
    //     return view('data_klhk', compact('data_klhks'));
    // }
    public function index(Request $request)
    {
        $request->validate([
            'bulan' => 'nullable|digits:2|numeric|min:1|max:12',
            'tahun' => 'nullable|digits:4|numeric|min:2000|max:' . date('Y'),
        ]);

        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        $data_klhks = DataKLHK::with('user')
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tanggal', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal', $tahun);
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(50);

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

    // form import
    public function showImportForm()
    {
        return view('import_data_klhk');
    }

    // proses import data dari Excel
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

            $tanggal = \DateTime::createFromFormat('m/d/Y', $row[0]) ?: \DateTime::createFromFormat('d/m/Y', $row[0]);
            $formattedTanggal = $tanggal ? $tanggal->format('Y-m-d') : null;

            if (!$formattedTanggal) {
                $errors[] = "Baris " . ($index + 1) . ": Tanggal tidak valid.";
                continue;
            }

            if (!is_numeric($row[2]) || !is_numeric($row[3])) {
                $errors[] = "Baris " . ($index + 1) . ": Longitude atau Latitude tidak valid.";
                continue;
            }

            $data[] = [

                'tanggal' => $formattedTanggal,
                'lokasi' => $row[1],
                'longitude' => $row[2] ?? null,
                'latitude' => $row[3] ?? null,
                'PM10' => $row[4],
                'PM2_5' => $row[5],
                'SO2' => $row[6],
                'CO' => $row[7],
                'O3' => $row[8],
                'NO2' => $row[9],
                'HC' => $row[10],
                'user_id' => Auth::id(),
                'status' => 'Sedang Diajukan',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            DataKLHK::insert($data);
        }

        if (!empty($errors)) {
            return back()->with('error', 'Beberapa baris gagal diunggah: ' . implode(', ', $errors));
        }

        return redirect()->route('data_klhk.index')->with('success', 'Data berhasil diunggah!');
    }

    public function downloadTemplate()
    {
        $filePath = 'templates/data_klhk_entry_form.xlsx';
        if (Storage::exists($filePath)) {
            return response()->download(storage_path('app/' . $filePath), 'data_klhk_entry_form.xlsx');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
