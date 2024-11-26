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
                            <h4 class="card-title">Data KLHK</h4>
                            <button class="button-add" onclick="window.location.href='/form_data_klhk';">
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
                                            Tanggal
                                        </th>
                                        <th class="text-center">
                                            SO2
                                        </th>
                                        <th class="text-center">
                                            CO
                                        </th>
                                        <th class="text-center">
                                            O3
                                        </th>
                                        <th class="text-center">
                                            NO2
                                        </th>
                                        <th class="text-center">
                                            HC
                                        </th>
                                        <th class="text-center">
                                            PM10
                                        </th>
                                        <th class="text-center">
                                            PM2,5
                                        </th>
                                        <th class="text-center">
                                            Status
                                        </th>
                                        {{-- @if (Auth::user()->role === 'admin') --}}
                                        <th class="text-center">
                                            Kontributor
                                        </th>
                                        {{-- @endif --}}
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @if ($data_klhks->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($data_klhks as $dataklhk)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['tanggal'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['SO2'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['CO'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['O3'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['NO2'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['HC'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['PM10'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $dataklhk['PM2_5'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div
                                                            class="
                                                    @if ($dataklhk['status'] === 'Sedang Diajukan') sedang-diajukan
                                                    @elseif($dataklhk['status'] === 'Terverifikasi') terverifikasi
                                                    @elseif($dataklhk['status'] === 'Perlu Revisi') perlu-revisi @endif">
                                                            {{ $dataklhk['status'] }}
                                                        </div>
                                                    </td>
                                                    {{-- @if (Auth::user()->role === 'admin') --}}

                                                    <td class="text-center">
                                                        {{ $dataklhk->user ? $dataklhk->user->name : 'Nama tidak tersedia' }}
                                                    </td>
                                                    {{-- @endif --}}

                                                    <td class="text-center">
                                                        <a href="{{ route('data_klhk.edit', $dataklhk->id) }}"
                                                            class="btn btn-sm btn-primary"><img class="button-icons"
                                                                src="/storage/img/pencil-square.svg" alt="Edit Icon"
                                                                width="16" height="16"></a>
                                                        <form
                                                            action="{{ route('data_klhk.destroy', $dataklhk->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <img class="button-icons" src="/storage/img/trash3.svg"
                                                                    alt="Edit Icon" width="16" height="16">
                                                            </button>
                                                        </form>
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
