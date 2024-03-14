<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>KASIR</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
</head>

<body class="">
    <div>
        <ul>
            <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            @if (session('user')->peran == 'admin')
            <li><a href="{{ route('pengguna.index') }}">Penguna</a></li>
            @endif
            <li><a href="{{ route('produk.index') }}">Produk</a></li>
            <li><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li><a href="{{ route('penjualan.index') }}">Penjualan</a></li>
            <li><a href="{{ route('riwayat.index') }}">Riwayat</a></li>
            <li><a href="{{ route('auth.logout.process') }}">Logout</a></li>
        </ul>
    </div>
    @yield('content')

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
