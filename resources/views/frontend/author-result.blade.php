<x-frontend.main.layout>

    <div class="p-3 mb-3 rounded bg-secondary d-flex justify-content-between align-items-center">
        <h1 class="p-0 m-0 text-warning">{{ $user->name }}</h1>
        <!-- Follow Button -->
        @if (Auth::check())
            @if (Auth::user()->isFollowing($user))
                <form action="{{ route('unfollow', $user) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded btn btn-warning btn-sm">
                        <span class="text-white me-2">
                            <i class="bi bi-person-plus"></i>
                            Unfollow
                        </span>
                    </button>
                </form>
            @else

                <form action="{{ route('follow', $user) }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded btn btn-warning btn-sm">
                        <span class="text-white me-2">
                            <i class="bi bi-person-plus"></i>
                            Follow
                        </span>
                    </button>
                </form>

            @endif
        @else
            <a href="{{ route('login') }}" class="rounded btn btn-warning btn-sm">
                <span class="text-white me-2">
                    <i class="bi bi-person-plus"></i>
                    Follow
                </span>
            </a>
        @endif
    </div>

    @if ($posts->isEmpty())
        <p>No posts available</p>
    @else
        @foreach ($posts as $post)
            <x-frontend.post-item :post="$post" />
        @endforeach
    @endif

    {{ $posts->withQueryString()->links() }}
</x-frontend.layout>