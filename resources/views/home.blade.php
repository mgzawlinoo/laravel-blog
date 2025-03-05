@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Home Page</h1>
        <p class="lead">
            {{ $data }}
        </p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    </div>
</div>

@endsection
