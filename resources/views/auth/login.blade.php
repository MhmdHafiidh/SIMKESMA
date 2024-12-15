<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/medilab/assets/img/simm.png" rel="icon" type="image/png">
    <!-- Add Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0964a1;
            --secondary-color: #3b91d7;
            --text-color: #333;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: white;
            color: var(--text-color);
            line-height: 1.6;
        }

        .login-wrapper {
            display: flex;
            min-height: 100vh;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .login-image {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            text-align: center;
        }

        .login-image img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .login-image h3 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-form-section {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo-container img {
            max-height: 50px;
            margin: 0 15px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 14px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-login {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .login-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .decorative-element {
            position: absolute;
            z-index: -1;
        }

        .decorative-element-1 {
            top: -50px;
            left: -50px;
            width: 200px;
            height: 200px;
            background: rgba(52, 152, 219, 0.1);
            border-radius: 50%;
        }

        .decorative-element-2 {
            bottom: -50px;
            right: -50px;
            width: 250px;
            height: 250px;
            background: rgba(46, 204, 113, 0.1);
            border-radius: 50%;
        }

        .btn-back {
            background-color: transparent;
            color: var(--primary-color);
            border: none;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-wrapper position-relative">
        <div class="decorative-element decorative-element-1"></div>
        <div class="decorative-element decorative-element-2"></div>

        <div class="login-container">
            <div class="login-form-section">
                <div class="logo-container">
                    <img src="{{ asset('medilab/assets/img/logo_simkesma.png') }}" alt="Logo 1">
                    <img src="{{ asset('medilab/assets/img/logoo.png') }}" alt="Logo 2">
                </div>

                <form method="POST" action="{{ route('login.mahasiswa.submit') }}">
                    @csrf
                    <input type="hidden" name="role" value="mahasiswa">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Masukkan password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="login-links">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-primary">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn btn-login w-100 text-white mt-3">
                        Masuk
                    </button>

                    <div class="text-center mt-3">
                        <p class="mb-0">
                            Belum punya akun?
                            <a href="" class="text-primary">Daftar Sekarang</a>
                        </p>
                    </div>
                    <div>
                        <div class="text-center mb-3">
                            <a href="{{ url('/') }}" class="btn btn-back">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
