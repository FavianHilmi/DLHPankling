<?php

namespace App\Http\Controllers;

use App\Models\UjiAirInternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UjiAirInternalRequest;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UjiAirInternalController extends Controller
{
    // list data
    // public function index()
    // {
    //     $uji_air_internals = UjiAirInternal::all();
    //     return view('uji_air_internal', compact('uji_air_internals'));
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

        $uji_air_internals = UjiAirInternal::with('user')
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

        return view('uji_air_internal', compact('uji_air_internals'));
    }

    // form data baru
    public function create()
    {
        return view('form_uji_air_internal');
    }

    // save data
    public function store(UjiAirInternalRequest $request)
    {
        $ujiAirInternal = new UjiAirInternal($request->validated());
        $ujiAirInternal->status = 'Sedang Diajukan';
        $ujiAirInternal->user_id = Auth::id();
        $ujiAirInternal->save();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil disimpan!');
    }

    // approve data
    public function approve($id)
    {
        $data = UjiAirInternal::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil disetujui.');
    }

    // tandai data untuk revisi
    public function revisi($id)
    {
        $data = UjiAirInternal::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data perlu revisi.');
    }

    // detail data
    public function show(UjiAirInternal $ujiAirInternal)
    {
        return view('uji_air_internal.show', compact('ujiAirInternal'));
    }

    // form edit data
    public function edit($id)
    {
        $ujiAirInternal = UjiAirInternal::findOrFail($id);
        return view('edit_uji_air_internal', compact('ujiAirInternal'));
    }

    // update data
    public function update(UjiAirInternalRequest $request, $id)
    {
        // dd($request->all());
        $ujiAirInternal = UjiAirInternal::findOrFail($id);
        $ujiAirInternal->update($request->validated());
        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil diperbarui.');
    }

    // hapus data
    public function destroy($id)
    {
        $ujiAirInternal = UjiAirInternal::findOrFail($id);
        $ujiAirInternal->delete();

        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil dihapus.');
    }

    // form import
    public function showImportForm()
    {
        return view('import_uji_air_internal');
    }

    // Proses import data dari Excel
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
            if ($index == 0) continue; // Skip header row

            if (empty(array_filter($row))) {
                continue; // Abaikan baris kosong
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
                'wilayah_lokasi' => $row[2],
                'longitude' => $row[3],
                'latitude' => $row[4],
                'pH' => $row[5],
                'DO' => $row[6],
                'BOD' => $row[7],
                'COD' => $row[8],
                'TSS' => $row[9],
                'nitrat' => $row[10],
                'fosfat' => $row[11],
                'fecal_coli' => $row[12],
                'kelas' => $row[13],
                'isMarker' => '0',
                'status' => 'Sedang Diajukan',
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($data)) {
            UjiAirInternal::insert($data);
        }

        if (!empty($errors)) {
            return back()->with('error', 'Beberapa baris gagal diimpor: ' . implode(', ', $errors));
        }

        return redirect()->route('uji_air_internal.index')->with('success', 'Data berhasil diimpor!');
    }
}
