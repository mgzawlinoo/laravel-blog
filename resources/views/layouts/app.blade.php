@include('layouts.header')
@include('layouts.nav')

    <div class="container">
        <div class="row">
            <div class="col">
                @yield('content')
            </div>
        </div>
    </div>

@include('layouts.footer')
