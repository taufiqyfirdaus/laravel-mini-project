@extends('layouts.master')
@section('title', 'Edit Profile')
@section('content')
    <div class="row">
        <div class="d-flex flex-column px-5" style="margin-top:25px; margin-bottom:150px;">
            <div class="w-100 d-flex justify-content-start">
                <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-link text-decoration-none ps-5 text-white fw-bold mb-3">
                    <i class="bi bi-caret-left-fill"></i>
                    Back
                </a>
            </div>
            <form class="m-auto" action="{{ route('update-profile', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data" style="width:60%;">
                @method('PUT')
                @csrf
                <div class="form-group" style="padding: 0 200px 0 120px">
                    <div class="d-flex justify-content-center position-relative">
                        <img id="profileImage" class="object-fit-cover rounded-circle ms-2 me-2" src="{{ asset($user->profile_pic) }}" alt="profile pic" width="100px" height="100px">
                        <label for="profilePicInput" class="position-absolute" style="bottom: 0; right: 10px; cursor: pointer;">
                            <i class="bi bi-camera-fill text-white" style="font-size: 20px;"></i>
                            <input type="file" class="form-control {{ $errors->has('profile_pic') ? 'is-invalid' : '' }}" id="profilePicInput" name="profile_pic" accept="image/*" style="display: none;"
                                value="{{ $user->profile_pic }}">
                        </label>
                        @if ($errors->has('profile_pic'))
                            <div class="invalid-feedback">
                                <b>{{ $errors->first('profile_pic') }}</b>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex justify-content-center text-white mt-3 mb-3">
                        <h6>Edit Profile</h6>
                    </div>
                </div>
                <div class="form-group text-white d-flex justify-content-center mb-3">
                    <div class="col-md-2 pt-2">
                        <h6>Username</h6>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }} custom-input text-white border-secondary" style="background-color: black;"
                            name="username" id="username" placeholder="Masukkan username" value="{{ $user->username }}">
                        @if ($errors->has('username'))
                            <div class="invalid-feedback">
                                <b>{{ $errors->first('username') }}</b>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group text-white d-flex justify-content-center mb-3">
                    <div class="col-md-2 pt-2">
                        <h6>Nama</h6>
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} custom-input text-white border-secondary" style="background-color: black;" name="name"
                            id="name" placeholder="Masukkan nama" value="{{ $user->name }}">
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                <b>{{ $errors->first('name') }}</b>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group text-white d-flex justify-content-center mb-3">
                    <div class="col-md-2 pt-2">
                        <h6>Bio</h6>
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }} custom-input text-white border-secondary" style="background-color: black;" name="bio" id="bio" rows="4"
                            placeholder="Masukkan bio">{{ $user->bio }}</textarea>
                        @if ($errors->has('bio'))
                            <div class="invalid-feedback">
                                <b>{{ $errors->first('bio') }}</b>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group text-white d-flex justify-content-end mb-3">
                    <button type="submit" class="btn btn-sm text-white fw-bold" style="background-color: #439089; width:100px;">Edit</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .custom-input::placeholder {
            color: grey !important;
        }
    </style>
    <script>
        document.getElementById('profilePicInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
