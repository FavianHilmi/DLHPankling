<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\DataBeritaAcara;
use App\Models\DataPenguji;
use Carbon\Carbon;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);
$f4Paper = [0, 0, 595.28, 935.43];
$dompdf->setPaper($f4Paper, 'portrait');
$dompdf->getOptions()->set('fontDir', storage_path('fonts'));
$dompdf->getOptions()->set('fontCache', storage_path('fonts/cache'));
$dompdf->getOptions()->set('defaultFont', 'tahoma');

class GeneratePDFController extends Controller
{
    public function generatePDF($id)
    {
        $berita = DataBeritaAcara::findOrFail($id);
        $pengujis = DataPenguji::where('berita_id', $id)->get();
        Carbon::setLocale('id');
        $formattedDate = Carbon::parse($berita->tanggal)->translatedFormat('l, d F Y');

        // Inisialisasi DomPDF
        $dompdf = new Dompdf();

        // Konversi logo ke base64
        $imagePathlogo = public_path('storage/img/Logo Pemkot Surabaya.png');
        $imageDatalogo = base64_encode(file_get_contents($imagePathlogo));

        // Konversi gambar tanda tangan ke base64
        $imagePathttd = public_path('storage/img/TTD KETUA TIM.png');
        $imageDatattd = base64_encode(file_get_contents($imagePathttd));

        // Buat HTML untuk PDF
        $html = '
<style>
    body {
        margin: 0 30px;
        font-family: Tahoma, sans-serif;
    }
    h2, h4 {
        text-align: center;
        margin: 0;
    }
    p {
        font-size: 10pt;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    td {
        font-size: 10pt;
        text-align: center;
        border: 1px solid black;
        padding: 3px;
    }
    .kolom_ttd {
        font-size: 10pt;
        text-align: center;
        border: none;
    }

</style>
<h4>PEMERINTAH KOTA SURABAYA</h4>
<h2>DINAS LINGKUNGAN HIDUP</h2>
<p style="text-align:center; margin: 10px 0 0 0;">Jalan Menur 31A Surabaya</p>
<p style="text-align:center; margin: 0 0 20px 0;">Telp. (031) 5967387 Fax. (031) 5967390</p>
<p style="text-align:center; text-decoration: underline; font-weight: bold; margin: 0 0 0 0;">BERITA ACARA</p>
<p style="text-align:center; font-weight: bold; margin: 0 0 0 0;">' . $berita->judul . '</p>
<p style="text-align:center; font-weight: bold; margin: 0 0 20px 0;">Kegiatan Koordinasi, Sinkronisasi, dan Pelaksanaan Pencegahan Pencemaran Lingkungan Hidup Dilaksanakan Terhadap Media Tanah, Air, Udara, dan Laut</p>
<hr>
<br>
<p style="margin: 0 0 0 0;">' . $berita->deskripsi . '</p>
<br>
<p style="text-align:center; font-weight: bold; text-decoration: underline;">' . e($berita->nama_kolom_penguji) . '</p>
<table>
    <tbody>
        <tr>
            <th class="kolom_ttd">No.</th>
            <th class="kolom_ttd">Nama</th>
            <th class="kolom_ttd">Instansi</th>
            <th class="kolom_ttd">Tanda Tangan</th>
        </tr>';

        if (count($pengujis) > 0) {
            foreach ($pengujis as $index => $penguji) {
                $html .=
                    '<tr>
            <td class="kolom_ttd">' . ($index + 1) . '</td>
            <td class="kolom_ttd">' . e($penguji->nama_penguji) . '</td>
            <td class="kolom_ttd">' . e($penguji->instansi) . '</td>
            <td class="kolom_ttd">' . ($penguji->ttd ? '<img src="data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path('app/public/' . $penguji->ttd))) . '" height="30">' : ' ') . '</td>
        </tr>';
            }
        } else {
            $html .=
                '<tr>
            <td colspan="4" style="text-align: center;">Tidak ada data penguji</td>
        </tr>';
        }

        $html .=
            '</tbody>
</table>
<br>
<p style="text-align:center">Mengetahui,</p>
<p style="text-align:center; margin: 0 50px;">Ketua Tim Kerja Pemantauan dan Pengendalian Kualitas Lingkungan Hidup</p>
<br>';

        if ($berita->status === 'Terverifikasi') {
            $html .= '
    <div style="text-align:center;">
        <img src="data:image/jpeg;base64,' . $imageDatattd . '" style="width: 100px; height: auto;">
    </div>
    <p style="text-align:center; margin: 0 0 0 0; text-decoration: underline;">Srifatunningsih, S.T.</p>
    <p style="text-align:center; margin: 0 0 0 0;">Penata</p>
    <p style="text-align:center; margin: 0 0 0 0;">NIP. 198508122011012014</p>';
        } else {
            $html .= '
        <div style="margin-top: 100px; text-align:center;">
        <p style="text-align:center; margin: 0 0 0 0; text-decoration: underline;">Srifatunningsih, S.T.</p>
        <p style="text-align:center; margin: 0 0 0 0;">Penata</p>
        <p style="text-align:center; margin: 0 0 0 0;">NIP. 198508122011012014</p>
    </div>';
        }

        // Load HTML ke DomPDF
        $dompdf->loadHtml($html);

        // Render PDF
        $dompdf->render();

        // Tampilkan PDF di browser tanpa diunduh
        return $dompdf->stream("berita_acara.pdf", ["Attachment" => false]);
    }

}
