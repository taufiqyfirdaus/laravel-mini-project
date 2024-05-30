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
    @stack('styles')
</head>

<body style="background-color: black">
    @yield('navbar')
    <div class="d-flex flex-nowrap w-100 overflow-auto">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white position-fixed border-end border-secondary" style="width: 18%; height: 100vh; background-color: black; z-index:150;">
            @auth
                <a href="{{ route('show-profile') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle ms-2 me-2" src="{{ asset(Auth::user()->profile_pic) }}" alt="profile pic" width="35px">
                        <div class="d-flex flex-column">
                            <span class="fs-6">{{ Auth::user()->username }}</span>
                            <p class="mb-0 text-secondary" style="font-size: 12px;">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-white">
                            <i class="bi bi-house-door-fill" style="margin-right:25px; color: #439089;"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('explore') }}" class="nav-link text-white">
                            <i class="bi bi-search" style="margin-right:25px; color: #439089;"></i>
                            Explore
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-bell-fill" style="margin-right:25px; color: #439089;"></i>
                            Notifikasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('show-form-add-post') }}" class="nav-link text-white">
                            <i class="bi bi-plus-lg" style="margin-right:25px; color: #439089;"></i>
                            Posting
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-bookmark-fill" style="margin-right:25px; color: #439089;"></i>
                            Bookmarks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="nav-link text-white">
                            <i class="bi bi-arrow-left" style="margin-right:25px; color: #439089;"></i>
                            Log out
                        </a>
                    </li>
                </ul>
            @else
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <div class="row py-2">
                        <div class="col-md-3">
                            <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" width="40px">
                        </div>
                        <div class="col-md-9">
                            <span class="fs-6">Silahkan Login Dahulu</span>
                            <p class="mb-0 text-secondary" style="font-size: 12px;">Ayo Login</p>
                        </div>
                    </div>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-white">
                            <i class="bi bi-house-door-fill" style="margin-right:25px; color: #439089;"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('explore') }}" class="nav-link text-white">
                            <i class="bi bi-search" style="margin-right:25px; color: #439089;"></i>
                            Explore
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="nav-link text-white">
                            <i class="bi bi-arrow-left" style="margin-right:25px; color: #439089;"></i>
                            Login
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
        @unless (auth()->check())
            <div class="position-fixed bottom-0 w-100 p-4 text-white" style="background-color: #2E6F72; z-index:200;">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 style="margin-left: 100px;">Jangan ketinggalan berita terbaru</h5>
                        <p class="mb-0 fs-6" style="margin-left: 100px;">login, untuk pengalaman yang baru</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-light fw-bold rounded-4" style="margin-right: 10px; width: 100px;">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-light fw-bold rounded-4" style="width: 100px;">Register</a>
                    </div>
                </div>
            </div>
        @endunless
        <div class="contents" style="margin-left: 18vw; width:80%">
            <main class="flex-shrink-0">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
