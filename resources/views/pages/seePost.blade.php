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
        <div class="d-flex flex-column align-items-center" style="margin-top:80px; margin-bottom:150px;">
            <div class="w-100 d-flex justify-content-start">
                <a href="{{ route('home') }}" class="btn btn-link text-decoration-none ps-5 text-white fw-bold mb-3">
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
                                    <a href="" class="text-decoration-none">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle me-3" src="{{ asset('assets/default_profile.png') }}" alt="profile pic" height="30px">
                                            <div class="d-flex flex-column">
                                                <p class="fw-bold mb-0 text-white" style="font-size: 14px">Username</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <p class="my-3">Description</p>
                        </div>
                        <img src="{{ asset('assets/no_image.png') }}" class="rounded-3 w-100 mb-3" alt="post image">
                    </div>
                    <div class="col-md-5">
                        <h6 class="fw-bold mt-2">komentar</h6>
                        <div class="comment">
                            <p class="text-center text-secondary my-4" style="font-size: 13px">Belum ada komentar</p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-1">
                            <div>
                                <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                    <i id="likeIcon" class="bi bi-heart fs-5"></i>
                                </a>
                                <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                    <i id="commentIcon" class="bi bi-chat fs-5"></i>
                                </a>
                                <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                    <i id="shareIcon" class="bi bi-send fs-5"></i>
                                </a>
                            </div>
                            <div>
                                <a href="" class="btn btn-link text-decoration-none ps-0" style="color:#51BED4">
                                    <i id="bookmarkIcon" class="bi bi-bookmark fs-5"></i>
                                </a>
                            </div>
                        </div>
                        <h6 class="mb-0">0 Likes</h6>
                        <p class="text-secondary mb-4" style="font-size: 13px">1 day ago</p>
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
@endsection
