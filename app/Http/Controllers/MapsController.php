<?php

namespace App\Http\Controllers;

use App\Models\ArsipUjiAir;
use App\Models\DataKLHK;
use App\Models\DataPartikulat;
use App\Models\DataPassive;
use App\Models\DataSPKUA;
use App\Models\UjiAirInternal;
use App\Models\UjiAirEksternal;

class MapsController extends Controller
{
    public function index()
    {
        $uji_air_eksternals = UjiAirEksternal::where('isMarker', 1)->get();
        $uji_air_internals = UjiAirInternal::where('isMarker', 1)->get();

        // Debug data
        // dd($uji_air_eksternals, $uji_air_internals);

        return view('maps', compact('uji_air_eksternals', 'uji_air_internals'));
    }

}
