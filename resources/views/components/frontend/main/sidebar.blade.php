<div class="col-lg-4 col-xl-4">

    <div class="post-preview">
        <h3>Categories</h3>
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a class="flex-grow-1" href="{{ route('getPostsByCategory', $category->slug) }}">{{ $category->name }}</a>
                    <span class="rounded badge text-bg-danger">{{ $category->posts()->count() }}</span>
                </li>
            @endforeach
        </ul>

        <h3 class="mt-4">Users</h3>
        <ul class="list-group">
            @foreach ($users as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a class="flex-grow-1" href="{{ route('getPostsByUser', $user->id) }}">{{ $user->name }}</a>
                <span class="rounded badge text-bg-secondary">{{ $user->posts()->count() }}</span>
            </li>
            @endforeach
        </ul>
    </div>

</div>