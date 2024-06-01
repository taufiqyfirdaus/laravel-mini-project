@extends('layouts.master')
@section('title', 'See Post')
@section('navbar')
    <style>
        .custom-input::placeholder {
            color: grey !important;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark position-fixed w-100" style="background-color: black; z-index:100;">
        <div class="container-fluid">
            <div class="navbar-collapse justify-content-md-center">
                <div class="d-flex flex-column align-items-center">
                    <div class="row">
                        <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" style="width: 70px">
                    </div>
                </div>
            </div>
        </div>
    </nav>
@section('content')
    <div class="row">
        <div class="d-flex flex-column align-items-center" style="margin-top:80px; margin-bottom:150px;">
            <div class="w-100 d-flex justify-content-start">
                <a href="{{ url()->previous() }}" class="btn btn-link text-decoration-none ps-5 text-white fw-bold mb-3">
                    <i class="bi bi-caret-left-fill"></i>
                    Back
                </a>
            </div>
            <div class="card border-secondary p-3 text-white" style="width: 95%; background-color:black;">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card-header px-0">
                            <div class="row">
                                <div class="col-md-10 d-flex align-items-center">
                                    <a href="{{ route('see-profiles', ['user' => $post->user->id]) }}" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <img class="object-fit-cover rounded-circle me-3" src="{{ asset($post->user->profile_pic) }}" alt="profile pic" height="30px" width="30px">
                                            <div class="d-flex flex-column">
                                                <p class="fw-bold mb-0 text-white" style="font-size: 14px">{{ $post->user->username }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @if (Auth::check() && $post->user_id === Auth::user()->id)
                                    <div class="col-md-1">
                                        <a href="{{ route('edit-post', ['post' => $post->id]) }}" class="btn btn-link ms-4 px-1 text-warning" type="button">
                                            <i id="editIcon" class="bi bi-pencil-square"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-link ms-0 px-1 text-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal_{{ $post->id }}">
                                            <i id="deleteIcon" class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <p class="my-3">{{ $post->description }}</p>
                        </div>
                        <img src="{{ $post->post_pic }}" class="rounded-3 w-100 mb-3" alt="post image">
                    </div>
                    <div class="col-md-5">
                        <h6 class="fw-bold mt-2">komentar</h6>
                        <div class="comment">
                            <p class="text-center text-secondary my-4" style="font-size: 13px">Belum ada komentar</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-1">
                            <div>
                                @auth
                                    <button class="btn btn-link text-decoration-none ps-0" type="button" id="toggleLike" style="color:#51BED4" data-post-id="{{ $post->id }}">
                                        <i id="likeIcon_{{ $post->id }}" class="bi {{ Auth::user()->likes->contains($post->id) ? 'bi-heart-fill' : 'bi-heart' }} fs-5"></i>
                                    </button>
                                    <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                        <i id="commentIcon" class="bi bi-chat fs-5"></i>
                                    </a>
                                    <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                        <i id="shareIcon" class="bi bi-send fs-5"></i>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                        <i id="likeIcon" class="bi bi-heart fs-5"></i>
                                    </a>
                                    <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                        <i id="commentIcon" class="bi bi-chat fs-5"></i>
                                    </a>
                                    <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                        <i id="shareIcon" class="bi bi-send fs-5"></i>
                                    </a>
                                @endauth
                            </div>
                            <div>
                                @auth
                                    <button class="btn btn-link ps-0" type="button" id="toggleBookmark" style="color:#51BED4" data-post-id="{{ $post->id }}">
                                        <i id="bookmarkIcon_{{ $post->id }}" class="bi {{ Auth::user()->bookmarks->contains($post->id) ? 'bi-bookmark-fill' : 'bi-bookmark' }} fs-5"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-link ps-0" style="color:#51BED4">
                                        <i id="bookmarkIcon" class="bi bi-bookmark fs-5"></i>
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <h6 class="likes-count mb-0">{{ $post->likes->count() }} Likes</h6>
                        <p class="text-secondary mb-4 mt-1" style="font-size: 13px">{{ $post->created_at->diffForHumans() }}</p>
                        <div class="row mb-1">
                            <div class="col-md-10">
                                <textarea name="comment" id="comment" class="form-control custom-input text-white border-bottom border-secondary border-start-0 border-end-0 border-top-0" placeholder="Tambahkan komentar"
                                    style="background-color: black; height:40px;"></textarea>
                            </div>
                            <div class="col-md-2">
                                <a href="" class="btn btn-link text-decoration-none ps-0 text-white text-center" style="font-size: 15px">kirim</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteConfirmationModal_{{ $post->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel_{{ $post->id }}" aria-hidden="true"
        data-bs-backdrop="false">
        <div class="modal-dialog" style="max-width:35%; margin-top: 70px; margin-right:25%">
            <div class="modal-content text-white border solid border-secondary" style="background-color:black">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel_{{ $post->id }}">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close text-white text-decoration-none" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <div class="modal-body pt-2 pb-0">
                    Apakah Anda yakin ingin menghapus postingan ini?
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm_{{ $post->id }}" action="{{ route('delete-post', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger fw-bold">Hapus</button>
                    </form>
                </div>
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
                const likesCount = document.querySelector('.likes-count');

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
                            likesCount.textContent = `${parseInt(likesCount.textContent) + 1} Likes`;
                        } else if (data.status === 'unliked') {
                            if (icon.classList.contains('bi-heart-fill')) {
                                icon.classList.remove('bi-heart-fill');
                                icon.classList.add('bi-heart');
                            }
                            likesCount.textContent = `${parseInt(likesCount.textContent) - 1} Likes`;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
