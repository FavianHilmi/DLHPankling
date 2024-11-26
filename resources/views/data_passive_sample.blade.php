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
        <div class="panel-header panel-header-sm">
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Passive Sample</h4>
                            <button class="button-add" onclick="window.location.href='/form_data_passive';">
                                <i class="now-ui-icons ui-1_simple-add" style="color: white; font-weight:bold;"></i>
                                <span class="lable">Tambah Data</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">
                                            Pemasangan
                                        </th>
                                        <th class="text-center">
                                            Pelepasan
                                        </th>
                                        <th class="text-center">
                                            Semester
                                        </th>
                                        <th class="text-center">
                                            SO2
                                        </th>
                                        <th class="text-center">
                                            NO2
                                        </th>
                                        {{-- <th class="text-center">
                                            Lokasi
                                        </th> --}}
                                        <th class="text-center">
                                            Kategori
                                        </th>
                                        {{-- @if (auth()->user()->role == 'admin')  --}}
                                        <th class="text-center">Kontributor</th>
                                    {{-- @endif --}}
                                        <th class="text-center">
                                            Status
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @if ($data_passives->isEmpty())
                                            <tr>
                                                <td colspan="10" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($data_passives as $dataPassive)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataPassive['pemasangan'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataPassive['pelepasan'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataPassive['semester'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataPassive['SO2'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataPassive['NO2'] }}
                                                    </td>
                                                    {{-- <td class="text-center">
                                                        {{ $dataPassive['nama_lokasi'] }}
                                                    </td> --}}
                                                    <td class="text-center">
                                                        {{ $dataPassive->dataKawasan ? $dataPassive->dataKawasan->kawasan : 'Undefined' }}
                                                        {{-- {{ $dataPassive['id'] }} --}}
                                                    </td>
                                                    {{-- @if ($dataPassive->user && $dataPassive->user->role == 'admin') --}}
                                                    <td class="text-center">{{ $dataPassive->user->name }}</td>
                                                {{-- @endif --}}
                                                <td class="text-center">
                                                    <div
                                                        class="
                                                @if ($dataPassive['status'] === 'Sedang Diajukan') sedang-diajukan
                                                @elseif($dataPassive['status'] === 'Terverifikasi') terverifikasi
                                                @elseif($dataPassive['status'] === 'Perlu Revisi') perlu-revisi @endif">
                                                        {{ $dataPassive['status'] }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('data_passive.edit', $dataPassive->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <img class="button-icons" src="/storage/img/pencil-square.svg"
                                                            alt="Edit Icon" width="16" height="16">
                                                    </a>
                                                    <form
                                                        action="{{ route('data_passive.destroy', $dataPassive->id) }}"
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
                                                                    action="{{ route('data_passive.approve', $dataPassive->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="dropdown-item">Approve</button>
                                                                </form>

                                                                <!-- Perlu Revisi Button -->
                                                                <form
                                                                    action="{{ route('data_passive.revisi', $dataPassive->id) }}"
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
                    <ul>
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
                    </ul>
                </nav>
                <div class="copyright" id="copyright">
                    &copy;
                    <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                    </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a
                        href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                </div>
            </div>
        </footer>
    </div>
@endsection
