@extends('app.base')

@section('content')

@if (session()->has('user') && session('user')->name == $user->name)
<div class="border-bottom">
    <div class="subnav w-50 m-auto">
        <ul class="list-group list-group-horizontal text-uppercase font-weight-bold">
            <li class="list-inline-item mr-4 pt-3 pb-3 active"><a href="#" class="pt-3 pb-3 ">Overview</a></li>
            <li class="list-inline-item mr-4 pt-3 pb-3"><a href="{{ url('user/' . $user->id . '/posts') }}" class="pt-3 pb-3">Posts</a></li>
            <li class="list-inline-item pt-3 pb-3"><a href="{{ url('user/' . $user->id . '/comments') }}" class="pt-3 pb-3">Comments</a></li>
        </ul>
    </div>
</div>
<div style="min-height: 75.1vh;" class="d-flex align-items-center">
    <div class="container rounded bg-white m-auto">
        <div class="row">
            <div class="col-md-5 border-right d-flex justify-content-end">
                <div class="d-flex flex-column pb-5 mb-5 align-items-center w-50">
                    <img class="rounded-circle mt-5" width="150px" src="{{ $user->image }}">
                    <span class="font-weight-bold">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }}</span><span class="text-black-50">{{ $user->birthdate }}</span>
                </div>
            </div>
            <form action="{{ url('user/' . $user->id) }}" class="col-md-5 border-right d-flex align-items-center" method="post">
                @method('put')
                @csrf
                @error('userEditError')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="p-3 py-5 w-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <div class="row mt-3">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="w-100">
                            <label class="labels" for="name">Username</label>
                            <input type="text" name="name" class="form-control" placeholder="username" value="{{ old('name' , $user->name) }}" minlength="3">
                        </div>
                    </div>
                    <div class="row mt-3">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div >
                            <label class="labels" for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email' , $user->email) }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="mt-4">
                        <input class="btn btn-primary profile-button" type="submit" value="Save Profile"></input>
                        <a href="{{ Request::url() }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="border-bottom">
    <div class="subnav w-50 m-auto">
        <ul class="list-group list-group-horizontal text-uppercase font-weight-bold">
            <li class="list-inline-item mr-4 pt-3 pb-3 active"><a href="#" class="pt-3 pb-3 ">Overview</a></li>
            <li class="list-inline-item mr-4 pt-3 pb-3"><a href="{{ url('user/' . $user->id . '/posts') }}" class="pt-3 pb-3">Posts</a></li>
            <li class="list-inline-item pt-3 pb-3"><a href="{{ url('user/' . $user->id . '/comments') }}" class="pt-3 pb-3">Comments</a></li>
        </ul>
    </div>
</div>
<div style="min-height: 75.1vh;" class="d-flex align-items-center">
    <div class="container rounded bg-white m-auto">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column pb-5 mb-5 align-items-center w-50">
                    <img class="rounded-circle mt-5" width="300px" src="{{ $user->image }}">
                    <h2 class="font-weight-bold text-capitalize">{{ $user->name }}</h2><h3 class="text-black-50">{{ $user->email }}</h3><h3 class="text-black-50">{{ $user->birthdate }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('styles')
    <style>
        .navbar{
            margin: 0 !important;;
        }
        
        .subnav .active a{
            color: #0d6efd;
            border-bottom:  2px solid #0d6efd;
        }
        
        .subnav li a{
            color: black;
            text-decoration: none;
        }
        
        .subnav li:hover a{
            color: #0d6efd;
            border-bottom:  2px solid #0d6efd;
        }
    </style>
@endsection 