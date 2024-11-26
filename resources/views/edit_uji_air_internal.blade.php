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
                            <h4 class="card-title">Edit Data Uji Air Internal</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('uji_air_internal.update', $ujiAirInternal->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <table class="table"
                                    style="border: 1px solid rgb(124, 124, 124); border-collapse: collapse; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">1</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Tanggal</td>
                                            <td>
                                                <input type="date" name="tanggal" class="form-control"
                                                    placeholder="tanggal"
                                                    value="{{ old('tanggal', $ujiAirInternal->tanggal) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">2</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Lokasi</td>
                                            <td>
                                                <input type="text" name="nama_lokasi" class="form-control"
                                                    placeholder="nama_lokasi"
                                                    value="{{ old('nama_lokasi', $ujiAirInternal->nama_lokasi) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">3</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Wilayah</td>
                                            <td>
                                                <input type="text" name="wilayah_lokasi" class="form-control"
                                                    placeholder="wilayah_lokasi"
                                                    value="{{ old('wilayah_lokasi', $ujiAirInternal->wilayah_lokasi) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">4</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">Titik Koordinat
                                            </td>
                                            <td>
                                                <input type="text" name="titik_koordinat" class="form-control"
                                                    placeholder="titik_koordinat"
                                                    value="{{ old('titik_koordinat', $ujiAirInternal->titik_koordinat) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">5</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">pH</td>
                                            <td>
                                                <input type="number" step="0.01" name="pH" class="form-control"
                                                    placeholder="pH" value="{{ old('pH', $ujiAirInternal->pH) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">6</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">DO</td>
                                            <td>
                                                <input type="number" step="0.01" name="DO" class="form-control"
                                                    placeholder="DO" value="{{ old('DO', $ujiAirInternal->DO) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">7</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">BOD</td>
                                            <td>
                                                <input type="number" step="0.01" name="BOD" class="form-control"
                                                    placeholder="BOD" value="{{ old('BOD', $ujiAirInternal->BOD) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">8</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">COD</td>
                                            <td>
                                                <input type="number" step="0.01" name="COD" class="form-control"
                                                    placeholder="COD" value="{{ old('COD', $ujiAirInternal->COD) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">9</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">COD</td>
                                            <td>
                                                <input type="number" step="0.01" name="COD" class="form-control"
                                                    placeholder="COD"
                                                    value="{{ old('COD', $ujiAirInternal->COD) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">10</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">TSS</td>
                                            <td>
                                                <input type="number" step="0.01" name="TSS" class="form-control"
                                                    placeholder="TSS"
                                                    value="{{ old('TSS', $ujiAirInternal->TSS) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">11</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">nitrat</td>
                                            <td>
                                                <input type="number" step="0.01" name="nitrat" class="form-control"
                                                    placeholder="nitrat"
                                                    value="{{ old('nitrat', $ujiAirInternal->nitrat) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">12</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">fosfat</td>
                                            <td>
                                                <input type="number" step="0.01" name="fosfat" class="form-control"
                                                    placeholder="fosfat"
                                                    value="{{ old('fosfat', $ujiAirInternal->fosfat) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">13</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">fecal_coli</td>
                                            <td>
                                                <input type="number" step="0.01" name="fecal_coli" class="form-control"
                                                    placeholder="fecal_coli"
                                                    value="{{ old('fecal_coli', $ujiAirInternal->fecal_coli) }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">14</td>
                                            <td style="border: 1px solid rgb(124, 124, 124); padding: 28px;">kelas</td>
                                            <td>
                                                <input type="number" step="0.01" name="kelas" class="form-control"
                                                    placeholder="kelas"
                                                    value="{{ old('kelas', $ujiAirInternal->kelas) }}">
                                            </td>
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
