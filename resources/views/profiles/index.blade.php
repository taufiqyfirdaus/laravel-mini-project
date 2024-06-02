@extends('layouts.master')
@section('title', 'Profile')
@section('content')
    <div class="row">
        <div class="d-flex flex-column px-5" style="margin-top:25px; margin-bottom:50px;">
            <div class="w-100 d-flex justify-content-start">
                <a href="{{ url()->previous() }}" class="btn btn-link text-decoration-none ps-5 text-white fw-bold mb-3">
                    <i class="bi bi-caret-left-fill"></i>
                    Back
                </a>
            </div>
            <div class="row" style="padding: 0 200px 0 120px">
                <div class="col-md-2">
                    <img class="object-fit-cover rounded-circle ms-2 me-2" src="{{ asset($user->profile_pic) }}" alt="profile pic" width="120px" height="120px">
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center ms-4">
                        <div class="d-flex flex-column w-50">
                            <p class="text-white fw-bold mb-2" style="font-size: 18px;">{{ $user->username }}</p>
                            <div class="d-flex">
                                <p class="text-secondary me-3 mb-2" style="font-size: 14px;">
                                    <b class="text-white">{{ $posts->count() }}</b> Posts
                                </p>
                                <a href="{{ route('show-followers', ['id' => $user->id]) }}" class="text-decoration-none">
                                    <p class="text-secondary me-3 mb-2" style="font-size: 14px;">
                                        <b class="text-white followers-count">{{ $user->followers->count() }}</b> Followers
                                    </p>
                                </a>
                                <a href="{{ route('show-followings', ['id' => $user->id]) }}" class="text-decoration-none">
                                    <p class="text-secondary mb-2" style="font-size: 14px;">
                                        <b class="text-white">{{ $user->followings->count() }}</b> Following
                                    </p>
                                </a>
                            </div>
                            <p class="mb-1 text-white" style="font-size: 14px;">{{ $user->name }}</p>
                            <p class="mb-3 text-white" style="font-size: 11px;">{{ $user->bio }}</p>

                            <button class="btn btn-sm text-white fw-bold follow-btn"
                                style="{{ Auth::user()->isFollowing($user->id) ? 'background-color: none; border: 2px solid #439089;' : 'background-color: #439089; border: 2px solid #439089;' }}" type="button" id="toggleFollow"
                                data-user-id="{{ $user->id }}">
                                {{ Auth::user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
                            </button>
                        </div>
                    </div>
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
    <script>
        document.getElementById('toggleFollow').addEventListener('click', function() {
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
                        this.style.backgroundColor = 'transparent';
                    } else if (data.status === 'unfollowed') {
                        this.textContent = 'Follow';
                        this.style.backgroundColor = '#439089';
                    }
                    document.querySelector('.followers-count').textContent = data.followers_count;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
