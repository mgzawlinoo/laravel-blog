<x-frontend.main.layout>

    @if ($posts->isEmpty())
        <p>No posts available</p>
    @else
    <h1>Hello</h1>
        @foreach ($posts as $post)
            <x-frontend.post-item :post="$post" />
        @endforeach
    @endif

    {{ $posts->withQueryString()->links() }}

</x-frontend.main.layout>