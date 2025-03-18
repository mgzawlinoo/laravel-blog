<x-frontend.layout>

    <div class="p-3 mb-3 rounded bg-secondary d-flex justify-content-between align-items-center">
        <h1 class="p-0 m-0 text-warning">{{ $name }}</h1>
        <a class="btn btn-secondary btn-sm" href="{{ route('index') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>

    @if ($posts->isEmpty())
        <p>No posts available</p>
    @else
        @foreach ($posts as $post)
            <x-frontend.post-item :post="$post" />
        @endforeach
    @endif
</x-frontend.layout>