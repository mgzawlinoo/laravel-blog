<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/frontend/assets/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ Vite::asset('resources/frontend/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
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
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('{{ Vite::asset('resources/frontend/assets/img/home-bg.jpg') }}')">
            <div class="container px-4 position-relative px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>DevDreams</h1>
                            <span class="subheading">For the lovers of technology</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-8">

                    @if ($posts->isEmpty())
                        <p>No posts available</p>
                    @else
                        @foreach ($posts as $post)
                            <x-post.post-item :post="$post" />
                        @endforeach
                    @endif

                </div>

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
            </div>
        </div>
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="text-center list-inline">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="text-center small text-muted fst-italic">Copyright &copy; Your Website 2023</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ Vite::asset('resources/frontend/js/scripts.js') }}"></script>
    </body>
</html>
