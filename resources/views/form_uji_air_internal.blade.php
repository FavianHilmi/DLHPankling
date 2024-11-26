@extends('layouts.app2')

@section('content')
<div class="main-panel" id="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="#pablo">Tambah Data Uji Air</a>
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
                        <h5 class="kop-surat" style="font-weight: bold">FORM TAMBAH DATA UJI KUALITAS AIR INTERNAL</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('uji_air_internal.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="tanggal" class="form">Tanggal</label>
                                        <input type="date" name="tanggal" id="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label for="nama_lokasi" class="form">Lokasi</label>
                                        <input type="text" name="nama_lokasi" id="nama_lokasi" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-5 px-3">
                                    <div class="form-group">
                                        <label for="wilayah_lokasi" class="form">Wilayah</label>
                                        <input type="text" name="wilayah_lokasi" id="wilayah_lokasi" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8 pr-1">
                                    <div class="form-group">
                                        <label for="titik_koordinat" class="form">Titik Koordinat</label>
                                        <input type="text" name="titik_koordinat" id="titik_koordinat" class="form-control" placeholder="Koordinat" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="pH" class="form">pH</label>
                                        <input type="number" step="0.01" name="pH" id="pH" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="DO" class="form">DO</label>
                                        <input type="number" step="0.01" name="DO" id="DO" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="BOD" class="form">BOD</label>
                                        <input type="number" step="0.01" name="BOD" id="BOD" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="COD" class="form">COD</label>
                                        <input type="number" step="0.01" name="COD" id="COD" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="TSS" class="form">TSS</label>
                                        <input type="number" step="0.01" name="TSS" id="TSS" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="nitrat" class="form">nitrat</label>
                                        <input type="number" step="0.01" name="nitrat" id="nitrat" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="fosfat" class="form">fosfat</label>
                                        <input type="number" step="0.01" name="fosfat" id="fosfat" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="fecal_coli" class="form">fecal_coli</label>
                                        <input type="number" step="0.01" name="fecal_coli" id="fecal_coli" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="kelas" class="form">kelas</label>
                                        <input type="number" step="0.01" name="kelas" id="kelas" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="kawasan" class="form">Kawasan</label>
                                        <select name="kawasan_id" id="kawasan" class="form-control" required>
                                            <option value="">Pilih Kawasan</option>
                                            @foreach($data_kawasans as $kawasan)
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
