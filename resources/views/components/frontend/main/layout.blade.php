<x-frontend.main.head/>
<!-- Navigation-->
<x-frontend.main.nav />
<!-- Page Header-->
<x-frontend.main.header />
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-lg-8 col-xl-8">

            {{ $slot }}

        </div>

        <x-frontend.main.sidebar />

    </div>
</div>
<!-- Footer-->
<x-frontend.main.footer />

