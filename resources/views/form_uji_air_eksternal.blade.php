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
                    <div class="card-header-form">
                        <h5 class="kop-surat" style="font-weight: bold">FORM TAMBAH DATA UJI KUALITAS AIR EKSTERNAL</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('uji_air_eksternal.store') }}" method="POST">
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
                                        <label for="longitude" class="form">Koordinat X</label>
                                        <input type="text" name="longitude" id="longitude" class="form-control" placeholder="longitude" required>
                                    </div>
                                </div>
                                <div class="col-md-8 pr-1">
                                    <div class="form-group">
                                        <label for="latitude" class="form">Koordinat Y</label>
                                        <input type="text" name="latitude" id="latitude" class="form-control" placeholder="latitude" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="temperature" class="form">Temperature</label>
                                        <input type="number" step="0.01" name="temperature" id="temperature" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="TDS" class="form">TDS</label>
                                        <input type="number" step="0.01" name="TDS" id="TDS" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="TSS" class="form">TSS</label>
                                        <input type="number" step="0.01" name="TSS" id="TSS" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="colour" class="form">Colour</label>
                                        <input type="number" step="0.01" name="colour" id="colour" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="pH" class="form">pH</label>
                                        <input type="number" step="0.01" name="pH" id="pH" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="BOD" class="form">BOD</label>
                                        <input type="number" step="0.01" name="BOD" id="BOD" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="COD" class="form">COD</label>
                                        <input type="number" step="0.01" name="COD" id="COD" class="form-control" required>
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
                                        <label for="sulfate" class="form">Sulfate</label>
                                        <input type="number" step="0.01" name="sulfate" id="sulfate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="chloride" class="form">Chloride</label>
                                        <input type="number" step="0.01" name="chloride" id="chloride" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="nitrate" class="form">Nitrate</label>
                                        <input type="number" step="0.01" name="nitrate" id="nitrate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="nitrite" class="form">Nitrite</label>
                                        <input type="number" step="0.01" name="nitrite" id="nitrite" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="ammonia" class="form">Ammonia</label>
                                        <input type="number" step="0.01" name="ammonia" id="ammonia" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="total_n" class="form">Total-N</label>
                                        <input type="number" step="0.01" name="total_n" id="total_n" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group" style="font-size: 8pt">
                                        <label for="total_phosphate" class="form">Total Phosphate</label>
                                        <input type="number" step="0.01" name="total_phosphate" id="total_phosphate" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="fluoride" class="form">Fluoride</label>
                                        <input type="number" step="0.01" name="fluoride" id="fluoride" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="sulfide" class="form">Sulfide</label>
                                        <input type="number" step="0.01" name="sulfide" id="sulfide" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="cyanide" class="form">Cyanide</label>
                                        <input type="number" step="0.01" name="cyanide" id="cyanide" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group" style="font-size: 8pt">
                                        <label for="free_chlorine" class="form">Free Chlorine</label>
                                        <input type="number" step="0.01" name="free_chlorine" id="free_chlorine" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="boron" class="form">Boron</label>
                                        <input type="number" step="0.01" name="boron" id="boron" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="mercury" class="form">Mercury</label>
                                        <input type="number" step="0.01" name="mercury" id="mercury" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="arsenic" class="form">Arsenic</label>
                                        <input type="number" step="0.01" name="arsenic" id="arsenic" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="selenium" class="form">Selenium</label>
                                        <input type="number" step="0.01" name="selenium" id="selenium" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="cadmium" class="form">Cadmium</label>
                                        <input type="number" step="0.01" name="cadmium" id="cadmium" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="cobalt" class="form">Cobalt</label>
                                        <input type="number" step="0.01" name="cobalt" id="cobalt" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="nickel" class="form">Nickel</label>
                                        <input type="number" step="0.01" name="nickel" id="nickel" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="zinc" class="form">Zinc</label>
                                        <input type="number" step="0.01" name="zinc" id="zinc" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="copper" class="form">Copper</label>
                                        <input type="number" step="0.01" name="copper" id="copper" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="lead" class="form">Lead(Pb)</label>
                                        <input type="number" step="0.01" name="lead" id="lead" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group" style="font-size: 8pt">
                                        <label for="hexavalent_chromium" class="form">Hexavalent Chromium</label>
                                        <input type="number" step="0.01" name="hexavalent_chromium" id="hexavalent_chromium" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 pr-1">
                                    <div class="form-group" style="font-size: 8pt">
                                        <label for="oil_and_grease" class="form">Oil and Grease</label>
                                        <input type="number" step="0.01" name="oil_and_grease" id="oil_and_grease" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="surfactants" class="form">Surfactants</label>
                                        <input type="number" step="0.01" name="surfactants" id="surfactants" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="phenol" class="form">Phenol</label>
                                        <input type="number" step="0.01" name="phenol" id="phenol" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group" style="font-size: 8pt">
                                        <label for="fecal_coli" class="form">Fecal Coliform</label>
                                        <input type="number" step="0.01" name="fecal_coli" id="fecal_coli" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group" style="font-size: 8pt">
                                        <label for="total_coli" class="form">Total Coliform</label>
                                        <input type="number" step="0.01" name="total_coli" id="total_coli" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label for="waste" class="form">waste</label>
                                        <input type="number" step="0.01" name="waste" id="waste" class="form-control" required>
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
                                <div class="form-group" style="margin-left: 15px; margin-top: 35px; display: flex; align-items: center;">
                                    <!-- Input tersembunyi untuk nilai default 0 -->
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
