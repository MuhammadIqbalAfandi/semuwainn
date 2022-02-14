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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}" />
    <!-- ChartJS -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/chart.js/Chart.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Trix-Editor -->
    <link rel="stylesheet" href="{{ asset('css/trix/trix.css') }}">
    <!-- FilePond -->
    <link rel="stylesheet" href="{{ asset('css/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filepond/filepond-plugin-image-preview.css') }}">
    <!-- VanilaJS DatePicker -->
    <link rel="stylesheet" href="{{ asset('css/vanillajs-datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vanillajs-datepicker/datepicker-bs4.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Trix-Editor */
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

    </style>
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
    <!-- AdminLTE -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Trix Editor -->
    <script src="{{ asset('js/trix/trix.js') }}"></script>
    <!-- FilePond -->
    <script src="{{ asset('js/filepond/filepond-plugin-image-preview.js') }}">
    </script>
    <script src="{{ asset('js/filepond/filepond-plugin-file-validate-size.js') }}">
    </script>
    <script src="{{ asset('js/filepond/filepond-plugin-image-exif-orientation.js') }}">
    </script>
    <script src="{{ asset('js/filepond/filepond-plugin-file-validate-type.js') }}">
    </script>
    <script src="{{ asset('js/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('js/filepond/filepond.jquery.js') }}"></script>
    <!-- VanilaJS DatePicker -->
    <script src="{{ asset('js/vanillajs-datepicker/datepicker-full.min.js') }}"></script>
    <script src="{{ asset('js/vanillajs-datepicker/i18n/id.js') }}"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const idMoneyFormat = (number) => {
            return new Intl.NumberFormat('id', {
                style: 'currency',
                currency: 'IDR'
            }).format(number)
        }

        // Datatables
        $.extend($.fn.dataTable.defaults, {
            'stateSave': true,
            'responsive': true,
            'processing': true,
            'scrollX': true,
            'autoWidth': false,
            'language': {
                'url': "{{ asset('js/datatables/i18n/id.json') }}"
            }
        })

        // SweetAlert
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

        // Trix-Editor
        $('trix-file-accept').on(function(e) {
            e.preventDefault()
        })

        @if (session('success'))
            alert("{{ session('success') }}", 'success')
        @elseif (session('failed'))
            alert("{{ session('failed') }}", 'failed')
        @endif
    </script>
    @stack('scripts')
</body>

</html>
