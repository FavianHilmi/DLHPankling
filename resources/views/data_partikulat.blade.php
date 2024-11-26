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
                    <a class="navbar-brand" href="#pablo">Data Kualitas Udara</a>
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


        <div class="panel-header panel-header-sm"></div>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Partikulat Mobile</h4>
                            <button class="button-add" onclick="window.location.href='/form_data_partikulat';">
                                <i class="now-ui-icons ui-1_simple-add" style="color: white; font-weight:bold;"></i>
                                <span class="lable">Tambah Data</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-primary">
                                        <tr>
                                            {{-- <th class="text-center">
                                                <input type="checkbox" id="select-all">
                                            </th> --}}
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Tahun</th>
                                            <th class="text-center">TPM</th>
                                            <th class="text-center">PM10</th>
                                            <th class="text-center">PM2,5</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Koordinat</th>
                                            {{-- @if (auth()->user()->role == 'admin') --}}
                                            {{-- cek role --}}
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Kontributor</th>
                                            {{-- @endif --}}
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data_partikulats as $dataPartikulat)
                                            <tr>
                                                {{-- <td class="text-center">
                                                    <input type="checkbox" name="selected_ids[]" value="{{ $dataPartikulat->id }}"
                                                           class="status-checkbox"
                                                           data-status="{{ $dataPartikulat->status }}">
                                                </td> --}}
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $dataPartikulat['tahun'] }}</td>
                                                <td class="text-center">{{ $dataPartikulat['TPM'] }}</td>
                                                <td class="text-center">{{ $dataPartikulat['PM10'] }}</td>
                                                <td class="text-center">{{ $dataPartikulat['PM2_5'] }}</td>
                                                <td class="text-center">{{ $dataPartikulat['nama_lokasi'] }}</td>
                                                <td class="text-center">{{ $dataPartikulat['titik_koordinat'] }}</td>
                                                <td class="text-center">
                                                    <div class="
                                                        @if ($dataPartikulat['status'] === 'Sedang Diajukan') sedang-diajukan
                                                        @elseif($dataPartikulat['status'] === 'Terverifikasi') terverifikasi
                                                        @elseif($dataPartikulat['status'] === 'Perlu Revisi') perlu-revisi @endif">
                                                        {{ $dataPartikulat['status'] }}
                                                    </div>
                                                </td>
                                                {{-- @if ($dataPartikulat->user && $dataPartikulat->user->role == 'admin')
                                                    <td class="text-center">{{ $dataPartikulat->user->name }}</td>
                                                @endif --}}
                                                {{-- @if (Auth::user()->role === 'admin') --}}
                                                <td class="text-center">
                                                    {{ $dataPartikulat->user ? $dataPartikulat->user->name : 'Nama tidak tersedia' }}
                                                    {{-- $berita = Berita::with('user')->get(); --}}

                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('data_partikulat.edit', $dataPartikulat->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <img class="button-icons" src="/storage/img/pencil-square.svg"
                                                            alt="Edit Icon" width="16" height="16">
                                                    </a>
                                                    <form
                                                        action="{{ route('data_partikulat.destroy', $dataPartikulat->id) }}"
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
                                                                    action="{{ route('data_partikulat.approve', $dataPartikulat->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="dropdown-item">Approve</button>
                                                                </form>

                                                                <!-- Perlu Revisi Button -->
                                                                <form
                                                                    action="{{ route('data_partikulat.revisi', $dataPartikulat->id) }}"
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
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav>
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        Designed and Developed by <span style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan
                            Hidup Surabaya </span>
                    </div>
                </nav>
            </div>
        </footer>
    </div>
@endsection
