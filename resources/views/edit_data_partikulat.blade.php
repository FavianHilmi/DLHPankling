@extends('layouts.app2')

@section('content')
    <div class="main-panel" id="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">Tambah Data Partikulat</a>
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
                            <h5 class="kop-surat" style="font-weight: bold">FORM TAMBAH DATA PARTIKULAT</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('data_partikulat.update', $dataPartikulat->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="tahun" class="form">Tahun</label>
                                            <input type="text" name="tahun" class="form-control" placeholder="tahun"
                                                value="{{ old('tahun', $dataPartikulat->tahun) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label for="TPM" class="form">TPM</label>
                                            <input type="number" step="0.01" name="TPM" class="form-control"
                                                placeholder="TPM" value="{{ old('TPM', $dataPartikulat->TPM) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="form-group">
                                            <label for="PM10" class="form">PM10</label>
                                            <input type="number" step="0.01" name="PM10" class="form-control"
                                                placeholder="PM10" value="{{ old('PM10', $dataPartikulat->PM10) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 px-3">
                                        <div class="form-group">
                                            <label for="PM2_5" class="form">PM2,5</label>
                                            <input type="number" step="0.01" name="PM2_5" class="form-control"
                                                placeholder="PM2_5" value="{{ old('PM2_5', $dataPartikulat->PM2_5) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 pr-1">
                                        <div class="form-group">
                                            <label for="nama_lokasi" class="form">Nama lokasi</label>
                                            <input type="text" name="nama_lokasi" class="form-control"
                                                placeholder="nama_lokasi"
                                                value="{{ old('nama_lokasi', $dataPartikulat->nama_lokasi) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-8 pr-1">
                                        <div class="form-group">
                                            <label for="longitude" class="form">Titik Koordinat X</label>
                                            <input type="text" name="longitude" class="form-control"
                                                placeholder="longitude"
                                                value="{{ old('longitude', $dataPartikulat->longitude) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="latitude" class="form">Titik Koordinat Y</label>
                                            <input type="text" name="latitude" class="form-control"
                                                placeholder="latitude" value="{{ old('latitude', $dataPartikulat->latitude) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="kawasan" class="form">Kategori</label>
                                            <select name="kawasan_id" id="kawasan" class="form-control" required>
                                                <option value="">Pilih Kawasan</option>
                                                @foreach ($data_kawasans as $kawasan)
                                                    <option value="{{ $kawasan->id }}"
                                                        {{ old('kawasan_id', $dataPartikulat->kawasan_id ?? '') == $kawasan->id ? 'selected' : '' }}>
                                                        {{ $kawasan->kawasan }}
                                                    </option>
                                                @endforeach
                                            </select>
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
