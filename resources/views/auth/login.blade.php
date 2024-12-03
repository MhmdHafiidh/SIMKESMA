<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>SIMKESMA</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #3a8de3 0%, #6fb3ff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            animation: backgroundAnimation 8s ease-in-out infinite alternate;
        }

        @keyframes backgroundAnimation {
            0% {
                background: linear-gradient(135deg, #3a8de3 0%, #6fb3ff 100%);
            }

            100% {
                background: linear-gradient(135deg, #6fb3ff 0%, #3a8de3 100%);
            }
        }

        .login-card {
            max-width: 400px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            padding: 2rem;
            text-align: center;
            animation: cardAnimation 0.8s ease-out;
        }

        @keyframes cardAnimation {
            from {
                transform: translateY(20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo-container img {
            width: 60px;
            margin: 0 8px;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: scale(1.1);
        }

        .login-card h4 {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 25px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            border-radius: 25px;
            width: 100%;
            background-color: #3a8de3;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #3278c5;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #3a8de3;
        }

        .text-muted a {
            color: #3a8de3;
            transition: color 0.3s ease;
        }

        .text-muted a:hover {
            color: #3278c5;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="logo-container d-flex justify-content-center align-items-center mb-2">
            <img src="{{ asset('assets/img/logo_simkesma.png') }}" alt="logo" class="mx-2" width="55">
            <img src="{{ asset('assets/img/logoo.png') }}" alt="new logo" class="mx-2" style="width: 40px;">
        </div>
        <h4>Selamat Datang di <span class="font-weight-bold">SIMKESMA</span></h4>
        <p class="text-muted">Sistem Informasi Kesehatan Mahasiswa Politeknik Negeri Malang</p>
        <form method="POST" action="" class="needs-validation" novalidate="">
            @csrf
            <div class="form-group text-left">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" tabindex="1" value="{{ old('email') }}" required autofocus>
                <div class="invalid-feedback">
                    Please fill in your email
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group text-left">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" tabindex="2" required>
                <div class="invalid-feedback">
                    please fill in your password
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Ingat saya</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                    Masuk
                </button>
            </div>

            <div class="mt-3 text-muted">
                <a href="#" class="mr-2">Lupa Password?</a> | <a href="#" class="ml-2">Silahkan
                    daftar</a>
            </div>

            <div class="text-muted mt-4">
                Copyright &copy; Kelompok 4
            </div>
        </form>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
