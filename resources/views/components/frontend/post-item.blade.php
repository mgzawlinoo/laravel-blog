@props(['post'])

<div class="post-preview">
    <a href="{{ route('post', $post->slug) }}">
        <h2 class="post-title text-warning">{{ $post->title }}</h2>
        <h3 class="post-subtitle">{{ $post->description }}</h3>
    </a>
    <p class="post-meta">
        <span class="text-primary">Posted by</span>
        <a href="{{ route('getPostsByUser', $post->user->id) }}">{{ $post->user->name }}</a>
        on {{ $post->updated_at->diffForHumans() }} |
        <span class="text-primary">Category: </span><a href="{{ route('getPostsByCategory', $post->category->slug) }}">{{ $post->category->name }}</a> |

        <span class="text-primary">Tags: </span>
            @foreach($post->tags as $tag)
            <a href="{{ route('getPostsByTag', $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach

    </p>
    <div class="text-end">
        <a class="rounded btn btn-primary btn-sm" href="{{ route('post', $post->slug)}}">Read More</a>
    </div>
</div>
<!-- Divider-->
<hr class="my-4" />
