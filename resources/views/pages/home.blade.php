@extends('layouts.master')
@section('title', 'Beranda')
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
                                <a class="nav-link" href="#">For You</a>
                            </li>
                            <li class="nav-item" style="margin-left: 10px;">
                                <a class="nav-link" href="#">Following</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@section('content')
    <div class="" style="height:2000px;">
        <div class="row">
            <div class="col-md-8 d-flex flex-column align-items-center" style="margin-top:130px;">
                <div class="card border-secondary p-3 text-white" style="width: 30rem; background-color:black;">
                    <div class="card-header px-0">
                        <div class="row">
                            <div class="col-md-10 d-flex align-items-center">
                                <img class="rounded-circle me-3" src="{{ asset('assets/default_profile.png') }}" alt="profile pic" height="30px">
                                <div class="d-flex flex-column">
                                    <p class="fw-bold mb-0" style="font-size: 14px">Username</p>
                                    <p class="text-secondary mb-0" style="font-size: 13px">1 day ago</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-link ms-4 text-white" type="button" id="toggleBookmark">
                                    <i id="bookmarkIcon" class="bi bi-bookmark"></i>
                                </button>
                            </div>
                        </div>
                        <p class="my-3">Description</p>
                    </div>
                    <img src="{{ asset('assets/no_image.png') }}" class="rounded-3" alt="post image">
                    <hr>
                    <div class="card-body py-0">
                        <div class="row">
                            <div class="col-md-4 px-0">
                                <button class="btn btn-link text-white text-decoration-none ps-0" type="button" id="toggleLike">
                                    <i id="likeIcon" class="bi bi-heart me-1"></i>
                                    0 Likes
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
            </div>
            <div class="col-md-4">
                <div class="position-fixed text-white" style="margin-top:130px; width:18vw;">
                    <h5>Siapa yang harus diikuti</h5>
                    <p class="text-secondary" style="font-size: 12px">Orang yang mungkin anda kenal</p>
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <img class="rounded-circle me-3" src="{{ asset('assets/default_profile.png') }}" alt="profile pic" height="40px">
                            <div class="d-flex flex-column">
                                <p class="fw-bold mb-0">Username</p>
                                <p class="text-secondary mb-0" style="font-size: 13px">Name</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-link text-decoration-none fw-bold ms-3" style="color: #439089;" type="button" id="toggleBookmark">
                                Follow
                            </button>
                        </div>
                    </div>
                    <hr>
                    <p class="text-secondary" style="font-size: 12px">Terms of Service Privacy Policy Cookie Policy
                        Accessibility Ads info more © 2024 Sosmed</p>
                </div>
            </div>
        </div>
    </div>
@endsection
