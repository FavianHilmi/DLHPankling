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
            <!-- Your main content will go here -->

            @yield('content')
        </div>
    </div>
    <!-- Core JS Files -->
    <script src="{{ asset('../assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('../assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('../assets/js/core/ckeditor.js') }}"></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Pastikan jQuery sudah dimuat -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Link ke file JavaScript terpisah -->
    <script src="{{ asset('assets/js/add-penguji.js') }}"></script>

    <!--  Google Maps Plugin    -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}

    <!-- Chart JS -->
    <script src="{{ asset('../assets/js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('../assets/js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/now-ui-dashboard.min.js?v=1.5.0') }}" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('../assets/demo/demo.js') }}"></script>
    <script src="{{ asset('../assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('../assets/js/dashboard-chart.js') }}"></script>

    <script src="{{ asset('../assets/js/dropdown-isactive.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    @yield('scripts')

    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
</body>

</html>
