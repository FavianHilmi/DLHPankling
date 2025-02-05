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
                    <a class="navbar-brand" href="#pablo">Dashboard</a>
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
                            {{-- <button id="refreshChart" class="btn btn-primary"><i
                                    class="now-ui-icons loader_refresh spin"></i>Refresh</button> --}}
                                    <button id="refresh-chart-btn" class="btn btn-primary">Refresh Chart</button>
                                    <div id="chart-update-status"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="panel-header panel-header-sm">
            {{-- <canvas id="bigDashboardChart"></canvas> --}}
        </div>
        <div class="content">
            <div class="row">
                {{-- <div class="col-lg-4">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">*Berdasarkan Data Partikulat Mobile</h5>
                            <h4 class="card-title">Grafik Kualitas Udara</h4>
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="lineChartKualitasUdara"></canvas>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="card card-chart">
                        <div class="card-header">
                            <h5 class="card-category">*Berdasarkan Pengujian Internal</h5>
                            <h4 class="card-title">Grafik Kualitas Air</h4>
                            <div class="dropdown">
                                <button type="button"
                                    class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret"
                                    data-toggle="dropdown">
                                    <i class="now-ui-icons loader_gear"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                    <a class="dropdown-item text-danger" href="#">Remove Data</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="lineChartPM10"></canvas>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Berdasarkan Perhitungan Data KLHK</h5>
                            <h4 class="card-title"> Prediksi Kualitas Udara Selama 30 Hari (Tandes)</h4>
                            <div class="card-body" style="padding-bottom: 0">
                                <img class="linechart-img img-fluid" src="{{ asset('img/air_quality_linechart2.png') }}"
                                    alt="Air Quality Piechart">
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive">

                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-chart">
                        <div class="card-header" style="padding-bottom: 0">
                            <h5 class="card-category">Perhitungan 30 Hari</h5>
                            <h4 class="card-title">Distribusi Parameter yang Mempengaruhi Kualitas Udara</h4>
                        </div>
                        <div class="card-body" style="padding-bottom: 0">
                            <div class="chart-area">
                                <img class="chart-img" src="{{ asset('img/distribusi_param_spkua_piechart.png') }}"
                                    alt="Parameter">
                                {{-- <canvas id="barChartSimpleGradientsNumbers"></canvas> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Berdasarkan Perhitungan Data SPKUA</h5>
                            <h4 class="card-title"> Prediksi Kualitas Udara Selama 30 Hari (Wonorejo)</h4>
                            <div class="card-body" style="padding-bottom: 0">
                                <img class="linechart-img img-fluid" src="{{ asset('img/air_quality_linechart2.png') }}"
                                    alt="Air Quality Piechart">
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive">

                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-chart">
                        <div class="card-header" style="padding-bottom: 0">
                            <h5 class="card-category">Perhitungan 30 Hari</h5>
                            <h4 class="card-title">Distribusi Parameter yang Mempengaruhi Kualitas Udara</h4>
                        </div>
                        <div class="card-body" style="padding-bottom: 0">
                            <div class="chart-area">
                                <img class="chart-img" src="{{ asset('img/distribusi_param_spkua_piechart.png') }}"
                                    alt="Parameter">
                                {{-- <canvas id="barChartSimpleGradientsNumbers"></canvas> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Berdasarkan Perhitungan Data SPKUA</h5>
                            <h4 class="card-title"> Prediksi Kualitas Udara Selama 30 Hari (Kebonsari)</h4>
                            <div class="card-body" style="padding-bottom: 0">
                                <img class="linechart-img img-fluid" src="{{ asset('img/air_quality_linechart2.png') }}"
                                    alt="Air Quality Piechart">
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive">

                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card card-chart">
                        <div class="card-header" style="padding-bottom: 0">
                            <h5 class="card-category">Perhitungan 30 Hari</h5>
                            <h4 class="card-title">Distribusi Parameter yang Mempengaruhi Kualitas Udara</h4>
                        </div>
                        <div class="card-body" style="padding-bottom: 0">
                            <div class="chart-area">
                                <img class="chart-img" src="{{ asset('img/distribusi_param_spkua_piechart.png') }}"
                                    alt="Parameter">
                                {{-- <canvas id="barChartSimpleGradientsNumbers"></canvas> --}}
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <i class="now-ui-icons ui-2_time-alarm"></i> Last 7 days
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Prediksi Kualitas Udara untuk 30 Hari Mendatang</h4>
                        </div>
                        {{-- <div class="card-body">
                            <canvas id="airQualityChart"></canvas>
                            <div id="chart-data"
                                 data-labels="{{ $labels }}"
                                 data-pm10="{{ $PM10 }}"
                                 data-pm25="{{ $PM2_5 }}">
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <img class="linechart-img img-fluid" src="{{ asset('img/linechart_wonorejo.png') }}"
                                alt="Air Quality Piechart">
                        </div>

                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Prediksi Kualitas Udara untuk 30 Hari Mendatang</h4>
                        </div>
                        {{-- <div class="card-body">
                            <canvas id="airQualityChart"></canvas>
                            <div id="chart-data"
                                 data-labels="{{ $labels }}"
                                 data-pm10="{{ $PM10 }}"
                                 data-pm25="{{ $PM2_5 }}">
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <img class="linechart-img img-fluid" src="{{ asset('img/linechart_kebonsari.png') }}"
                                alt="Air Quality Piechart">
                        </div>

                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-tasks">
                        <div class="card-header" style="padding-bottom: 0px">

                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Prediksi Kualitas Udara untuk 30 Hari Mendatang</h4>
                        </div>
                        <div class="card-body" style="padding-bottom: 0px">
                            <img class="piechart-wono-kebon-img img-fluid"
                                src="{{ asset('img/distribusi_param_kedua_lokasi.png') }}" alt="Air Quality Piechart">
                        </div>

                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Tasks</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-full-width table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-left">Sign contract for "What are conference organizers afraid
                                                of?"</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title=""
                                                    class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                    data-original-title="Edit Task">
                                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title=""
                                                    class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                    data-original-title="Remove">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-left">Lines From Great Russian Literature? Or E-mails From My
                                                Boss?</td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title=""
                                                    class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                    data-original-title="Edit Task">
                                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title=""
                                                    class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                    data-original-title="Remove">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" checked>
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-left">Flooded: One year later, assessing what was lost and what
                                                was found when a ravaging rain swept through metro Detroit
                                            </td>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title=""
                                                    class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                    data-original-title="Edit Task">
                                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title=""
                                                    class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
                                                    data-original-title="Remove">
                                                    <i class="now-ui-icons ui-1_simple-remove"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">All Persons List</h5>
                            <h4 class="card-title"> Employees Stats</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Country
                                        </th>
                                        <th>
                                            City
                                        </th>
                                        <th class="text-right">
                                            Salary
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Dakota Rice
                                            </td>
                                            <td>
                                                Niger
                                            </td>
                                            <td>
                                                Oud-Turnhout
                                            </td>
                                            <td class="text-right">
                                                $36,738
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Minerva Hooper
                                            </td>
                                            <td>
                                                Curaçao
                                            </td>
                                            <td>
                                                Sinaai-Waas
                                            </td>
                                            <td class="text-right">
                                                $23,789
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Sage Rodriguez
                                            </td>
                                            <td>
                                                Netherlands
                                            </td>
                                            <td>
                                                Baileux
                                            </td>
                                            <td class="text-right">
                                                $56,142
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Doris Greene
                                            </td>
                                            <td>
                                                Malawi
                                            </td>
                                            <td>
                                                Feldkirchen in Kärnten
                                            </td>
                                            <td class="text-right">
                                                $63,542
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Mason Porter
                                            </td>
                                            <td>
                                                Chile
                                            </td>
                                            <td>
                                                Gloucester
                                            </td>
                                            <td class="text-right">
                                                $78,615
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Rata-rata Kualitas Udara tahunan di Wonorejo dan Kebonsari (2019-2024)
                            </h4>
                        </div>
                        {{-- <div class="card-body">
                            <canvas id="airQualityChart"></canvas>
                            <div id="chart-data"
                                 data-labels="{{ $labels }}"
                                 data-pm10="{{ $PM10 }}"
                                 data-pm25="{{ $PM2_5 }}">
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <img class="linechart-img img-fluid" src="{{ asset('img/air_quality_average_WonKeb.png') }}"
                                alt="Air Quality Average">
                        </div>

                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Rata-rata Kualitas Udara tahunan di Wonorejo dan Kebonsari (2019-2024)
                            </h4>
                        </div>
                        {{-- <div class="card-body">
                            <canvas id="airQualityChart"></canvas>
                            <div id="chart-data"
                                 data-labels="{{ $labels }}"
                                 data-pm10="{{ $PM10 }}"
                                 data-pm25="{{ $PM2_5 }}">
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <img class="linechart-img img-fluid" src="{{ asset('img/water_quality_by_year.png') }}"
                                alt="Water Quality">
                        </div>

                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card  card-tasks">
                        <div class="card-header ">
                            <h5 class="card-category">Backend development</h5>
                            <h4 class="card-title">Rata-rata Kualitas Udara tahunan di Wonorejo dan Kebonsari (2019-2024)
                            </h4>
                        </div>
                        {{-- <div class="card-body">
                            <canvas id="airQualityChart"></canvas>
                            <div id="chart-data"
                                 data-labels="{{ $labels }}"
                                 data-pm10="{{ $PM10 }}"
                                 data-pm25="{{ $PM2_5 }}">
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <img class="linechart-img img-fluid" src="{{ asset('img/water_quality_distribution.png') }}"
                                alt="Water Quality Distribution">
                        </div>

                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="now-ui-icons loader_refresh spin"></i> Updated 3 minutes ago
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
        <script>
            document.getElementById('refresh-chart-btn').addEventListener('click', function() {
                fetch('{{ route('refresh.chart') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const statusDiv = document.getElementById('chart-update-status');
                        if (data.success) {
                            statusDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                            // Reload gambar chart
                            const chartImg = document.getElementById('chart-img');
                            chartImg.src = chartImg.src.split('?')[0] + '?' + new Date().getTime();
                        } else {
                            statusDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
    </div>
@endsection
