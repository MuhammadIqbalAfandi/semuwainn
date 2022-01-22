<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{ config('app.name', 'Semuwainn Sentani') }} Dashboard</title>

    <!-- Favico -->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}" />
    <!-- chartjs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/chart.js/Chart.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Daterange Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <x-dashboard-layout.navbar />

        <x-dashboard-layout.sidebar />

        {{ $slot }}

        <x-dashboard-layout.footer />

    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Moments -->
    <script src="{{ asset('adminlte/plugins/moment/moment-with-locales.min.js') }}"></script>
    <!-- Daterange Picker -->
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}">
    </script>
    <!-- Chartjs -->
    <script src=" {{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Loadash -->
    <script src="{{ asset('js/lodash@4.17.21/lodash.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- Scripts -->
    <script>
        const idMoneyFormat = (number) => {
            return new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR'
            }).format(number)
        }

        const Toast = Swal.mixin({
            toast: true,
            position: "bottom-start",
            showConfirmButton: false,
            timer: 3000,
        })

        function alert(message, status) {
            switch (status) {
                case 'success':
                    Toast.fire({
                        icon: 'success',
                        title: message,
                    })
                    break;
                case 'failed':
                    Toast.fire({
                        icon: 'error',
                        title: message,
                    })
                    break;
            }
        }

        $(document).keypress((e) => {
            if (e.which == '13') {
                e.preventDefault();
            }
        })
    </script>

    @stack('scripts')
</body>

</html>
