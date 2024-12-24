<?php

namespace App\Http\Controllers;

use App\Models\DataPassive;
use Illuminate\Http\Request;
use App\Models\DataKawasan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DataPassiveRequest;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
class DataPassiveController extends Controller
{
    // Tampilkan daftar data
    // public function index()
    // {
    //     $data_passives = DataPassive::all();
    //     return view('data_passive_sample', compact('data_passives'));
    // }
    public function index(Request $request)
    {
        $request->validate([
            'pemasangan' => 'nullable|date_format:Y-m-d',
            'pelepasan' => 'nullable|date_format:Y-m-d',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');

        $data_passives = DataPassive::with('user')
            ->when($request->pemasangan, function ($query) use ($request) {
                return $query->whereDate('pemasangan', $request->pemasangan);
            })
            ->when($request->pelepasan, function ($query) use ($request) {
                return $query->whereDate('pelepasan', $request->pelepasan);
            })
            ->when($request->lokasi, function ($query) use ($request) {
                return $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(50);

        return view('data_passive_sample', compact('data_passives'));
    }
    // Show form untuk buat data baru
    public function create()
    {
        $data_kawasans = DataKawasan::all();
        // dd($data_kawasans); // Debugging
        return view('form_data_passive', compact('data_kawasans'));
    }

    // Simpan data
    public function store(DataPassiveRequest $request)
    {
        $dataPassive = new DataPassive($request->validated());
        $dataPassive->status = 'Sedang Diajukan';
        $dataPassive->user_id = Auth::id();
        $dataPassive->save();

        return redirect()->route('data_passive.index')->with('success', 'Data berhasil disimpan!');
    }
    public function approve($id)
    {
        $data = DataPassive::findOrFail($id);
        $data->status = 'Terverifikasi';
        $data->save();

        return redirect()->route('data_passive.index')->with('success', 'Data berhasil disetujui.');
    }

    public function revisi($id)
    {
        $data = DataPassive::findOrFail($id);
        $data->status = 'Perlu Revisi';
        $data->save();

        return redirect()->route('data_passive.index')->with('success', 'Data perlu revisi.');
    }
    // Show detail data
    public function show(DataPassive $dataPassive)
    {
        return view('data_passive.show', compact('dataPassive'));
    }

    // Show form untuk mengedit data
    public function edit($id)
    {
        $dataPassive = DataPassive::findOrFail($id);
        $data_kawasans = DataKawasan::all();
        return view('edit_data_passive', compact('dataPassive', 'data_kawasans'));
    }

    // Update data
    public function update(DataPassiveRequest $request, DataPassive $dataPassive)
    {
        $dataPassive->update($request->validated());
        return redirect()->route('data_passive.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(DataPassive $dataPassive)
    {
        $dataPassive->delete();
        return redirect()->route('data_passive.index')->with('success', 'Data berhasil dihapus.');
    }

    // form import
    public function showImportForm()
    {
        return view('import_data_passive');
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
        if ($index == 0) continue; // Lewati baris header
        if (empty(array_filter($row))) continue; // Lewati baris kosong

        $pemasangan = \DateTime::createFromFormat('d/m/Y', $row[0]);
        $pelepasan = \DateTime::createFromFormat('d/m/Y', $row[1]);

        if (!$pemasangan || !$pelepasan) {
            $errors[] = "Baris " . ($index + 1) . ": Tanggal Pemasangan atau Pelepasan tidak valid.";
            continue;
        }

        if (!is_numeric($row[4]) || !is_numeric($row[5])) {
            $errors[] = "Baris " . ($index + 1) . ": Longitude atau Latitude tidak valid.";
            continue;
        }

        $data[] = [
            'pemasangan' => $pemasangan->format('Y-m-d'),
            'pelepasan' => $pelepasan->format('Y-m-d'),
            'semester' => $row[2],
            'lokasi' => $row[3],
            'longitude' => $row[4],
            'latitude' => $row[5],
            'SO2' => $row[7],
            'NO2' => $row[8],
            'kawasan_id' => $row[6],
            'user_id' => Auth::id(),
            'status' => 'Sedang Diajukan',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    if (!empty($data)) {
        DataPassive::insert($data);
    } else {
        return back()->with('error', 'Tidak ada data yang berhasil diimpor!');
    }

    if (!empty($errors)) {
        return back()->with('error', 'Beberapa baris gagal diimpor: ' . implode(', ', $errors));
    }

    return redirect()->route('data_passive.index')->with('success', 'Data berhasil diimpor!');
}



}
