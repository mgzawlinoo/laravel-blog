@include('backend.layouts.header')

    <div class="container-fluid">
        <div class="flex-nowrap row min-vh-100">
            <div class="col-auto py-4 my-4 rounded bg-primary-subtle d-flex flex-column">

                <nav class="rounded navbar navbar-light bg-light">
                    <div class="container">
                      <a class="navbar-brand" href="{{ route('backend.dashboard') }}">
                        <i class="fa-brands fa-hive"></i> <span class="d-none d-md-inline">Admin Panel</span>
                      </a>
                    </div>
                </nav>

                <div class="mt-2 list-group">
                    <a href="{{ route('backend.posts.index') }}" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-list"></i><span class="ms-2 d-none d-md-inline">Posts</span></a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-layer-group"></i><span class="ms-2 d-none d-md-inline">Categories</span></a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-users"></i><span class="ms-2 d-none d-md-inline">Users</span></a>
                    <a href="{{ route('index') }}" target="_blank" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-globe"></i><span class="ms-2 d-none d-md-inline">Preview Website</span></a>
                </div>

                <div class="mt-auto btn-group dropup">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-circle-user"></i><span class="ms-2 d-none d-md-inline">User Name</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>

            </div>
            <div class="px-4 py-5 col">
                @yield('content')
            </div>
        </div>
    </div>

@include('backend.layouts.footer')
