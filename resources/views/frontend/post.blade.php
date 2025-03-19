<x-frontend.main.layout>

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

    <div class="p-3 my-4 rounded border bg-warning-subtle">
        <h3 class="border-b-1 border-bottom text-danger">Comments</h3>
        @if ($post->comments->isNotEmpty())
            @foreach ($post->comments as $comment)
                <div class="my-4">
                    <p class="post-meta">
                        <span class="text-danger">Comment by</span>
                        <a class="text-decoration-none" href="{{ route('getPostsByUser', $comment->user) }}">{{ $comment->user->name }}</a>
                        on {{ $comment->updated_at->diffForHumans() }}
                    </p>
                    <div class="pb-2 mx-auto">
                        {!! $comment->content !!}
                    </div>
                    @if (Auth::check())
                        <form action="{{ route('comments.reply', $comment) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3"></textarea>
                            </div>
                            <div class="text-end"><button type="submit" class="btn btn-success btn-sm">Reply</button></div>
                        </form>
                    @endif
                    @if ($comment->replies->isNotEmpty())
                        <h4>Replies</h4>
                        @foreach ($comment->replies as $reply)
                            <div class="my-4">
                                <p class="post-meta">
                                    <span class="text-primary">Posted by</span>
                                    <a class="text-decoration-none" href="{{ route('getPostsByUser', $reply->user) }}">{{ $reply->user->name }}</a>
                                    on {{ $reply->updated_at->diffForHumans() }}
                                </p>
                                <div class="pb-5 mx-auto mb-5">
                                    {!! $reply->content !!}
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
            @endforeach
        @else
            <p>No comments available</p>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @else
            <p class="text-danger">Please <a href="{{ route('login') }}">login</a> to leave a comment</p>
        @endif
    </div>
</x-frontend.main.layout>