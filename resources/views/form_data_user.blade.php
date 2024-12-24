@extends('layouts.app2')

@section('content')
<div class="main-panel" id="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="#pablo">Tambah Data USER</a>
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
                        <h5 class="kop-surat" style="font-weight: bold">FORM TAMBAH DATA USER</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label for="name" class="form">name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label for="email" class="form">email</label>
                                        <input type="email" step="0.01" name="email" id="email" class="form-control" placeholder="email" required>
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="form-group">
                                        <label for="password" class="form">password</label>
                                        <input type="text" step="0.01" name="password" id="password" class="form-passwordntrol" placeholder="password" required>
                                    </div>
                                </div>
                                <div class="col-md-3 px-3">
                                    <div class="form-group">
                                        <label for="role" class="form">role</label>
                                        <input type="text" step="0.01" name="role" id="role" class="form-control" placeholder="role" required>
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
