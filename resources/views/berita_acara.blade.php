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
                            <h4 class="card-title">Data Berita Acara</h4>
                            <button class="button-add" onclick="window.location.href='/form_berita_acara';">
                                <i class="now-ui-icons ui-1_simple-add" style="color: white; font-weight:bold;"></i>
                                <span class="lable">Buat Berita Acara</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary" style="font-weight: bold">
                                        <th class="text-center mx-auto">
                                            No.
                                        </th>
                                        <th class="text-center">
                                            Judul
                                        </th>
                                        <th class="text-center">
                                            Tanggal
                                        </th>
                                        <th class="text-center">
                                            Deskripsi
                                        </th>
                                        <th class="text-center">
                                            Penulis
                                        </th>
                                        <th class="text-center">
                                            Status
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                        <th class="text-center">
                                            File PDF
                                        </th>
                                    </thead>
                                    <tbody>
                                        @if ($beritas->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($beritas as $berita)
                                                <tr wire:poll>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ substr($berita['judul'], 0, 35) }}...
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $berita['tanggal'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ substr($berita['deskripsi'], 0, 50) }}...
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $berita->user ? $berita->user->name : 'Nama tidak tersedia' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div
                                                            class="
                                                    @if ($berita['status'] === 'Sedang Diajukan') sedang-diajukan
                                                    @elseif($berita['status'] === 'Terverifikasi') terverifikasi
                                                    @elseif($berita['status'] === 'Perlu Revisi') perlu-revisi @endif">
                                                            {{ $berita['status'] }}
                                                        </div>
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{ route('berita_acara.edit', $berita->id) }}"
                                                            class="btn btn-sm btn-primary">Edit</a>
                                                        {{-- <button class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#editModal"
                                                            data-id="{{ $berita->id }}"
                                                            data-judul="{{ $berita->judul }}"
                                                            data-tanggal="{{ $berita->tanggal }}"
                                                            data-deskripsi="{{ $berita->deskripsi }}">
                                                            Edit
                                                        </button> --}}

                                                        <form action="{{ route('berita_acara.destroy', $berita->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($berita['status'] === 'Terverifikasi')
                                                            <form action="{{ route('berita_acara.download') }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $berita->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-primary">Unduh</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                {{-- MODAL DELETE --}}
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <form id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Berita Acara</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('berita_acara.update', $beritaAcara->id) }}"
                                                    method="POST" id="editForm">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="judul">Judul</label>
                                                        <input type="text" name="judul" id="judul"
                                                            class="form-control"
                                                            value="{{ old('judul', $berita->judul) }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" name="tanggal" id="tanggal"
                                                            class="form-control"
                                                            value="{{ old('tanggal', $berita->tanggal) }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi">Deskripsi</label>
                                                        <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Perbarui</button>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

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
                                    style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan Hidup Surabaya
                                </span>

                            </div>
                        </nav>
                    </div>
                </footer>
            </div>
            <script>
                $('#deleteModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button yang diklik untuk membuka modal
                    var beritaId = button.data('id'); // Ambil ID dari atribut data-id
                    var modal = $(this);
                    // Set action form dengan ID berita yang benar
                    modal.find('#deleteForm').attr('action', '/berita_acara/' + beritaId);
                });

                $(document).on('click', '[data-toggle="modal"]', function(event) {
                    var button = $(event.relatedTarget); // Tombol yang diklik
                    var beritaId = button.data('id');
                    var judul = button.data('judul');
                    var tanggal = button.data('tanggal');
                    var deskripsi = button.data('deskripsi');
                    var modal = $('#editModal'); // Modal yang sedang dibuka

                    // Mengisi input form dengan data lama
                    modal.find('#judul').val(judul);
                    modal.find('#tanggal').val(tanggal);
                    modal.find('#deskripsi').val(deskripsi);

                    // Sesuaikan action form untuk mengarahkan ke route update yang sesuai
                    modal.find('#editForm').attr('action', '/berita_acara/' + beritaId);
                });
            </script>
        </div>
    </div>
@endsection
