<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <style>
        @font-face {
            font-family: 'Open Sans';
            src: url('./public/fonts/OpenSans-VariableFont_wdth_wght.ttf') format('truetype');
            font-style: normal font-weight: normal;
        }

        body {
            font-family: 'Open Sans', serif;
        }

    </style>
</head>

<body>
    {{ $slot }}
</body>

</html>
