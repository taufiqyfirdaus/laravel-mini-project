@extends('layouts.master')
@section('title', 'Explore')
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
                            <form action="{{ route('explore-search') }}" method="GET">
                                <input type="text" name="search" id="search" class="form-control custom-input text-white border-secondary ms-3" placeholder="Cari User"
                                    style="background-color: black;">
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-link text-white" type="submit">
                                <i id="searchIcon" class="bi bi-search"></i>
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@section('content')
    <div class="row">
        @if (!isset($searchTerm))
            {{-- Tidak ada pencarian --}}
            <div class="col-md-8 d-flex flex-column align-items-center justify-content-center text-white" style="margin-top:130px; height:80vh;">
                <h6 class="align-self-center">Tidak ada pencarian</h6>
            </div>
        @else
            {{-- hasil pencarian --}}
            <div class="col-md-8 d-flex flex-column text-white" style="margin-top:130px; height:80vh; padding: 0 200px 0 200px">
                <h6 class="fw-bold mb-3">Hasil pencarianmu</h6>
                @if ($results->isEmpty())
                    {{-- tidak ditemukan --}}
                    <div class="d-flex flex-column align-items-center justify-content-center">
                        <h6 class="align-self-center">- Pencarian tidak ditemukan -</h6>
                    </div>
                @else
                    @foreach ($results as $item)
                        <div class="row mb-2">
                            <div class="col-md-8 d-flex align-items-center">
                                <a href="" class="text-decoration-none">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="{{ $item->profile_pic }}" alt="profile pic" height="40px">
                                        <div class="d-flex flex-column">
                                            <p class="fw-bold mb-0 text-white">{{ $item->username }}</p>
                                            <p class="text-secondary mb-0" style="font-size: 13px">{{ $item->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-link text-decoration-none fw-bold ms-3" style="color: #439089;" type="button" id="toggleBookmark">
                                    Follow
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif

        <div class="col-md-4">
            <div class="position-fixed text-white" style="margin-top:130px; width:18vw;">
                <h5>Siapa yang harus diikuti</h5>
                <p class="text-secondary" style="font-size: 12px">Orang yang mungkin anda kenal</p>
                @foreach ($randomUsers as $item)
                    <div class="row mb-2">
                        <div class="col-md-8 d-flex align-items-center">
                            <a href="" class="text-decoration-none">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle me-3" src="{{ $item->profile_pic }}" alt="profile pic" height="40px">
                                    <div class="d-flex flex-column">
                                        <p class="fw-bold mb-0 text-white">{{ $item->username }}</p>
                                        <p class="text-secondary mb-0" style="font-size: 13px">{{ $item->name }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-link text-decoration-none fw-bold ms-3" style="color: #439089;" type="button" id="toggleBookmark">
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
@endsection
