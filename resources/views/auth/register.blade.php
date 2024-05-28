<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body style="background-color: black">
    <section class="px-5 py-5 mt-5">
        <div class="row justify-content-center my-5 px-5 text-white">
            <h1 class="h3 mb-3 fw-bold text-center">Register</h1>
            <div class="col-md-4">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" width="200px" style="margin-left:150px; margin-top:60px;">
                </a>
            </div>
            <div class="col-md-8 p-4">
                <!-- error message -->
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <!-- success message -->
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form class="w-75" action="{{ route('register-user') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6" style="padding-right: 2px;">
                            <div class="form-group mb-3">
                                <label class="mb-2" for="username"><b>Username</b></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6" style="padding-left: 2px;">
                            <div class="form-group mb-3">
                                <label class="mb-2" for="name"><b>Nama</b></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="email"><b>E-mail</b></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="password"><b>Password</b></label>
                        <button class="btn btn-link text-white" type="button" id="togglePassword">
                            <i id="eyeIcon" class="bi bi-eye"></i>
                        </button>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="password_confirmation"><b>Konfirmasi Password</b></label>
                        <button class="btn btn-link text-white" type="button" id="togglePasswordConfirmation">
                            <i id="eyeIconConfirmation" class="bi bi-eye"></i>
                        </button>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Masukkan konfirmasi password" required>
                        @error('password_confirmation')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-light w-25 mt-4 mb-5 fw-bold">Register</button>
                    </div>

                    <p class="text-center">Sudah punya akun? <a class="fw-bold text-reset" href="{{ route('login') }}">Login</a></p>
                </form>
            </div>
        </div>
    </section>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
<footer>
    <div class="text-black p-3" style="background-color: white;">
        <div class="row justify-content-center my-5 px-5">
            <div class="col-md-4 d-flex align-items-start">
                <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" width="70px" style="margin-right: 30px;">
                <div>
                    <h5 class="fw-bold d-flex align-items-center" style="height: 70px;">Tentang kami</h5>
                    <p>Temukan dan terhubung dengan teman baru, bagikan momen-momen berharga, dan ikuti perkembangan terkini dari seluruh dunia.
                        Bergabunglah dengan komunitas kami dan jadilah bagian dari pengalaman sosial yang menginspirasi.</p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center align-items-end p-4">
                <h5 class="text-center fw-bold mb-0">© 2024 Sosmed</h5>
            </div>
            <div class="col-md-4 py-4 px-5">
                <h5 class="text-center fw-bold mb-4">Kontak</h5>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-geo-alt-fill" style="margin-right:25px; color: #439089;"></i>
                    <p class="mb-0">Jalan Platinum, No. 99, Kec. Logam, Kota Emas 16666</p>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-envelope-fill" style="margin-right:25px; color: #439089;"></i>
                    <p class="mb-0">miniproject@gmail.com</p>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-telephone-fill" style="margin-right:25px; color: #439089;"></i>
                    <p class="mb-0">0855-6666-5555</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        eyeIcon.className = type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    });

    const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
    const passwordConfirmation = document.querySelector('#password_confirmation');
    const eyeIconConfirmation = document.querySelector('#eyeIconConfirmation');

    togglePasswordConfirmation.addEventListener('click', function() {
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        eyeIconConfirmation.className = type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    });
</script>

</html>
