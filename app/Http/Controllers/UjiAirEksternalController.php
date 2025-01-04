<?php

namespace App\Http\Controllers;

use App\Models\UjiAirEksternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UjiAirEksternalRequest;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

class UjiAirEksternalController extends Controller
{
    // daftar data
    // public function index()
    // {
    //     $uji_air_eksternals = UjiAirEksternal::all();
    //     return view('uji_air_eksternal', compact('uji_air_eksternals'));
    // }

    public function index(Request $request)
    {

        $request->validate([
            'bulan' => 'nullable|digits:2|numeric|min:1|max:12',
            'tahun' => 'nullable|digits:4|numeric|min:2000|max:' . date('Y'),
            'nama_lokasi' => 'nullable|string|max:255',
        ]);

        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        $uji_air_eksternals = UjiAirEksternal::with('user')
            ->when($request->nama_lokasi, function ($query) use ($request) {
                return $query->where('nama_lokasi', 'like', '%' . $request->nama_lokasi . '%');
            })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('tanggal', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tanggal', $tahun);
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(50);

        return view('uji_air_eksternal', compact('uji_air_eksternals'));
    }

    // form data baru
    public function create()
    {
        // $uji_air_eksternal = UjiAirEksternal::all();
        return view('form_uji_air_eksternal');
    }

    // save data
    public function store(UjiAirEksternalRequest $request)
    {
        $ujiAirEksternal = new UjiAirEksternal($request->validated());
        $ujiAirEksternal->status = 'Sedang Diajukan';
        $ujiAirEksternal->user_id = Auth::id();
        $ujiAirEksternal->save();

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil disimpan!');
    }
    // approve
    public function approve($id)
    {
        $data = UjiAirEksternal::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil disetujui.');
    }

    // tandai data revisi
    public function revisi($id)
    {
        $data = UjiAirEksternal::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data perlu revisi.');
    }

    // detail data
    public function show(UjiAirEksternal $ujiAirEksternal)
    {
        return view('uji_air_eksternal.show', compact('ujiAirEksternal'));
    }

    // form edit data
    public function edit($id)
    {
        $ujiAirEksternal = UjiAirEksternal::findOrFail($id);
        // $data_kawasans = DataKawasan::all();
        return view('edit_uji_air_eksternal', compact('ujiAirEksternal'));
    }

    // update data
    public function update(UjiAirEksternalRequest $request, $id)
    {
        $ujiAirEksternal = UjiAirEksternal::findOrFail($id);
        $ujiAirEksternal->update($request->validated());
        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil diperbarui.');
    }

    // hapus data
    public function destroy($id)
    {
        $ujiAirEksternal = UjiAirEksternal::findOrFail($id);
        $ujiAirEksternal->delete();
        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil dihapus.');
    }

    // form import
    public function showImportForm()
    {
        return view('import_uji_air_eksternal');
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

            if (!is_numeric($row[3]) || !is_numeric($row[4])) {
                $errors[] = "Baris " . ($index + 1) . ": Longitude atau Latitude tidak valid.";
                continue;
            }

            $data[] = [

                'tanggal' => $formattedTanggal,
                'nama_lokasi' => $row[1],
                // 'wilayah_lokasi' => $row[2],
                'longitude' => $row[3],
                'latitude' => $row[4],
                'temperature' => $row[5],
                'TDS' => $row[6],
                'TSS' => $row[7],
                'colour' => $row[8],
                'pH' => $row[9],
                'BOD' => $row[10],
                'COD' => $row[11],
                'DO' => $row[12],
                'sulfate' => $row[13],
                'chloride' => $row[14],
                'nitrate' => $row[15],
                'nitrite' => $row[16],
                'ammonia' => $row[17],
                'total_n' => $row[18],
                'total_phosphate' => $row[19],
                'fluoride' => $row[20],
                'sulfide' => $row[21],
                'cyanide' => $row[22],
                'free_chlorine' => $row[23],
                'boron' => $row[24],
                'mercury' => $row[25],
                'arsenic' => $row[26],
                'selenium' => $row[27],
                'cadmium' => $row[28],
                'cobalt' => $row[29],
                'nickel' => $row[30],
                'zinc' => $row[31],
                'copper' => $row[32],
                'lead' => $row[33],
                'hexavalent_chromium' => $row[34],
                'oil_and_grease' => $row[35],
                'surfactants' => $row[36],
                'phenol' => $row[37],
                'fecal_coli' => $row[38],
                'total_coli' => $row[39],
                'waste' => $row[40],
                'isMarker' => $row['isMarker'] ?? '0',
                'status' => 'Sedang Diajukan',
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            UjiAirEksternal::insert($data);
        }

        if (!empty($errors)) {
            return back()->with('error', 'Beberapa baris gagal diunggah: ' . implode(', ', $errors));
        }

        return redirect()->route('uji_air_eksternal.index')->with('success', 'Data berhasil diunggah!');
    }
    public function downloadTemplate()
    {
        $filePath = 'templates/data_air_eksternal_entry_form.xlsx';
        if (Storage::exists($filePath)) {
            return response()->download(storage_path('app/' . $filePath), 'data_air_eksternal_entry_form.xlsx');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
