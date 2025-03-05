@extends('layouts.app')

@section('title', 'About Page')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">About Page</h1>
        <p class="lead">This is a simple hero unit text to build on the card title and make up the bulk of the card's content.</p>

        <ul class="list-group">
            @foreach ($students as $student)
                <li class="list-group-item">{{ $student }}</li>
            @endforeach
        </ul>

    </div>
</div>

@endsection
