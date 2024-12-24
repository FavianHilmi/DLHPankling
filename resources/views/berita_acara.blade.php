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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Berita Acara</h4>
                            <button class="button-add" onclick="window.location.href='/form_berita_acara';">
                                <i class="bi bi-file-earmark-plus"></i>
                                {{-- <i class="now-ui-icons ui-1_simple-add" style="color: white; font-weight:bold;"></i> --}}
                                {{-- <span class="lable">Buat Berita Acara</span> --}}
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
                                        {{-- <th class="text-center">
                                            Deskripsi
                                        </th> --}}
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
                                                    {{-- <td class="text-center">
                                                        {{ substr($berita['deskripsi'], 0, 50) }}...
                                                    </td> --}}
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
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="now-ui-icons location_world"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                                @if (Auth::user()->role === 'admin')
                                                                    <!-- Approve Button -->
                                                                    <form
                                                                        action="{{ route('berita_acara.approve', $berita->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="dropdown-item">Approve</button>
                                                                    </form>

                                                                    <!-- Perlu Revisi Button -->
                                                                    <form
                                                                        action="{{ route('berita_acara.revisi', $berita->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="dropdown-item">Perlu
                                                                            Revisi</button>
                                                                    </form>
                                                                @endif
                                                                <!-- Edit Button -->
                                                                <form action="{{ route('berita_acara.edit', $berita->id) }}"
                                                                    method="GET">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="dropdown-item">Edit</button>
                                                                </form>
                                                                <!-- Hapus Button -->
                                                                {{-- <form
                                                                    action="{{ route('berita_acara.destroy', $berita->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE') --}}
                                                                    <button type="submit" class="dropdown-item"
                                                                    data-toggle="modal" data-target="#modalDeleteBerita">Hapus</button>
                                                                {{-- </form> --}}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- @if ($berita['status'] === 'Terverifikasi') --}}
                                                        <a href="{{ route('generatePDF.index', ['id' => $berita->id]) }}"
                                                            class="btn btn-sm btn-primary">
                                                            Buka PDF
                                                        </a>
                                                        {{-- @endif --}}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <nav>

                            <div class="copyright" id="copyright">
                                &copy;
                                <script>
                                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                                </script>, Designed and Developed by <span
                                    style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas
                                    Lingkungan Hidup Surabaya </span>
                            </div>
                        </nav>
                    </div>
                </footer>
            </div>
            <script>
                document.getElementById('showInfoBtn').addEventListener('click', function() {
                    const infoCard = document.getElementById('infoCard');

                    // animasi fade-in card
                    infoCard.style.display = 'block';
                    infoCard.classList.add('show');
                    infoCard.classList.remove('hide');

                    // hide card setelah 5s
                    setTimeout(() => {
                        infoCard.classList.add('hide');
                        infoCard.classList.remove('show');

                        // hapus elemen setelah animasi selesai
                        setTimeout(() => {
                            infoCard.style.display = 'none';
                        }, 500);
                    }, 5000);
                });
            </script>


        </div>
        {{-- Modal Delete --}}
        @foreach ($beritas as $berita_acara)
            <div class="modal fade" id="modalDeleteBerita" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{ route('berita_acara.destroy', $berita_acara->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this item?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@endsection
