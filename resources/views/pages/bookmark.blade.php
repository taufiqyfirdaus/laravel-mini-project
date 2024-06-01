@extends('layouts.master')
@section('title', 'Bookmarks')
@section('navbar')
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
        <div class="d-flex flex-column px-5" style="margin-top:100px; margin-bottom:50px;">
            <div class="row d-flex justify-content-center">
                <div class="mb-3">
                    <h5 class="text-white ms-5">All Bookmarks</h5>
                </div>
                <div class="col-md-10 d-flex flex-wrap">
                    @if ($bookmarkedPosts->isEmpty())
                        <div class="d-flex justify-content-center align-items-center w-100" style="height: 360px;">
                            <p class="text-secondary">Belum ada postingan yang di bookmark</p>
                        </div>
                    @else
                        @foreach ($bookmarkedPosts as $item)
                            <div class="card border-secondary p-3 text-white my-3 mx-4" style="width: 270px; height:270px; background-color:black;">
                                <div class="card-header px-0 pt-0">
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
                                    </div>
                                </div>
                                <a href="{{ route('see-post', ['post' => $item->id]) }}" class="d-flex justify-content-center">
                                    <img src="{{ asset($item->post_pic) }}" alt="post image" class="object-fit-cover rounded" width="210px" height="180px">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
