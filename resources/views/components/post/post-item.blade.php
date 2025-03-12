@props(['post'])

<div class="post-preview">
    <a href="#">
        <h2 class="post-title">{{ $post->title }}</h2>
        <h3 class="post-subtitle">{{ $post->description }}</h3>
    </a>
    <p class="post-meta">
        Posted by
        <a href="#">{{ $post->user->name }}</a>
        on {{ $post->updated_at->diffForHumans() }} |
        Category: <a href="#">{{ $post->category->name }}</a>
    </p>
</div>
<!-- Divider-->
<hr class="my-4" />
