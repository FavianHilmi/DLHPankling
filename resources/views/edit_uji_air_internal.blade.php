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
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{-- <i class="now-ui-icons location_world"></i> --}}
                                <i class="now-ui-icons users_single-02"></i>
                                <p>
                                    <span class="d-lg-none d-md-block">Some Actions</span>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Profile</a>

                                <!-- Form logout -->
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <input type="submit" class="dropdown-item" value="{{ __('Log Out') }}">
                                </form>

                            </div>

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
                <div class="col-md-7 mx-auto">
                    <div class="card">
                        <div class="card-header-form">
                            <h5 class="kop-surat" style="font-weight: bold">FORM EDIT DATA UJI KUALITAS AIR INTERNAL</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('uji_air_internal.update', $ujiAirInternal->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="tanggal" class="form">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" placeholder="tanggal"
                                                value="{{ old('tanggal', $ujiAirInternal->tanggal) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 pr-1">
                                        <div class="form-group">
                                            <label for="nama_lokasi" class="form">Lokasi</label>
                                            <input type="text" name="nama_lokasi" class="form-control"
                                                placeholder="nama_lokasi"
                                                value="{{ old('nama_lokasi', $ujiAirInternal->nama_lokasi) }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-5 px-3">
                                        <div class="form-group">
                                            <label for="wilayah_lokasi" class="form">Wilayah</label>
                                            <input type="text" name="wilayah_lokasi" class="form-control"
                                                placeholder="wilayah_lokasi"
                                                value="{{ old('wilayah_lokasi', $ujiAirInternal->wilayah_lokasi) }}">
                                        </div>
                                    </div> --}}

                                </div>
                                <div class="row">
                                    <div class="col-md-8 pr-1">
                                        <div class="form-group">
                                            <label for="longitude" class="form">Titik Koordinat X</label>
                                            <input type="text" name="longitude" class="form-control"
                                                placeholder="longitude"
                                                value="{{ old('longitude', $ujiAirInternal->longitude) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-8 pr-1">
                                        <div class="form-group">
                                            <label for="latitude" class="form">Titik Koordinat Y</label>
                                            <input type="text" name="latitude" class="form-control"
                                                placeholder="latitude"
                                                value="{{ old('latitude', $ujiAirInternal->latitude) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="pH" class="form">pH</label>
                                            <input type="text" name="pH" class="form-control"
                                                placeholder="pH"
                                                value="{{ old('pH', $ujiAirInternal->pH) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="DO" class="form">DO</label>
                                            <input type="text" name="DO" class="form-control"
                                                placeholder="DO"
                                                value="{{ old('DO', $ujiAirInternal->DO) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="BOD" class="form">BOD</label>
                                            <input type="text" name="BOD" class="form-control"
                                                placeholder="BOD"
                                                value="{{ old('BOD', $ujiAirInternal->BOD) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="COD" class="form">COD</label>
                                            <input type="text" name="COD" class="form-control"
                                                placeholder="COD"
                                                value="{{ old('COD', $ujiAirInternal->COD) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="TSS" class="form">TSS</label>
                                            <input type="text" name="TSS" class="form-control"
                                                placeholder="TSS"
                                                value="{{ old('TSS', $ujiAirInternal->TSS) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="nitrat" class="form">nitrat</label>
                                            <input type="text" name="nitrat" class="form-control"
                                                placeholder="nitrat"
                                                value="{{ old('nitrat', $ujiAirInternal->nitrat) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="fosfat" class="form">fosfat</label>
                                            <input type="text" name="fosfat" class="form-control"
                                                placeholder="fosfat"
                                                value="{{ old('fosfat', $ujiAirInternal->fosfat) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="fecal_coli" class="form">fecal_coli</label>
                                            <input type="text" name="fecal_coli" class="form-control"
                                                placeholder="fecal_coli"
                                                value="{{ old('fecal_coli', $ujiAirInternal->fecal_coli) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 pr-1">
                                        <div class="form-group">
                                            <label for="kelas" class="form">kelas</label>
                                            <input type="text" name="kelas" class="form-control"
                                                placeholder="kelas"
                                                value="{{ old('kelas', $ujiAirInternal->kelas) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group" style="margin-left: 15px; margin-top: 35px; display: flex; align-items: center;">
                                        <input type="hidden" name="isMarker" value="0">
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="isMarker" value="1" style="display: none;">
                                            <div class="toggle-switch-background">
                                                <div class="toggle-switch-handle"></div>
                                            </div>
                                        </label>
                                        <p style="margin: 5px 15px;">Tampilkan data ke peta</p>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="kawasan" class="form">Kawasan</label>
                                            <select name="kawasan_id" id="kawasan" class="form-control" required>
                                                <option value="">Pilih Kawasan</option>
                                                @foreach ($data_kawasans as $kawasan)
                                                    <option value="{{ $kawasan->id }}">{{ $kawasan->kawasan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <button type="submit" class="button-submit mx-auto">
                                        <span class="label">Submit</span>
                                    </button>
                                </div>
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
