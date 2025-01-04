<?php

namespace App\Http\Controllers;

use App\Models\ArsipUjiAir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ArsipUjiAirRequest;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

class ArsipUjiAirController extends Controller
{
    // public function index()
    // {
    //     $arsip_data_air_internals = ArsipUjiAir::with('user')->get();
    //     // $data_partikulats = ArsipUjiAir::all();
    //     return view('arsip_uji_air', compact('arsip_data_air_internals'));
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

        $arsip_data_air_internals = ArsipUjiAir::with('user')
            ->when($request->nama_lokasi, function ($query) use ($request) {
                return $query->where('nama_lokasi', 'like', '%' . $request->nama_lokasi . '%');
            })
            ->when($bulan, function ($query) use ($bulan) {
                return $query->whereMonth('bulan', $bulan);
            })
            ->when($tahun, function ($query) use ($tahun) {
                return $query->whereYear('tahun', $tahun);
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(50);

        return view('arsip_uji_air', compact('arsip_data_air_internals'));
    }
    public function create()
    {
        return view('form_arsip_uji_air');
    }
    public function approve($id)
    {
        $data = ArsipUjiAir::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = ArsipUjiAir::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data perlu revisi.');
    }
    public function store(ArsipUjiAirRequest $request)
    {
        // dd($request->all());
        // Simpan data baru
        $arsipUjiAir = new ArsipUjiAir($request->validated());
        $arsipUjiAir->status = 'Sedang Diajukan';
        $arsipUjiAir->user_id = Auth::id();
        $arsipUjiAir->save();
        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil disimpan!');
    }

    public function verify($id)
    {
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        $arsipUjiAir->status = 'Terverifikasi';
        $arsipUjiAir->save();

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil diverifikasi.');
    }

    public function batchApprove(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        if ($selectedIds) {
            ArsipUjiAir::whereIn('id', $selectedIds)->update(['status' => 'Terverifikasi']);
            return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil disetujui.');
        }
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }

    public function show(ArsipUjiAir $arsipUjiAir)
    {
        return view('arsip_uji_air.show', compact('arsip_uji_air'));
    }

    public function edit($id)
    {
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        return view('edit_arsip_uji_air', compact('arsipUjiAir'));
    }

    public function update(ArsipUjiAirRequest $request, $id)
    {
        // $validatedData = $request->validated();
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        $arsipUjiAir->update($request->validated());
        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsipUjiAir = ArsipUjiAir::findOrFail($id);
        $arsipUjiAir->delete();
        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil dihapus.');
    }

    // form import
    public function showImportForm()
    {
        return view('import_arsip_uji_air');
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

                'bulan' => $row[1],
                'tahun' => $row[2],
                'nama_lokasi' => $row[3],
                'longitude' => $row[3],
                'latitude' => $row[4],
                'BOD' => $row[5],
                'COD' => $row[6],
                'TSS' => $row[7],
                'DO' => $row[8],
                'pH' => $row[9],
                'total_coli' => $row[10],
                'fecal_coli' => $row[11],
                'isMarker' => $row['isMarker'] ?? '0',
                'status' => 'Sedang Diajukan',
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            ArsipUjiAir::insert($data);
        }

        if (!empty($errors)) {
            return back()->with('error', 'Beberapa baris gagal diunggah: ' . implode(', ', $errors));
        }

        return redirect()->route('arsip_uji_air.index')->with('success', 'Data berhasil diunggah!');
    }

    public function downloadTemplate()
    {
        $filePath = 'templates/data_arsip_air_internal_entry_form.xlsx';
        if (Storage::exists($filePath)) {
            return response()->download(storage_path('app/' . $filePath), 'data_arsip_air_internal_entry_form.xlsx');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
