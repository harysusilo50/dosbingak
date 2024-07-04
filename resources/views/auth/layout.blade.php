<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/unj.png') }}" type="image/x-icon">
    @include('layout.css')
    <title>@yield('title') | Sistem Informasi Dosen Pembimbing Akademik</title>
</head>

<body class="bg-light">
    <!-- Outer Row -->
    @yield('content')
   
    @include('layout.js')
</body>

</html>
