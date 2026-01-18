@extends('layouts.landingNavbar')

@section('title', 'Register - FORTE')

@push('styles')
    <style>
        .register-section {
            min-height: 85vh;
            display: flex;
            align-items: center;
            padding: 0 50px;
            position: relative;
        }

        .register-card {
            background-color: #444;
            border-radius: 40px;
            padding: 40px 50px;
            max-width: 500px;
            width: 100%;
            box-shadow: 15px 15px 30px rgba(0, 0, 0, .5);
            z-index: 2;
        }

        .form-control {
            border-radius: 25px;
            height: 50px;
            padding: 10px 25px;
        }

        .form-control-forte {
            background-color: #d9d9d9 !important;
            border-radius: 25px;
            height: 60px;
            padding: 15px 25px;
            margin-bottom: 30px;
        }

        .btn-register {
            background-color: #2d7a32;
            color: white;
            border-radius: 25px;
            padding: 10px 60px;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .rover-container {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60%;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')
    <div class="register-section">

        <div class="register-card">
            <form method="POST" action="{{ route('register.process') }}">
                @csrf

                <label>Username</label>
                <input type="text" name="username" class="form-control form-control-forte mb-3" required>

                <label>Email</label>
                <input type="email" name="email" class="form-control form-control-forte mb-3" required>

                <label>Password</label>
                <div class="position-relative ">
                    <input type="password" id="password" name="password" class="form-control form-control-forte pe-5"
                        required>
                    <i id="togglePassword" class="bi bi-eye-slash position-absolute"
                        style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer; color: #aaa;">
                    </i>
                </div>

                <small id="passwordHelp" class="text-danger d-none">
                    Password minimal 4 karakter
                    <br>
                </small>

                <label >Konfirmasi Password</label>
                <div class="position-relative mb-4">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control form-control-forte pe-5" required>
                    <i id="togglePasswordConfirm" class="bi bi-eye-slash position-absolute"
                        style="top: 50%; right: 20px; transform: translateY(-50%); cursor: pointer; color: #aaa;">
                    </i>
                </div>


                <button type="submit" class="btn btn-register">Daftar</button>

                <p class="mt-3">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-success">Login</a>
                </p>
            </form>
        </div>

        <div class="rover-container">
            <img src="{{ asset('assets/img/2 1.png') }}" class="img-fluid">
        </div>

    </div>
    @push('scripts')
        <script>
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password_confirmation');
            const togglePassword = document.getElementById('togglePassword');
            const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
            const passwordHelp = document.getElementById('passwordHelp');

            function toggleEye(input, icon) {
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                }
            }

            togglePassword.addEventListener('click', () => {
                toggleEye(password, togglePassword);
            });

            togglePasswordConfirm.addEventListener('click', () => {
                toggleEye(passwordConfirm, togglePasswordConfirm);
            });

            // Validasi minimal 4 karakter
            password.addEventListener('input', function() {
                passwordHelp.classList.toggle('d-none', this.value.length >= 4);
            });
        </script>
    @endpush


@endsection
