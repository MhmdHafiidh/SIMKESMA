<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unified Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/medilab/assets/img/simm.png" rel="icon" type="image/png">
    <style>
        body {
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-container {
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-header text-center py-4"
                style="background-color: #ffffff; border-bottom: 1px solid #eaeaea;">
                <!-- Logo Section -->
                <div class="d-flex justify-content-center mb-3">
                    <!-- Logo 1 -->
                    <img src="{{ asset('medilab/assets/img/logo_simkesma.png') }}" alt="Logo 1" class="mx-3"
                        style="max-width: 180px; max-height:50px; height: auto;">
                    <!-- Logo 2 -->
                    <img src="{{ asset('medilab/assets/img/logoo.png') }}" alt="Logo 2" class="mx-3"
                        style="max-width: 160px; max-height: 50px; height: auto;">
                </div>
                <h3 class="fw-bold text-dark mb-1">{{ __('Masuk') }}</h3>
                <p class="text-muted small mb-0">Silahkan Login</p>
            </div>

            <div class="card-body p-4" style="background-color: #ffffff;">
                <!-- Unified Login Form -->
                <form id="unifiedLoginForm" method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Role Selection -->
                    <div class="mb-3">
                        <label for="role" class="form-label text-dark">{{ __('Role') }}</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="dokter">Dokter</option>
                        </select>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-dark">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Masukkan email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Masukkan password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted small"
                                for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="small text-primary"
                                href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary text-white fw-bold"
                            style="background-color: #007bff; border: none; padding: 10px; font-size: 16px;">
                            {{ __('Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const loginForm = document.getElementById('unifiedLoginForm');

            // Update form action based on selected role
            roleSelect.addEventListener('change', function() {
                switch (this.value) {
                    case 'admin':
                        loginForm.action = "{{ route('login') }}";
                        break;
                    case 'mahasiswa':
                        loginForm.action = "{{ route('login.mahasiswa.submit') }}";
                        break;
                    case 'dokter':
                        loginForm.action = "{{ route('login.dokter.submit') }}";
                        break;
                    default:
                        loginForm.action = "{{ route('login') }}";
                }
            });
        });
    </script>
</body>

</html>
