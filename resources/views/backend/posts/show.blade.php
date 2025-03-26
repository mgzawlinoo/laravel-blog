@extends('backend.layouts.app')

@section('title', 'Edit Post')

@section('content')

    <x-backend.main.header class="btn-secondary" :title="$post->title" :route="route('backend.posts.index')" linkText="Back">
    </x-backend.main.header>

    <p class="mx-auto col-md-8"><b>Description : </b>{{ $post->description }}</p>
    <p class="mx-auto col-md-8">
        <span class="text-primary">Posted by : </span> {{ $post->user->name }}
        on {{ $post->updated_at->diffForHumans() }} <br>
        <span class="text-primary">Category : </span> {{ $post->category->name }} <br>
        <span class="text-primary">Tags : </span>
        @foreach ($post->tags as $tag)
            @if ($loop->last)
                {{ $tag->name }}
            @else
                {{ $tag->name }},
            @endif
        @endforeach
    </p>
    <div class="pb-5 mx-auto mb-5 col-md-8">
        <div class="my-4">
            {!! $post->photo ? '<img src="' . asset('storage/' . $post->photo) . '" alt="Post Photo" style="max-width: 100%; height: auto">' : '' !!}
        </div>

        {!! $post->content !!}

    </div>

@endsection
