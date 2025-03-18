<x-frontend.layout>

    <div class="p-3 mb-3 rounded bg-secondary d-flex justify-content-between align-items-center">
        <h1 class="p-0 m-0 text-warning">{{ $post->title }}</h1>
        <a class="btn btn-secondary btn-sm" href="{{ route('index') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    <p class="post-meta">
        <span class="text-primary">Posted by</span>
        <a class="text-decoration-none" href="{{ route('getPostsByUser', $post->user) }}">{{ $post->user->name }}</a>
        on {{ $post->updated_at->diffForHumans() }} |
        <span class="text-primary">Category: </span><a class="text-decoration-none" href="{{ route('getPostsByCategory', $post->category) }}">{{ $post->category->name }}</a>
    </p>

    <div class="pb-5 mx-auto mb-5">
        <div class="my-4">
            {!! $post->photo ? '<img src="' . asset('storage/' . $post->photo) . '" alt="Post Photo" style="max-width: 100%; height: auto">' : '' !!}
        </div>

        {!! $post->content !!}

    </div>

</x-frontend.layout>