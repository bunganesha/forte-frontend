@extends('layouts.landingNavbar')

@section('title', 'Login - FORTE')

@push('styles')
    <style>
        .login-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            padding: 0 50px;
            position: relative;
        }

        .login-card {
            background-color: #444;
            border-radius: 40px;
            padding: 50px;
            max-width: 500px;
            width: 100%;
            box-shadow: 15px 15px 30px rgba(0, 0, 0, .5);
            z-index: 2;
        }

        .form-control-forte {
            background-color: #d9d9d9 !important;
            border-radius: 25px;
            height: 60px;
            padding: 15px 25px;
            margin-bottom: 30px;
        }

        .btn-login {
            background-color: #2d7a32;
            color: white;
            border-radius: 25px;
            padding: 12px 60px;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .signup-text {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #ccc;
        }

        .signup-text a {
            color: #2d7a32;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    <div class="login-section">

        <div class="login-card">
            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <label>Username</label>
                <input type="text" name="username" class="form-control form-control-forte">

                <label>Password</label>
                <div class="position-relative">
                    <input type="password" id="loginPassword" name="password" class="form-control form-control-forte pe-5">

                    <i id="toggleLoginPassword" class="bi bi-eye-slash position-absolute"
                        style="
            top: 50%;
            right: 25px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #555;
            font-size: 1.2rem;
        ">
                    </i>
                </div>


                <button type="submit" class="btn btn-login">Login</button>

                {{-- <p class="signup-text mt-3">
                    Belum punya akun <a href="{{ route('register') }}">(Daftar)</a>
                </p> --}}
            </form>
        </div>

        <div class="rover-container">
            <img src="{{ asset('assets/img/2 1.png') }}" class="img-fluid">
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const loginPassword = document.getElementById('loginPassword');
        const toggleLoginPassword = document.getElementById('toggleLoginPassword');

        toggleLoginPassword.addEventListener('click', function() {
            if (loginPassword.type === 'password') {
                loginPassword.type = 'text';
                this.classList.remove('bi-eye-slash');
                this.classList.add('bi-eye');
            } else {
                loginPassword.type = 'password';
                this.classList.remove('bi-eye');
                this.classList.add('bi-eye-slash');
            }
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil 🎉',
                text: "{{ session('success') }}",
                confirmButtonColor: '#2d7a32'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
@endpush
