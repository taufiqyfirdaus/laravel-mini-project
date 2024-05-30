@extends('layouts.master')
@section('title', 'Beranda')
@section('content')
    <div class="row">
        <div class="d-flex flex-column px-5" style="margin-top:80px; margin-bottom:150px;">
            <div class="row" style="padding: 0 200px 0 120px">
                <div class="col-md-2">
                    <img class="rounded-circle ms-2 me-2" src="{{ Auth::user()->profile_pic }}" alt="profile pic" width="120px">
                </div>
                <div class="col-md-9">
                    <div class="d-flex align-items-center ms-4">
                        <div class="d-flex flex-column w-50">
                            <p class="text-white fw-bold mb-2" style="font-size: 18px;">{{ Auth::user()->username }}</p>
                            <div class="d-flex">
                                <p class="text-secondary me-3 mb-2" style="font-size: 14px;">
                                    <b class="text-white">0</b> Posts
                                </p>
                                <p class="text-secondary me-3 mb-2" style="font-size: 14px;">
                                    <b class="text-white">0</b> Followers
                                </p>
                                <p class="text-secondary mb-2" style="font-size: 14px;">
                                    <b class="text-white">0</b> Following
                                </p>
                            </div>
                            <p class="mb-0 text-secondary fw-bold" style="font-size: 14px;">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-link ms-4 text-white" type="button" id="toggleSetting">
                        <i id="settingIcon" class="bi bi-gear-fill"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
