<nav class="mb-5 navbar navbar-expand-lg bg-danger-subtle">
    <div class="container">
      <a class="navbar-brand" href="/">Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mb-2 navbar-nav me-auto mb-lg-0">

          <li class="nav-item">
            <a class="nav-link @if (request()->is('/')) active @endif" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (request()->is('posts')) active @endif" href="{{ route('posts.index') }}">Posts</a>
          </li>

        </ul>
        <form class="d-flex" role="search" method="GET" action="{{ route('posts.search') }}">
            @csrf
            <input class="form-control me-2" type="text" name="q" placeholder="Search" aria-label="Search">
            <button class="text-white btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
      </div>
    </div>
  </nav>
