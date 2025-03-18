<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('index') }}">Welcome</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="py-4 navbar-nav ms-auto py-lg-0">
                <li class="nav-item"><a class="py-3 nav-link px-lg-3 py-lg-4" href="{{ route('index') }}">Home</a></li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item"><a href="{{ route('backend.dashboard')}}" class="py-3 nav-link px-lg-3 py-lg-4">Dashboard</a></li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="py-3 nav-link px-lg-3 py-lg-4">Log in</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="py-3 nav-link px-lg-3 py-lg-4">Register</a></li>
                        @endif
                    @endauth
                @endif

            </ul>
        </div>
    </div>
</nav>