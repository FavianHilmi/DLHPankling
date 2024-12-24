@extends('layouts.app2')

@section('content')
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">Edit Data SPKUA</a>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm"></div>
        <div class="content">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="card">
                        <div class="card-header-form">
                            <h5 class="kop-surat" style="font-weight: bold">FORM EDIT DATA SPKUA</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data_spkua.update', $dataSPKUA->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="tanggal" class="form">Tanggal</label>
                                            <input type="date" name="tanggal" id="date" class="form-control"
                                                placeholder="Tanggal" value="{{ old('tanggal', $dataSPKUA->tanggal) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="lokasi" class="form">Lokasi</label>
                                            <input type="text" name="lokasi" id="text" class="form-control" placeholder="lokasi"
                                            value="{{ old('lokasi', $dataSPKUA->lokasi) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="longitude" class="form">Longitude</label>
                                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude"
                                                value="{{ old('longitude', $dataSPKUA->longitude) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="latitude" class="form">Latitude</label>
                                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude"
                                                value="{{ old('latitude', $dataSPKUA->latitude) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 px-3">
                                            <div class="form-group">
                                                <label for="PM10" class="form">PM10</label>
                                                <input type="number" step="0.01" name="PM10" id="PM10" class="form-control" placeholder="PM10"
                                                value="{{ old('PM10', $dataSPKUA->PM10) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-3">
                                            <div class="form-group">
                                                <label for="PM2_5" class="form">PM2.5</label>
                                                <input type="number" step="0.01" name="PM2_5" id="PM2_5"
                                                class="form-control" placeholder="PM2.5"
                                                value="{{ old('PM2_5', $dataSPKUA->PM2_5) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 pr-1">
                                            <div class="form-group">
                                                <label for="SO2" class="form">SO2</label>
                                                <input type="number" step="0.01" name="SO2" id="SO2"
                                                class="form-control" placeholder="SO2"
                                                value="{{ old('SO2', $dataSPKUA->SO2) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-3">
                                            <div class="form-group">
                                                <label for="CO" class="form">CO</label>
                                                <input type="number" step="0.01" name="CO" id="CO"
                                                class="form-control" placeholder="CO"
                                                value="{{ old('CO', $dataSPKUA->CO) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-3">
                                            <div class="form-group">
                                                <label for="O3" class="form">O3</label>
                                                <input type="number" step="0.01" name="O3" id="O3"
                                                class="form-control" placeholder="O3"
                                                value="{{ old('O3', $dataSPKUA->O3) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 pr-1">
                                            <div class="form-group">
                                                <label for="NO2" class="form">NO2</label>
                                                <input type="number" step="0.01" name="NO2" id="NO2"
                                                class="form-control" placeholder="NO2"
                                                value="{{ old('NO2', $dataSPKUA->NO2) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 px-3">
                                            <div class="form-group">
                                                <label for="HC" class="form">HC</label>
                                                <input type="number" step="0.01" name="HC" id="HC"
                                                class="form-control" placeholder="HC"
                                                value="{{ old('HC', $dataSPKUA->HC) }}">
                                        </div>
                                    </div>
                                </div>
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
                {{-- <nav> --}}
                {{-- <ul>
                    <li>
                        <a href="https://www.creative-tim.com">Creative Tim</a>
                    </li>
                    <li>
                        <a href="http://presentation.creative-tim.com">About Us</a>
                    </li>
                    <li>
                        <a href="http://blog.creative-tim.com">Blog</a>
                    </li>
                </ul> --}}
                {{-- </nav> --}}
                <div class="copyright" id="copyright">
                    &copy;
                    <script>
                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                    </script>, Designed and Developed by <span
                        style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan Hidup Surabaya </span>
                </div>
            </div>
        </footer>
    </div>
@endsection
