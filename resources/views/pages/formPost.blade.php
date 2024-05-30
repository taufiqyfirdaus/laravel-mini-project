@extends('layouts.master')
@section('title', 'Beranda')
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
        <div class="d-flex flex-column" style="margin-top:80px; margin-bottom:150px; padding-left:300px;">
            <div class="card border-secondary p-3 text-white" style="width: 30rem; background-color:black;">
                <form action="{{ route('store-post', ['user' => $user_id]) }}" id="postForm" method="POST" enctype="multipart/form-data" class="mb-0">
                    @csrf
                    <div class="card-header px-0">
                        <div class="row">
                            <div class="col-md-2 d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="{{ asset('assets/default_profile.png') }}" alt="profile pic" height="30px">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex flex-column text-center">
                                    <p class="fw-bold mt-1 mb-0 text-white" style="font-size: 16px">{{ Auth::user()->username }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-link ms-4 text-white" type="button" id="toggleOther">
                                    <i id="otherIcon" class="bi bi-three-dots"></i>
                                </button>
                            </div>
                        </div>
                        <textarea name="description" id="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} custom-input text-white border-bottom border-secondary border-start-0 border-end-0 border-top-0 my-2"
                            placeholder="Deskripsi postingan" rows="1" style="background-color: black;">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                <b>{{ $errors->first('description') }}</b>
                            </div>
                        @endif
                    </div>

                    <div id="imagePreviewContainer" class="text-center mb-3" style="position: relative;">
                        <label for="post_pic" id="imageLabel" class="form-label d-flex flex-column align-items-center justify-content-center"
                            style="cursor: pointer; border: 1px solid #6c757d; padding: 10px; height:300px; width: 100%;">
                            <span class="fw-bold">Pilih gambar</span>
                            <input class="form-control {{ $errors->has('post_pic') ? 'is-invalid' : '' }} d-none" type="file" id="post_pic" name="post_pic" accept="image/*" value="{{ old('post_pic') }}">
                        </label>
                        <img id="preview" class="rounded-3 w-100 d-none" alt="post image">
                        @if ($errors->has('post_pic'))
                            <div class="invalid-feedback">
                                <b>{{ $errors->first('post_pic') }}</b>
                            </div>
                        @endif
                    </div>

                    <hr>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user_id }}">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm w-25 fw-bold text-white" style="background-color: #3F979B;">Posting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('post_pic').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    document.getElementById('imageLabel').classList.add('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
