@props(['post'])

<div class="post-preview">
    <a href="{{ route('post', $post->slug) }}">
        <h2 class="post-title">{{ $post->title }}</h2>
        <h3 class="post-subtitle">{{ $post->description }}</h3>
    </a>
    <p class="post-meta">
        <span class="text-primary">Posted by</span>
        <a href="{{ route('getPostsByUser', $post->user) }}">{{ $post->user->name }}</a>
        on {{ $post->updated_at->diffForHumans() }} |
        <span class="text-primary">Category: </span><a href="{{ route('getPostsByCategory', $post->category) }}">{{ $post->category->name }}</a>
    </p>
    <div class="text-end">
        <a class="rounded btn btn-primary btn-sm" href="{{ route('post', $post->slug)}}">Read More</a>
    </div>
</div>
<!-- Divider-->
<hr class="my-4" />
