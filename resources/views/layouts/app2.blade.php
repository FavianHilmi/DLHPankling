<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>

<body>
    <div class="wrapper">
        @if (Auth::user()->role === 'admin')
        @include('partials.admin-sidebar')
        @elseif (Auth::user()->role === 'user')
        @include('partials.sidebar')
        @endif
        <div class="main-panel" id="main-panel">
            @yield('content')
        </div>
    </div>
    <!-- Core JS Files -->

    <script src="{{ asset('../assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script src="{{ asset('../assets/js/linechart.js') }}"></script> --}}
    <script src="{{ asset('assets/js/linechart.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/ckeditor.js') }}"></script>
    <script src="{{ asset('../assets/js/core/tooltips.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/js/add-penguji.js') }}"></script>
    {{-- maps leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('../assets/js/map-script.js') }}"></script>



    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}

    <script src="{{ asset('../assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('../assets/js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('../assets/demo/demo.js') }}"></script>
    <script src="{{ asset('../assets/js/dropdown.js') }}"></script>
    {{-- <script src="{{ asset('js/linechart.js') }}"></script> --}}
    <script src="{{ asset('../assets/js/dashboard-chart.js') }}"></script>
    <script src="{{ asset('../assets/js/tooltip.js') }}"></script>
    {{-- <script src="{{ asset('../assets/js/download-excel.js') }}"></script> --}}
    <script src="{{ asset('assets/js/download-excel.js') }}"></script>

    <script src="{{ asset('../assets/js/alert-box.js') }}"></script>
    <script src="{{ asset('../assets/js/dropdown-isactive.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    @yield('scripts')

    <script>
        $(document).ready(function() {
            demo.initDashboardPageCharts();

        });
    </script>
</body>

</html>
