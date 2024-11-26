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
                    <a class="navbar-brand" href="#pablo">Berita Acara</a>
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
                            <h4 class="card-title">Edit Data KLHK</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data_klhk.update', $dataKlhk->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <table class="table"
                                    style="border: 1px solid rgb(124, 124, 124); border-collapse: collapse; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">1</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">tanggal</td>
                                            <td>
                                                <input type="date" name="tanggal" class="form-control"
                                                    placeholder="tanggal"
                                                    value="{{ old('tanggal', $dataKlhk->tanggal) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">2</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">SO2</td>
                                            <td>
                                                <input type="number" name="SO2" class="form-control"
                                                    placeholder="SO2"
                                                    value="{{ old('SO2', $dataKlhk->SO2) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">3</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">CO</td>
                                            <td>
                                                <input type="number" name="CO" class="form-control"
                                                    placeholder="CO"
                                                    value="{{ old('CO', $dataKlhk->CO) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">4</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">O3</td>
                                            <td>
                                                <input type="number" name="O3" class="form-control" placeholder="O3"
                                                    value="{{ old('O3', $dataKlhk->O3) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">5</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">NO2</td>
                                            <td>
                                                <input type="number" name="NO2" class="form-control"
                                                    placeholder="NO2" value="{{ old('NO2', $dataKlhk->NO2) }}">
                                            </td>

                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">6</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">HC</td>
                                            <td>
                                                <input type="number" name="HC" class="form-control"
                                                    placeholder="HC" value="{{ old('HC', $dataKlhk->HC) }}">
                                            </td>

                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">7</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">PM10</td>
                                            <td>
                                                <input type="number" name="PM10" class="form-control"
                                                    placeholder="PM10" value="{{ old('PM10', $dataKlhk->PM10) }}">
                                            </td>

                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">8</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">PM2_5</td>
                                            <td>
                                                <input type="number" name="PM2_5" class="form-control"
                                                    placeholder="PM2_5" value="{{ old('PM2_5', $dataKlhk->PM2_5) }}">
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">4</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Lokasi</td>
                                            <td>
                                                <input type="text" name="nama_lokasi" class="form-control"
                                                    placeholder="nama_lokasi"
                                                    value="{{ old('nama_lokasi', $dataPassive->nama_lokasi) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">5</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Titik
                                                Koordinat</td>
                                            <td>
                                                <input type="text" name="titik_koordinat" class="form-control"
                                                    placeholder="titik_koordinat"
                                                    value="{{ old('titik_koordinat', $dataPassive->titik_koordinat) }}">
                                            </td>
                                        </tr> --}}
                                        {{-- <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">6</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Kawasan</td>
                                            <td>
                                                <select name="kawasan_id" class="form-control">
                                                    <option value="">Pilih Kawasan</option>
                                                    @foreach ($data_kawasans as $kawasan)
                                                        <option value="{{ $kawasan->id }}">{{ $kawasan->kawasan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr> --}}
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Perbarui</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav>
                    <div class="copyright" id="copyright">
                        <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()));
                        </script>, Designed and Developed by <span
                            style="font-weight: bold; color: rgb(0, 0, 0);">Dinas Lingkungan Hidup Surabaya</span>
                    </div>
                </nav>
            </div>
        </footer>
    </div>
@endsection
