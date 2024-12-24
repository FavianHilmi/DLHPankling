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
                    <a class="navbar-brand" href="#pablo">Data Pengguna</a>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pengguna</h4>
                            <button class="button-add" onclick="window.location.href='/register';">
                                <i class="bi bi-file-earmark-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th class="text-center">
                                            No.
                                        </th>
                                        <th class="text-center">
                                            Username
                                        </th>
                                        <th class="text-center">
                                            Email
                                        </th>
                                        <th class="text-center">
                                            Password
                                        </th>
                                        <th class="text-center">
                                            Role
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @if ($users->isEmpty())
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data tersedia</td>
                                            </tr>
                                        @else
                                            @foreach ($users as $data_user)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data_user['name'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data_user['email'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data_user['password'] }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data_user['role'] }}
                                                    </td>


                                                    <td class="text-center">
                                                        <a href="{{ route('data_user.edit', $data_user->id) }}"
                                                            class="btn btn-sm btn-primary"><img class="button-icons"
                                                                src="/storage/img/pencil-square.svg" alt="Edit Icon"
                                                                width="16" height="16"></a>
                                                        {{-- <form action="{{ route('data_user.destroy', $data_user->id) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE') --}}
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            data-toggle="modal"
                                                            data-target="#modalDelete{{ $data_user->id }}">
                                                            <img class="button-icons" src="/storage/img/trash3.svg"
                                                                alt="Edit Icon" width="16" height="16">
                                                        </button>
                                                        {{-- </form> --}}
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

            </div>
        </div>
        <footer class="footer">
            <div class=" container-fluid ">
                <nav>
                    {{-- <ul>
                    <li>
                        <a href="https://www.creative-tim.com">
                            Creative Tim
                        </a>
                    </li>
                    <li>
                        <a href="http://presentation.creative-tim.com">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="http://blog.creative-tim.com">
                            Blog
                        </a>
                    </li>
                </ul> --}}
                    <div class="copyright" id="copyright">
                        &copy;
                        <script>
                            document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                        </script>, Designed and Developed by <span
                            style="font-weight: bold; color: rgb(0, 0, 0);"> Dinas Lingkungan Hidup Surabaya </span>
                        {{-- <a href="https://www.invisionapp.com"
                        target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com"
                        target="_blank">Creative Tim</a>. --}}
                    </div>
                </nav>
            </div>
        </footer>

        {{-- Modal Delete --}}
        @foreach ($users as $data_user)
            <div class="modal fade" id="modalDelete{{ $data_user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <form action="{{ route('data_user.destroy', $data_user->id) }}" method="POST"
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
                                {{-- Are you sure you want to delete this item? --}}
                                <p>Anda yakin ingin mengahapus user <strong>{{ $data_user->name }}</strong>?</p>
                                <p>
                                    <strong>Note:</strong> Menghapus pengguna ini akan secara otomatis menghapus semua
                                    data yang dibuat oleh pengguna tersebut.
                                    Disarankan untuk tidak menghapusnya agar data tetap
                                    terjaga.
                                </p>
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
