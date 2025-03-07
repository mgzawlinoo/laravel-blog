@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="mb-3 d-flex justify-content-between align-items-center border-bottom">
                <h2>{{ $post->title }}</h2>
                <a class="btn btn-secondary" href="{{ route('posts.index') }}"><i class="text-white fa-solid fa-arrow-left"></i> Back</a>
                </div>

                <div class="pb-5 mx-auto mb-5 col-md-12">
                    <div class="my-4">
                        {!! $post->photo ? '<img src="' . asset('storage/' . $post->photo) . '" alt="Post Photo" style="max-width: 100%; height: auto">' : '' !!}
                    </div>

                    {!! $post->content !!}

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
