@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="d-flex flex-column px-5" style="margin-top:25px; margin-bottom:50px;">
            <div class="w-100 d-flex justify-content-start">
                <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-link text-decoration-none ps-5 text-white fw-bold mb-3">
                    <i class="bi bi-caret-left-fill"></i>
                    Back
                </a>
            </div>
            <div class="row" style="padding: 0 200px 0 120px">
                <div class="col-md-2">
                    <img class="object-fit-cover rounded-circle ms-2 me-2" src="{{ asset(Auth::user()->profile_pic) }}" alt="profile pic" width="120px" height="120px">
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center ms-4">
                        <div class="d-flex flex-column w-50">
                            <p class="text-white fw-bold mb-2" style="font-size: 18px;">{{ Auth::user()->username }}</p>
                            <div class="d-flex">
                                <p class="text-secondary me-3 mb-2" style="font-size: 14px;">
                                    <b class="text-white">{{ $posts->count() }}</b> Posts
                                </p>
                                <p class="text-secondary me-3 mb-2" style="font-size: 14px;">
                                    <b class="text-white">0</b> Followers
                                </p>
                                <p class="text-secondary mb-2" style="font-size: 14px;">
                                    <b class="text-white">0</b> Following
                                </p>
                            </div>
                            <p class="mb-1 text-white" style="font-size: 14px;">{{ Auth::user()->name }}</p>
                            <p class="mb-0 text-white" style="font-size: 11px;">{{ Auth::user()->bio }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-link ms-4 text-white" type="button" id="toggleSetting">
                        <i id="settingIcon" class="bi bi-gear-fill"></i>
                    </button>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-10 d-flex flex-wrap">
                    @if ($posts->isEmpty())
                    <div class="d-flex justify-content-center align-items-center w-100" style="height: 360px;">
                        <p class="text-secondary">Belum ada postingan yang dapat ditampilkan</p>
                    </div>
                    @else
                        @foreach ($posts as $item)
                            <a href="{{ route('see-post', ['post' => $item->id]) }}" class="m-2">
                                <img src="{{ asset($item->post_pic) }}" alt="post image" class="object-fit-cover rounded" width="300px" height="300px">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="footer w-100 p-4 text-center">
        <p class="mb-5 text-secondary">Copyright 2024</p>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog" style="max-width:35%; margin-top: 70px; margin-right:25%">
            <div class="modal-content text-white border solid border-secondary" style="background-color:black">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="passwordModalLabel">Konfirmasi Password</h5>
                    <button class="btn btn-link text-white" type="button" id="togglePassword">
                        <i id="eyeIcon" class="bi bi-eye"></i>
                    </button>
                    <button type="button" class="btn-close text-white text-decoration-none" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body pt-2">
                    <form id="passwordForm">
                        @csrf
                        <div class="mb-2">
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-link text-decoration-none text-white p-0">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style>
        #toggleSetting:hover {
            animation: rotateImage 1s infinite;
        }

        @keyframes rotateImage {
            0% {
                transform: rotate3d(0, 0, 0, 0deg);
            }

            100% {
                transform: rotate3d(0, 0, 1, 90deg);
            }
        }
    </style>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            eyeIcon.className = type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
        });

        document.getElementById('toggleSetting').addEventListener('click', function() {
            var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'));
            passwordModal.show();
        });

        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var password = document.getElementById('password').value;

            fetch('{{ route('verify-password') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '{{ route('edit-profile') }}';
                    } else {
                        var errorMessage = data.message;

                        if (!document.getElementById('error-message')) {
                            const errorMessageContainer = document.createElement('div');
                            errorMessageContainer.id = 'error-message';
                            errorMessageContainer.className = 'alert alert-danger alert-dismissible fade show';
                            errorMessageContainer.role = 'alert';
                            errorMessageContainer.innerHTML = errorMessage;

                            errorMessageContainer.style.padding = '0.5rem';
                            errorMessageContainer.style.fontSize = '0.875rem';
                            errorMessageContainer.style.marginBottom = '0.5rem';

                            document.querySelector('.modal-body').insertBefore(errorMessageContainer, document.querySelector('form'));

                            setTimeout(function() {
                                errorMessageContainer.remove();
                            }, 3000);
                        } else {
                            document.getElementById('error-message').innerHTML = errorMessage;
                        }
                    }
                });
        });
    </script>
@endsection
