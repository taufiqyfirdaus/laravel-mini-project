@extends('layouts.master')
@section('title', 'Beranda Following')
@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: black; z-index:100;">
        <div class="container-fluid">
            <div class="navbar-collapse justify-content-md-center">
                <div class="d-flex flex-column align-items-center">
                    <div class="row">
                        <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" style="width: 70px">
                    </div>
                    <div class="row">
                        <ul class="navbar-nav justify-content-md-center fw-bold">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">For You</a>
                            </li>
                            <li class="nav-item" style="margin-left: 10px;">
                                <a class="nav-link active" style="border-bottom: 2px solid #439089;" aria-current="page" href="{{ route('home-following') }}">Following</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@section('content')
    <div class="row">
        <div class="col-md-8 d-flex flex-column align-items-center" style="margin-top:130px;">
            @foreach ($posts as $item)
                <div class="card border-secondary p-3 text-white mb-3" style="width: 30rem; background-color:black;">
                    <div class="card-header px-0">
                        <div class="row">
                            <div class="col-md-10 d-flex align-items-center">
                                <a href="{{ route('see-profiles', ['user' => $item->user->id]) }}" class="text-decoration-none">
                                    <div class="d-flex align-items-center">
                                        <img class="object-fit-cover rounded-circle me-3" src="{{ $item->user->profile_pic }}" alt="profile pic" height="30px" width="30px">
                                        <div class="d-flex flex-column">
                                            <p class="fw-bold mb-0 text-white" style="font-size: 14px">{{ $item->user->username }}</p>
                                            <p class="text-secondary mb-0" style="font-size: 13px">{{ $item->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-link ms-4 text-white" type="button" id="toggleBookmark" data-post-id="{{ $item->id }}">
                                    <i id="bookmarkIcon_{{ $item->id }}" class="bi {{ Auth::user()->bookmarks->contains($item->id) ? 'bi-bookmark-fill' : 'bi-bookmark' }}"></i>
                                </button>
                            </div>

                        </div>
                        <p class="my-3">{{ $item->description }}</p>
                    </div>
                    <a href="{{ route('see-post', ['post' => $item->id]) }}">
                        @if ($item->post_pic)
                            <img src="{{ asset($item->post_pic) }}" class="rounded-3 w-100" alt="post image">
                        @else
                            <img src="{{ asset('assets/no_image.png') }}" class="rounded-3 w-100" alt="no image">
                        @endif
                    </a>
                    <hr>
                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col-md-4 px-0">
                                <button class="btn btn-link text-white text-decoration-none ps-0" type="button" id="toggleLike" data-post-id="{{ $item->id }}">
                                    <i id="likeIcon_{{ $item->id }}" class="bi {{ Auth::user()->likes->contains($item->id) ? 'bi-heart-fill' : 'bi-heart' }} me-1"></i>
                                    <span id="likesCount_{{ $item->id }}" class="likes-count">{{ $item->likes->count() }}</span> Likes
                                </button>
                            </div>
                            <div class="col-md-6 px-0">
                                <button class="btn btn-link text-white text-decoration-none ps-0" type="button" id="toggleComment">
                                    <i id="commentIcon" class="bi bi-chat me-1"></i>
                                    0 Comments
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="position-fixed text-white" style="margin-top:130px; width:18vw;">
                <h5>Siapa yang harus diikuti</h5>
                <p class="text-secondary" style="font-size: 12px">Orang yang mungkin anda kenal</p>
                @foreach ($randomUsers as $item)
                    <div class="row mb-2">
                        <div class="col-md-8 d-flex align-items-center">
                            <a href="{{ route('see-profiles', ['user' => $item->id]) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center">
                                    <img class="object-fit-cover rounded-circle me-3" src="{{ asset($item->profile_pic) }}" alt="profile pic" height="40px" width="40px">
                                    <div class="d-flex flex-column">
                                        <p class="fw-bold mb-0 text-white">{{ $item->username }}</p>
                                        <p class="text-secondary mb-0" style="font-size: 13px">{{ $item->name }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-link text-decoration-none fw-bold ms-3 follow-btn" style="color: #439089;" type="button" data-user-id="{{ $item->id }}">
                                Follow
                            </button>
                        </div>
                    </div>
                @endforeach
                <hr>
                <p class="text-secondary" style="font-size: 12px">Terms of Service Privacy Policy Cookie Policy
                    Accessibility Ads info more © 2024 Sosmed</p>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('#toggleBookmark').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const icon = document.querySelector(`#bookmarkIcon_${postId}`);

                fetch(`/bookmark/${postId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            if (icon.classList.contains('bi-bookmark')) {
                                icon.classList.remove('bi-bookmark');
                                icon.classList.add('bi-bookmark-fill');
                            } else {
                                icon.classList.remove('bi-bookmark-fill');
                                icon.classList.add('bi-bookmark');
                            }
                        }
                    });
            });
        });

        document.querySelectorAll('#toggleLike').forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.dataset.postId;
                const icon = document.querySelector(`#likeIcon_${postId}`);
                const likesCountElement = document.querySelector(`#likesCount_${postId}`);

                fetch(`/like/${postId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'liked') {
                            if (icon.classList.contains('bi-heart')) {
                                icon.classList.remove('bi-heart');
                                icon.classList.add('bi-heart-fill');
                            }
                            likesCountElement.textContent = parseInt(likesCountElement.textContent) + 1;
                        } else if (data.status === 'unliked') {
                            if (icon.classList.contains('bi-heart-fill')) {
                                icon.classList.remove('bi-heart-fill');
                                icon.classList.add('bi-heart');
                            }
                            likesCountElement.textContent = parseInt(likesCountElement.textContent) - 1;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
        
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
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
