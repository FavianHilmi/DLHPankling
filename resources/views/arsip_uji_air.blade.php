@extends('layouts.app2')

@section('content')
    <div class="main-panel" id="main-panel">

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div id="alert-box" class="alert alert-info alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div id="alert-box" class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
            </div>
        @endif

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
                    <a class="navbar-brand" href="#pablo">Data Kualitas Udara</a>
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


        <div class="panel-header panel-header-sm"></div>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Arsip Data Uji Kualitas Air Internal</h4>
                            <div class="button-container">
                                <button class="button-add" onclick="window.location.href='/form_arsip_uji_air';" data-bs-toggle="tooltip" title="Form Tambah Data">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </button>
                                <button class="button-save" data-toggle="modal" data-target="#exampleModalCenter" data-bs-toggle="tooltip" title="Unggah File(.xls .xlsx)">
                                    <i class="bi bi-upload"></i>
                                </button>
                                <button class="button-download" data-toggle="modal" onclick="downloadTemplate('ujiairinternal')" data-target="#exampleModalCenter" data-bs-toggle="tooltip" title="Unduh Template Excel">
                                    <i class="bi bi-download"></i>
                                </button>
                            </div>
                        </div>
                        @php
                            $months = [
                                '01' => 'Januari',
                                '02' => 'Februari',
                                '03' => 'Maret',
                                '04' => 'April',
                                '05' => 'Mei',
                                '06' => 'Juni',
                                '07' => 'Juli',
                                '08' => 'Agustus',
                                '09' => 'September',
                                '10' => 'Oktober',
                                '11' => 'November',
                                '12' => 'Desember',
                            ];
                        @endphp
                        <div class="card-body">
                            <form action="{{ url('/arsip_uji_air') }}" method="GET">
                                <div class="row d-flex justify-content-start mb-4">
                                    <div class="col-sm-2 mb-3">
                                        <label for="bulan" class="form-label" style="font-size: 12pt">Bulan</label>
                                        <select name="bulan" id="bulan" class="form-control" style="font-size: 12pt">
                                            <option value="">-- Pilih Bulan --</option>
                                            @foreach ($months as $key => $month)
                                                <option value="{{ $key }}"
                                                    {{ request('bulan') == $key ? 'selected' : '' }}>
                                                    {{ $month }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mb-3">
                                        <label for="tahun" class="form-label" style="font-size: 12pt">Tahun</label>
                                        <input name="tahun" type="text" id="tahun" class="form-control"
                                            style="font-size: 12pt" placeholder="Tahun" value="{{ request('tahun') }}">
                                    </div>
                                    <div class="col-sm-2 mb-3">
                                        <label for="nama_lokasi" class="form-label" style="font-size: 12pt">Lokasi</label>
                                        <input name="nama_lokasi" type="text" id="nama_lokasi" class="form-control"
                                            style="font-size: 12pt" placeholder="Lokasi" value="{{ request('nama_lokasi') }}">
                                    </div>
                                    <div class="col-sm-2 mb-3 d-flex flex-column">
                                        <div class="flex-grow-1"></div>
                                        <button class="button-save btn-primary w-100" type="submit">
                                            Cari
                                        </button>
                                    </div>

                                </div>
                            </form>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="table-responsive">
                                @php
                                    $columns = ['BOD', 'COD', 'TSS', 'DO', 'pH', 'total_coli', 'fecal_coli'];
                                    $sortIcons = function ($column) {
                                        if (request('sort_by') === $column) {
                                            return request('sort_order') === 'asc' ? '↑' : '↓';
                                        }
                                        return '';
                                    };
                                @endphp
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="color: #f96332"><a>No.</a></th>
                                            <th class="text-center" style="color: #f96332"><a>Bulan</a></th>
                                            <th class="text-center" style="color: #f96332"><a>Tahun</a></th>
                                            <th class="text-center" style="color: #f96332"><a>Lokasi</a></th>
                                            <th class="text-center" style="color: #f96332"><a>Koordinat</a></th>
                                            @foreach ($columns as $column)
                                                <th class="text-center">
                                                    <a
                                                        href="{{ route('arsip_uji_air.index', ['sort_by' => $column, 'sort_order' => request('sort_order') === 'asc' ? 'desc' : 'asc']) }}">
                                                        {{ ucfirst($column) }} {!! $sortIcons($column) !!}
                                                    </a>
                                                </th>
                                            @endforeach
                                            <th class="text-center" style="color: #f96332"><a>Kontributor</a></th>
                                            <th class="text-center" style="color: #f96332"><a>Status</a></th>
                                            <th class="text-center" style="color: #f96332"><a>Action</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($arsip_data_air_internals as $arsip_air)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration + ($arsip_data_air_internals->currentPage() - 1) * $arsip_data_air_internals->perPage() }}
                                                </td>
                                                <td class="text-center">{{ $arsip_air['bulan'] }}</td>
                                                <td class="text-center">{{ $arsip_air['tahun'] }}</td>
                                                <td class="text-center">{{ $arsip_air['nama_lokasi'] }}</td>
                                                <td class="text-center">
                                                    {{ substr($arsip_air->longitude . ', ' . $arsip_air->latitude, 0, 15) }}...
                                                </td>
                                                <td class="text-center">{{ $arsip_air['BOD'] }}</td>
                                                <td class="text-center">{{ $arsip_air['COD'] }}</td>
                                                <td class="text-center">{{ $arsip_air['TSS'] }}</td>
                                                <td class="text-center">{{ $arsip_air['DO'] }}</td>
                                                <td class="text-center">{{ $arsip_air['pH'] }}</td>
                                                <td class="text-center">{{ $arsip_air['total_coli'] }}</td>
                                                <td class="text-center">{{ $arsip_air['fecal_coli'] }}</td>
                                                <td class="text-center">
                                                    {{ $arsip_air->user ? $arsip_air->user->name : 'Nama tidak tersedia' }}
                                                </td>
                                                <td class="text-center">
                                                    <div
                                                        class="
                                            @if ($arsip_air['status'] === 'Sedang Diajukan') sedang-diajukan
                                            @elseif($arsip_air['status'] === 'Terverifikasi') terverifikasi
                                            @elseif($arsip_air['status'] === 'Perlu Revisi') perlu-revisi @endif">
                                                        {{ $arsip_air['status'] }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('arsip_uji_air.edit', $arsip_air->id) }}"
                                                        class="btn btn-sm btn-primary"><img class="button-icons"
                                                            src="/storage/img/pencil-square.svg" alt="Edit Icon"
                                                            width="16" height="16"></a>
                                                    {{-- <form action="{{ route('arsip_uji_air.destroy', $arsip_air->id) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE') --}}
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        data-toggle="modal" data-target="#modalDelete{{ $arsip_air->id }}">
                                                        <img class="button-icons" src="/storage/img/trash3.svg"
                                                            alt="Edit Icon" width="16" height="16">
                                                    </button>
                                                    {{-- </form> --}}
                                                    @if (Auth::user()->role === 'admin')
                                                        <div class="dropdown d-inline-block">
                                                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="now-ui-icons location_world"></i>
                                                            </button>

                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <!-- Approve Button -->
                                                                <form
                                                                    action="{{ route('arsip_uji_air.approve', $arsip_air->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="dropdown-item">Approve</button>
                                                                </form>

                                                                <!-- Perlu Revisi Button -->
                                                                <form
                                                                    action="{{ route('arsip_uji_air.revisi', $arsip_air->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">Perlu
                                                                        Revisi</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="24" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            @php
                                $currentPage = $arsip_data_air_internals->currentPage();
                                $perPage = $arsip_data_air_internals->perPage();
                                $totalItems = $arsip_data_air_internals->total();
                                $totalPages = $arsip_data_air_internals->lastPage();
                                $window = 2;
                            @endphp
                            @if ($totalPages > 1)
                                <div class="pagination justify-content-center">
                                    <ul class="pagination">

                                        <li class="page-item {{ $currentPage == 1 ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $arsip_data_air_internals->url(1) }}">1</a>
                                        </li>

                                        @if ($currentPage > $window + 1)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif

                                        @for ($i = max(2, $currentPage - $window); $i <= min($currentPage + $window, $totalPages - 1); $i++)
                                            <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $arsip_data_air_internals->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor

                                        @if ($currentPage < $totalPages - $window)
                                            <li class="page-item disabled"><span class="page-link">...</span></li>
                                        @endif

                                        <li class="page-item {{ $currentPage == $totalPages ? 'active' : '' }}">
                                            <a class="page-link"
                                                href="{{ $arsip_data_air_internals->url($totalPages) }}">{{ $totalPages }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            <div class="text-center mb-4">
                                Showing {{ $arsip_data_air_internals->firstItem() }} to {{ $arsip_data_air_internals->lastItem() }}</br>of
                                {{ $totalItems }} entries
                            </div>
                        </div>
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
                            document.write(new Date().getFullYear())
                        </script>,
                        Designed and Developed by <span style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas
                            Lingkungan
                            Hidup Surabaya </span>
                    </div>
                </nav>
            </div>
        </footer>

        <!-- Modal Import -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <form action="{{ route('arsip_uji_air.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Upload File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="custom-file-upload" for="file">
                                <div class="icon">
                                    <i class="now-ui-icons arrows-1_cloud-upload-94"
                                        style="font-size: 48px; color: #007bff;"></i> <!-- Ikon diubah ukurannya -->
                                </div>
                                <div class="text">
                                    <span>Click to upload file</span>
                                    <input type="file" id="file" name="file" accept=".xlsx, .xls" required>
                                </div>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-primary">Upload</button>
                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal Delete --}}
        @foreach ($arsip_data_air_internals as $arsip_air)
            <div class="modal fade" id="modalDelete{{ $arsip_air->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{ route('arsip_uji_air.destroy', $arsip_air->id) }}" method="POST"
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
