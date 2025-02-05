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
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-header-form">
                            <h5 class="kop-surat">PEMERINTAH KOTA SURABAYA</h5>
                            <h3 class="kop-surat" style="font-weight: bold">DINAS LINGKUNGAN HIDUP</h3>
                            <p class="kop-surat" style="font-weight: normal">Jl. Raya Menur No.31A, Manyar Sabrangan, Kec.
                                Mulyorejo, Surabaya, Jawa Timur 60285</p>
                            <p class="kop-surat" style="font-weight: normal">Telp. : 0987377121, Email :
                                dlhsurabaya@gmail.com</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('berita_acara.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="judul" class="form">Judul Berita</label>
                                            <input type="text" name="judul" class="form-control" placeholder="Judul">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 pr-1">
                                        <div class="form-group">
                                            <label for="tanggal" class="form">Tanggal</label>
                                            <input type="date" name="tanggal" class="form-control" placeholder="Tanggal">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi" class="form">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label for="nama_kolom_penguji" class="form">Nama Kolom</label>
                                            <input type="text" name="nama_kolom_penguji" class="form-control" placeholder="Nama Kolom Penguji">
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol untuk Menambah Kolom Penguji -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" id="add-penguji-btn" class="btn btn-info">
                                            <i class="now-ui-icons ui-1_simple-add"></i>
                                            Add Kolom Penguji
                                        </button>
                                    </div>
                                </div>

                                <div class="row" id="penguji-container" style="display: flex; align-items: center; gap: 15px;">
                                    <!-- Kolom Penguji Awal -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_penguji" class="form">Nama Penguji</label>
                                            <input type="text" name="penguji[0][nama_penguji]" id="nama_penguji" class="form-control" placeholder="Nama Penguji">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="instansi" class="form">Instansi</label>
                                            <input type="text" name="penguji[0][instansi]" id="instansi" class="form-control" placeholder="Instansi">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ttd" class="form">Tanda Tangan</label>
                                            <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                                                <button type="button" class="btn btn-primary" onclick="document.getElementById('ttd').click();">Upload File</button>
                                                <input type="file" id="ttd" name="penguji[0][ttd]" accept="image/*" style="display: none;">
                                                <span id="file_name" style="font-style: italic;">Tidak ada file dipilih</span>
                                                <span id="clear _file" style="cursor: pointer; color: red; display: none;" onclick="clearFile()">X</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>, Designed and Developed by <span
                            style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan Hidup Surabaya </span>
                    </div>
                </nav>
            </div>
        </footer>
    </div>
@endsection

@section('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .catch(error => {
            console.error(error);
        });
</script>
    <script>
        // JavaScript untuk menampilkan nama file
        document.getElementById('ttd').addEventListener('change', function(event) {
            const fileName = event.target.files[0]?.name || 'Tidak ada file dipilih';
            document.getElementById('file_name').textContent = fileName;
            document.getElementById('clear_file').style.display = 'inline'; // Tampilkan tombol silang
        });

        // Fungsi untuk membatalkan file yang dipilih
        function clearFile() {
            const fileInput = document.getElementById('ttd');
            fileInput.value = ''; // Reset input file
            document.getElementById('file_name').textContent = 'Tidak ada file dipilih'; // Reset nama file
            document.getElementById('clear_file').style.display = 'none'; // Sembunyikan tombol silang
        }
    </script>
    <!-- Link to external JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/add-penguji.js') }}"></script>
@endsection
