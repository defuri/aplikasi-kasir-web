<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <title>Login</title>
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-sm" style="width: 22rem;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Kafe Sukamaju</h3>

                <!-- Menampilkan pesan kesalahan jika ada -->
                @if (session('error'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="defUsername" class="form-label">Username</label>
                        <input type="text" class="form-control @error('defUsername') is-invalid @enderror"
                            id="defUsername" placeholder="Masukkan username" name="defUsername" required>
                        @error('defUsername')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="defPassword" class="form-label">Password</label>
                        <input type="password" class="form-control @error('defPassword') is-invalid @enderror"
                            placeholder="Masukkan password" id="defPassword" name="defPassword" required>
                        @error('defPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
