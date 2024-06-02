@extends('layouts.master')
@section('title', 'Followings')
@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: black; z-index:100;">
        <div class="container-fluid">
            <div class="navbar-collapse justify-content-md-center">
                <div class="w-100 d-flex flex-column align-items-center">
                    <div class="w-100 d-flex justify-content-start mt-3" style="padding-left:300px">
                        <a href="{{ route('see-profiles', ['user' => $user->id]) }}" class="btn btn-link text-decoration-none ps-5 text-white fw-bold mb-3">
                            <i class="bi bi-caret-left-fill"></i>
                            Back
                        </a>
                    </div>
                    <div class="row">
                        <h6 class="text-white fw-bold">{{ $user->username }}</h6>
                    </div>
                    <div class="row">
                        <ul class="navbar-nav justify-content-md-center fw-bold">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('show-followers', ['id' => $user->id]) }}">Followers</a>
                            </li>
                            <li class="nav-item" style="margin-left: 10px;">
                                <a class="nav-link active" style="border-bottom: 2px solid #439089;" aria-current="page" href="#">Following</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col-md-6 px-5" style="margin-top:130px;">
            <h6 class="text-white fw-bold mb-4">Cari Followers</h6>
            <div class="row mt-1">
                <div class="col-md-11">
                    <form action="{{ route('followings-search') }}" method="GET">
                        <input type="text" name="search" id="search" class="form-control custom-input text-white border-secondary ms-3" placeholder="Cari" style="background-color: black;">
                </div>
                <div class="col-md-1">
                    <button class="btn btn-link" style="color: #51BED4" type="submit">
                        <i id="searchIcon" class="bi bi-search"></i>
                    </button>
                    </form>
                </div>
            </div>
            <div class="row">
                @if (!isset($searchTerm))
                    {{-- Tidak ada pencarian --}}
                    <div class="col-md-8 d-flex flex-column align-items-center justify-content-center text-white w-100" style="margin-top:35px; height:20vh;">
                        <h6 class="align-self-center">Tidak ada pencarian</h6>
                    </div>
                @else
                    {{-- hasil pencarian --}}
                    <div class="col-md-8 d-flex flex-column text-white px-5 w-100" style="margin-top:20px; height:80vh;">
                        <h6 class="fw-bold mb-3">Hasil pencarianmu</h6>
                        @if ($results->isEmpty())
                            {{-- tidak ditemukan --}}
                            <div class="d-flex flex-column align-items-center justify-content-center mt-4">
                                <h6 class="align-self-center">- Pencarian tidak ditemukan -</h6>
                            </div>
                        @else
                            @foreach ($results as $item)
                                <div class="row mb-2">
                                    <div class="col-md-8 d-flex align-items-center">
                                        <a href="{{ route('see-profiles', ['user' => $item->id]) }}" class="text-decoration-none">
                                            <div class="d-flex align-items-center">
                                                <img class="object-fit-cover rounded-circle me-3" src="{{ $item->profile_pic }}" alt="profile pic" height="40px" width="40px">
                                                <div class="d-flex flex-column">
                                                    <p class="fw-bold mb-0 text-white">{{ $item->username }}</p>
                                                    <p class="text-secondary mb-0" style="font-size: 13px">{{ $item->name }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($item->id != Auth::id())
                                            <button class="btn btn-link text-decoration-none fw-bold ms-3" style="{{ Auth::user()->isFollowing($item->id) ? 'color: #d03636;' : 'color: #439089;' }}"
                                                type="button" id="toggleFollow" data-user-id="{{ $item->id }}">
                                                {{ Auth::user()->isFollowing($item->id) ? 'Unfollow' : 'Follow' }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-6" style="margin-top:130px;">
            <h6 class="text-white fw-bold mb-4">List All Followings</h6>
            @foreach ($followings as $item)
                <div class="row mb-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <a href="{{ route('see-profiles', ['user' => $item->following_id]) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center">
                                <img class="object-fit-cover rounded-circle me-3" src="{{ asset($item->followingUser->profile_pic) }}" alt="profile pic" height="40px" width="40px">
                                <div class="d-flex flex-column">
                                    <p class="fw-bold mb-0 text-white">{{ $item->followingUser->username }}</p>
                                    <p class="text-secondary mb-0" style="font-size: 13px">{{ $item->followingUser->name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        @if ($item->id != Auth::id())
                            <button class="btn btn-link text-decoration-none fw-bold ms-3 follow-btn"
                                style="{{ Auth::user()->isFollowing($item->followingUser->id) ? 'color: #d03636;' : 'color: #439089;' }}" type="button" data-user-id="{{ $item->followingUser->id }}">
                                {{ Auth::user()->isFollowing($item->followingUser->id) ? 'Unfollow' : 'Follow' }}
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .custom-input::placeholder {
            color: grey !important;
        }
    </style>
    <script>
        document.querySelectorAll('.follow-btn').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.dataset.userId;
                fetch(`/follow/${userId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'followed') {
                            this.textContent = 'Unfollow';
                            this.style.color = '#d03636';
                        } else if (data.status === 'unfollowed') {
                            this.textContent = 'Follow';
                            this.style.color = '#439089';
                        }
                        document.querySelector('.followers-count').textContent = data.followers_count;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
