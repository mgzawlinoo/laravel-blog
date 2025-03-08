<nav class="navbar navbar-expand-lg bg-danger-subtle fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('backend.dashboard') }}">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mb-2 navbar-nav me-auto mb-lg-0">

          <li class="nav-item">
            <a class="nav-link @if (request()->is('/backend')) active @endif" aria-current="page" href="{{ route('backend.dashboard') }}">Dashboard</a>
          </li>

        </ul>
        <form class="d-flex" role="search" method="GET" action="{{ route('backend.posts.search') }}">
            @csrf
            <input class="form-control me-2" type="text" name="q" placeholder="Search Post" aria-label="Search">
            <button class="text-white btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

      </div>
    </div>
  </nav>
