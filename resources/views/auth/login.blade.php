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
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Masuk!</h1>
                    </div>
                    <form class="user" action="{{ route('auth.login.process') }}" method="POST">
                        @csrf
                        @if (isset($pesan))
                            @if ($pesan['status'] == 'berhasil')
                            <div class="alert alert-success" role="alert">
                                {{ $pesan['pesan'] }}
                            </div>
                            @else
                            <div class="alert alert-danger" role="alert">
                                {{ $pesan['pesan'] }}
                            </div>
                            @endif
                        @else

                        @endif
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user"
                               name="email" id="email"
                                placeholder="Masukkan email...">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user"
                               name="password" id="password" placeholder="Masukkan password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
