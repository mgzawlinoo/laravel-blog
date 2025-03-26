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
                        <li class="nav-item">
                            <form class="d-inline" method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a style="font-size: 0.75rem;font-weight: 800;letter-spacing: 0.0625em;text-transform: uppercase;"
                                href="{{ route('logout') }}" class="py-3 text-white nav-link px-lg-3 py-lg-4"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}</a>
                            </form>
                        </li>
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