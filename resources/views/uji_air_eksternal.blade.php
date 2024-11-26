@extends('layouts.app2')

@section('content')
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="#pablo">Data Kualitas Air</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                    aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <form>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="now-ui-icons media-2_sound-wave"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Stats</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="now-ui-icons location_world"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pablo">
                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Account</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm">
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pengujian Kualitas Air Eksternal</h4>
                            <button class="button-add" onclick="window.location.href='/form_uji_air_eksternal';">
                                <i class="now-ui-icons ui-1_simple-add" style="color: white; font-weight:bold;"></i>
                                <span class="lable">Tambah Data</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Nama Lokasi</th>
                                        <th class="text-center">Wilayah Lokasi</th>
                                        <th class="text-center">Titik Koordinat</th>
                                        <th class="text-center">Temperature</th>
                                        <th class="text-center">TDS</th>
                                        <th class="text-center">TSS</th>
                                        <th class="text-center">Colour</th>
                                        <th class="text-center">pH</th>
                                        <th class="text-center">BOD</th>
                                        <th class="text-center">COD</th>
                                        <th class="text-center">DO</th>
                                        <th class="text-center">Sulfate</th>
                                        <th class="text-center">Chloride</th>
                                        <th class="text-center">Nitrate</th>
                                        <th class="text-center">Nitrite</th>
                                        <th class="text-center">Ammonia</th>
                                        <th class="text-center">Total Nitrogen</th>
                                        <th class="text-center">Total Phosphate</th>
                                        <th class="text-center">Fluoride</th>
                                        <th class="text-center">Sulfide</th>
                                        <th class="text-center">Cyanide</th>
                                        <th class="text-center">Free Chlorine</th>
                                        <th class="text-center">Boron</th>
                                        <th class="text-center">Mercury</th>
                                        <th class="text-center">Arsenic</th>
                                        <th class="text-center">Selenium</th>
                                        <th class="text-center">Cadmium</th>
                                        <th class="text-center">Cobalt</th>
                                        <th class="text-center">Nickel</th>
                                        <th class="text-center">Zinc</th>
                                        <th class="text-center">Copper</th>
                                        <th class="text-center">Lead</th>
                                        <th class="text-center">Hexavalent Chromium</th>
                                        <th class="text-center">Oil and Grease</th>
                                        <th class="text-center">Surfactants</th>
                                        <th class="text-center">Phenol</th>
                                        <th class="text-center">Fecal Coliform</th>
                                        <th class="text-center">Total Coliform</th>
                                        <th class="text-center">Waste</th>
                                        <th class="text-center">Status</th>
                                        @if (auth()->user()->role == 'admin')
                                            {{-- cek role --}}
                                            <th class="text-center">Kontributor</th>
                                        @endif
                                        <th class="text-center">
                                            Action
                                        </th>

                                    </thead>
                                    <tbody>
                                        @if ($uji_air_eksternals->isEmpty())
                                            <tr>
                                                <td colspan="16" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($uji_air_eksternals as $air_eksternal)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $air_eksternal['tanggal'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $air_eksternal['nama_lokasi'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $air_eksternal['wilayah_lokasi'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $air_eksternal['titik_koordinat'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $air_eksternal['temperature'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['TDS'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['TSS'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['colour'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['pH'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['BOD'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['COD'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['DO'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['sulfate'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['chloride'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['nitrate'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['nitrite'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['ammonia'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['total_n'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['total_phosphate'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['fluoride'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['sulfide'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['cyanide'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['free_chlorine'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['boron'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['mercury'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['arsenic'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['selenium'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['cadmium'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['cobalt'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['nickel'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['zinc'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['copper'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['lead'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['hexavalent_chromium'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['oil_and_grease'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['surfactants'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['phenol'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['fecal_coli'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['total_coli'] }}
                                                    <td class="text-center">
                                                        {{ $air_eksternal['waste'] }}

                                                        {{-- kolom status --}}
                                                    <td class="text-center">
                                                        <div
                                                            class="
                                                @if ($air_eksternal['status'] === 'Sedang Diajukan') sedang-diajukan
                                                @elseif($air_eksternal['status'] === 'Terverifikasi') terverifikasi
                                                @elseif($air_eksternal['status'] === 'Perlu Revisi') perlu-revisi @endif">
                                                            {{ $air_eksternal['status'] }}
                                                        </div>
                                                    </td>

                                                    {{-- kolom kontributor --}}
                                                    @if (auth()->user()->role == 'admin')
                                                        {{-- cek role --}}
                                                        {{-- <th class="text-center">Kontributor</th> --}}
                                                        {{-- @endif --}}
                                                        {{-- @if ($air_eksternal->user && $air_eksternal->user->role == 'admin') --}}
                                                        <td class="text-center">{{ $air_eksternal->user->name }}</td>
                                                    @endif

                                                    <td class="text-center">
                                                        <a href="{{ route('uji_air_eksternal.edit', $air_eksternal->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <img class="button-icons" src="/storage/img/pencil-square.svg"
                                                                alt="Edit Icon" width="16" height="16">
                                                        </a>
                                                        <form
                                                            action="{{ route('uji_air_eksternal.destroy', $air_eksternal->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <img class="button-icons" src="/storage/img/trash3.svg"
                                                                    alt="Delete Icon" width="16" height="16">
                                                            </button>
                                                        </form>
                                                        @if (Auth::user()->role === 'admin')
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                                    type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="now-ui-icons location_world"></i>
                                                                </button>

                                                                <div class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuButton">
                                                                    <!-- Approve Button -->
                                                                    <form
                                                                        action="{{ route('uji_air_eksternal.approve', $air_eksternal->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="dropdown-item">Approve</button>
                                                                    </form>

                                                                    <!-- Perlu Revisi Button -->
                                                                    <form
                                                                        action="{{ route('uji_air_eksternal.revisi', $air_eksternal->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">Perlu
                                                                            Revisi</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    {{-- <ul>
                    <li>
                        <a href="https://www.creative-tim.com">
                            Creative Tim
                        </a>
                    </li>
                    <li>
                        <a href="http://presentation.creative-tim.com">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="http://blog.creative-tim.com">
                            Blog
                        </a>
                    </li>
                </ul> --}}
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>, Designed and Developed by <span
                            style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan Hidup Surabaya </span>
                        {{-- <a href="https://www.invisionapp.com"
                        target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com"
                        target="_blank">Creative Tim</a>. --}}
                    </div>
                </nav>
            </div>
        </footer>
    </div>
@endsection
