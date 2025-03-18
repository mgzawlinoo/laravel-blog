<div class="col-lg-4 col-xl-4">

    <div class="post-preview">
        <h3>Categories</h3>
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item"><a href="{{ route('getPostsByCategory', $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>

        <h3 class="mt-4">Users</h3>
        <ul class="list-group">
            @foreach ($users as $user)
                <li class="list-group-item"><a href="{{ route('getPostsByUser', $user->id) }}">{{ $user->name }}</a></li>
            @endforeach
        </ul>
    </div>

</div>