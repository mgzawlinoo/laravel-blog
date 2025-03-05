@extends('layouts.app')

@section('title', 'Post Page')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Post Page</h1>
        <p class="lead">
            {{ $content }}
        </p>
        <hr class="my-4">
        <h1>Categories</h1>
        <ul class="list-group">
            @foreach ($mainCategories as $subCategory => $items)
                <li class="list-group-item"> {{ $subCategory }}
                    <ul class="my-2 list-group">
                        @foreach ($items as $item)
                            <li class="list-group-item"> {{ $item }} </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
