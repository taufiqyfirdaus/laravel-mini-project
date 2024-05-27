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
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-2 text-white border-end border-secondary position-fixed p-3" style="height: 100vh; width:17%;">
                @auth
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">Sidebar logged</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#speedometer2" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#table" />
                                </svg>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#grid" />
                                </svg>
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#people-circle" />
                                </svg>
                                Customers
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
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-house-fill" style="margin-right:25px; color: #439089;"></i>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-search" style="margin-right:25px; color: #439089;"></i>
                                Explore
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link text-white">
                                <i class="bi bi-arrow-left" style="margin-right:25px; color: #439089;"></i>
                                Login
                            </a>
                        </li>
                    </ul>
                @endauth
            </div>
            @unless (auth()->check())
                <div class="position-fixed bottom-0 w-100 p-4 text-white" style="background-color: #2E6F72">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 style="margin-left: 100px;">Jangan ketinggalan berita terbaru</h5>
                            <p class="mb-0 fs-6" style="margin-left: 100px;">login, untuk pengalaman yang baru</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <a href="/login" class="btn btn-outline-light fw-bold rounded-4" style="margin-right: 10px; width: 100px;">Login</a>
                            <a href="/register" class="btn btn-light fw-bold rounded-4" style="width: 100px;">Register</a>
                        </div>
                    </div>
                </div>
            @endunless
            <div class="col-md-10" style="margin-left: 17vw; width:82%">
                <nav class="navbar navbar-expand-lg navbar-dark position-fixed" style="background-color: black; width:82%">
                    <div class="container-fluid">
                        <div class="navbar-collapse justify-content-md-center">
                            <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" width="40px">
                        </div>
                    </div>
                </nav>
                <main class="flex-shrink-0">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
