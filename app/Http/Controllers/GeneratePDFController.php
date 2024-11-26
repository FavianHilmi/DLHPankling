<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;

class GeneratePDFController extends Controller
{
    public function generatePDF()
    {

        $dompdf = new Dompdf();
        $html = '
            <style>
                h1, h2, h4 {
                    text-align: center;
                    margin: 0;
                }
                // h2 {
                //     font-weight: normal;
                // }
            </style>
            <h2>PEMERINTAH KOTA SURABAYA</h2>
            <h1>DINAS LINGKUNGAN HIDUP</h1>
            <h4>Jalan Menur 1</h4>
            <h4>no telp 0310000</h4>

        ';
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->stream("document.pdf", ["Attachment" => false]);
    }
}
