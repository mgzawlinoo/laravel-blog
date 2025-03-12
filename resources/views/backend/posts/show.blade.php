@extends('backend.layouts.app')

@section('title', 'Edit Post')

@section('content')

    <x-header class="btn-secondary" :title="$post->title" :route="route('backend.posts.index')" linkText="Back">
        <b>Description : </b>{{ $post->description }}
    </x-header>

    <div class="pb-5 mx-auto mb-5 col-md-8">
        <div class="my-4">
            {!! $post->photo ? '<img src="' . asset('storage/' . $post->photo) . '" alt="Post Photo" style="max-width: 100%; height: auto">' : '' !!}
        </div>

        {!! $post->content !!}

    </div>

@endsection
