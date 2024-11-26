@extends('layouts.app2')

@section('content')
<div class="main-panel" id="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="#pablo">Tambah Data Passive Sample</a>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="kop-surat" style="font-weight: bold">FORM TAMBAH DATA PASSIVE SAMPLE</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data_passive.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="pemasangan" class="form">Pemasangan</label>
                                        <input type="date" name="pemasangan" id="date" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="pelepasan" class="form">Pelepasan</label>
                                        <input type="date" name="pelepasan" id="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="semester" class="form">Semester</label>
                                        <input type="text" name="semester" id="semester" class="form-control" placeholder="Semester" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label for="SO2" class="form">SO2</label>
                                        <input type="number" step="0.01" name="SO2" id="so2" class="form-control" placeholder="SO2" required>
                                    </div>
                                </div>
                                <div class="col-md-4 px-3">
                                    <div class="form-group">
                                        <label for="NO2" class="form">NO2</label>
                                        <input type="number" step="0.01" name="NO2" id="no2" class="form-control" placeholder="NO2" required>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-8 pr-1">
                                    <div class="form-group">
                                        <label for="nama_lokasi" class="form">Nama lokasi</label>
                                        <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" placeholder="Lokasi" required>
                                    </div>
                                </div>
                                <div class="col-md-8 pr-1">
                                    <div class="form-group">
                                        <label for="titik_koordinat" class="form">Titik Koordinat</label>
                                        <input type="text" name="titik_koordinat" id="titik_koordinat" class="form-control" placeholder="Koordinat" required>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="kawasan" class="form">Kategori</label>
                                        <select name="kawasan_id" id="kawasan" class="form-control" required>
                                            <option value="">Pilih Kawasan</option>
                                            @foreach($data_kawasans as $kawasan)
                                                <option value="{{ $kawasan->id }}">{{ $kawasan->kawasan }}</option>
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
                </script>, Designed and Developed by <span style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan Hidup Surabaya </span>
            </div>
        </div>
    </footer>
</div>
@endsection
