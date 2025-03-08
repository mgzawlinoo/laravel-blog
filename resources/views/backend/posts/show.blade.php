@extends('backend.layouts.app')

@section('title', 'Edit Post')

@section('content')

    <div class="p-3 mb-3 rounded bg-warning-subtle d-flex justify-content-between align-items-center">
        <h4 class="p-0 m-0">{{ $post->title }}</h4>
        <a class="btn btn-secondary" href="{{ route('backend.posts.index') }}"><i class="text-white fa-solid fa-arrow-left"></i> Back</a>
    </div>

    <div class="pb-5 mx-auto mb-5 col-md-8">
        <div class="my-4">
            {!! $post->photo ? '<img src="' . asset('storage/' . $post->photo) . '" alt="Post Photo" style="max-width: 100%; height: auto">' : '' !!}
        </div>

        {!! $post->content !!}

    </div>

@endsection
