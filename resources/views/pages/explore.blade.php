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
                <div class="d-flex flex-column align-items-center w-50">
                    <div class="row">
                        <img src="{{ asset('assets/logo-medsos.png') }}" alt="logo-medsos" style="width: 70px">
                    </div>
                    <div class="row mt-1 w-50">
                        <div class="col-md-11">
                            <input type="text" name="search" id="search" class="form-control custom-input text-white border-secondary ms-3" placeholder="Cari User"
                            style="background-color: black;">
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-link text-white" type="button">
                                <i id="eyeIcon" class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@section('content')
    <div class="" style="">
        <div class="row">
            {{-- Tidak ada pencarian --}}
            {{-- <div class="col-md-8 d-flex flex-column align-items-center justify-content-center text-white" style="margin-top:130px; height:80vh;">
                <h6 class="align-self-center">Tidak ada pencarian</h6>
            </div> --}}
            {{-- hasil pencarian --}}
            <div class="col-md-8 d-flex flex-column text-white" style="margin-top:130px; height:80vh; padding: 0 200px 0 200px">
                <h6 class="fw-bold mb-3">Hasil pencarianmu</h6>
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
