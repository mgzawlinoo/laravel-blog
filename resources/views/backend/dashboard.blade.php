@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="p-3 mb-3 rounded bg-warning-subtle d-flex justify-content-between align-items-center">
        <h4 class="p-0 m-0">Dashboard</h4>
        <div class="mt-auto btn-group dropdown">
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fa-regular fa-circle-user"></i><span class="ms-2 d-none d-md-inline">{{ Auth::user()->name}}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{ route('backend.profile.edit') }}">Edit Profile</a></li>
                <li><form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}</a>
                </form></li>
            </ul>
        </div>
    </div>
</div>

    <div class="row">
        <div class="mb-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Posts</h5>
                    <p class="card-text">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
