<x-frontend.main.layout>
    @if ($posts->isEmpty())
        <p>No posts available</p>
    @else
        @foreach ($posts as $post)
            <x-frontend.post-item :post="$post" />
        @endforeach
    @endif
</x-frontend.main.layout>