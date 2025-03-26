<x-frontend.main.layout>

    <h1 class="text-dark">{{ $post->title }}</h1>

    <!-- Like Dislike -->
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            @if (Auth::check())
            <form action="{{ route('like', $post) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm me-2">
                    <span class="text-white me-2">{{ $post->likes()->count() }}
                        Like
                    </span>
                </button>
            </form>
            <form action="{{ route('dislike', $post) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <span class="text-white me-2">{{ $post->dislikes()->count() }}
                        Dislike
                    </span>
                </button>
            </form>
            @else
                <a href="{{ route('login') }}" class="text-white text-decoration-none btn btn-primary btn-sm me-2">
                    <span class="text-white me-2">{{ $post->likes()->count() }}
                        Like
                    </span>
                </a>
                <a href="{{ route('login') }}" class="text-white text-decoration-none btn btn-danger btn-sm">
                    <span class="text-white me-2">{{ $post->dislikes()->count() }}
                        Dislike
                    </span>
                </a>
            @endif
        </div>
    </div>

    <!-- Post by and Category -->
    <p class="my-4 post-meta">
        <b>Posted by : </b>
        <a class="text-primary text-decoration-none" href="{{ route('getPostsByUser', $post->user) }}">{{ $post->user->name }}</a>
        <span class="text-muted">{{ $post->updated_at->diffForHumans() }}</span>
        <br><b>Category : </b><a class="text-primary text-decoration-none" href="{{ route('getPostsByCategory', $post->category) }}">{{ $post->category->name }}</a>
        <br><b>Tags : </b>
            @foreach($post->tags as $tag)
                @if($loop->last)
                    <a class="text-primary text-decoration-none" href="{{ route('getPostsByTag', $tag->slug) }}">{{ $tag->name }}</a>
                @else
                    <a class="text-primary text-decoration-none" href="{{ route('getPostsByTag', $tag->slug) }}">{{ $tag->name }}</a>,
                @endif
            @endforeach
    </p>

    <!-- Main Content -->
    <div class="pb-5 mx-auto mb-5">
        <div class="my-4">
            {!! $post->photo ? '<img src="' . asset('storage/' . $post->photo) . '" alt="Post Photo" style="max-width: 100%; height: auto">' : '' !!}
        </div>
        {!! $post->content !!}
    </div>

    <!-- Comment -->
    <div class="p-3 my-4 rounded border border-dark">
        <h3 class="ps-2 text-dark border-b-1 border-bottom">Comments</h3>
        @if ($post->comments->isNotEmpty())
            @foreach ($post->comments as $comment)
                <div class="mt-4">
                    <div style="background-color:palegoldenrod" class="p-2 px-4 rounded border border-dark">
                        <div>
                            <a class="text-decoration-none" href="{{ route('getPostsByUser', $comment->user) }}">{{ $comment->user->name }}</a>
                            <span class="text-muted">{{ $comment->updated_at->diffForHumans() }}</span>
                        </div>
                        <span class="py-2 d-block ps-4">{!! $comment->content !!}</span>
                    </div>
                    @if ($comment->replies->isNotEmpty())
                        @foreach ($comment->replies as $reply)
                        <div style="background-color:floralwhite" class="p-2 px-4 my-2 rounded border ms-5 border-dark">
                            <div>
                                <a class="text-decoration-none" href="{{ route('getPostsByUser', $reply->user) }}">{{ $reply->user->name }}</a>
                                <span class="text-muted">{{ $reply->updated_at->diffForHumans() }}</span>
                            </div>
                            <span class="py-2 d-block ps-4">
                                {!! $reply->content !!}
                            </span>
                        </div>
                        @endforeach
                    @endif
                    @if (Auth::check())
                    <div x-data="{ open: false}">
                        <div class="mb-3 text-end"><span x-on:click="open = !open" class="text-warning">Reply</span></div>
                        <template x-if="open">
                            <form class="ms-4" action="{{ route('comments.reply', $comment) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-3 ps-4">
                                    <textarea class="rounded form-control @error('content') is-invalid @enderror" id="content" name="content" rows="2"></textarea>
                                </div>
                                <div class="text-end"><button type="submit" style="background-color:floralwhite" class="border btn btn-sm">Submit</button></div>
                            </form>
                        </template>
                    </div>
                    @else
                    <div class="mb-3 text-end"><a href="{{ route('login') }}" class="text-warning">Reply</a></div>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-white">No comments available</p>
        @endif
    </div>

    <div class="pt-5 my-4 mt-5">
        <h3>Leave a Comment</h3>

        @if (Auth::check())
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-3">
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3"></textarea>
                </div>
                <button type="submit" style="background-color:palegoldenrod" class="border btn">Submit</button>
            </form>
        @else
            <p class="text-danger">Please <a href="{{ route('login') }}">login</a> to leave a comment</p>
        @endif
    </div>
</x-frontend.main.layout>