<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightgallery.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!-- Header Block Start -->
    <header id="site-header">

        <nav class="navbar navbar-dark bg-dark navbar-expand-lg bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/"><i class="fa-solid fa-plane"></i> YouTravel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarSupportedContent">
                    <div class="d-flex">
                        @if(Auth::check())
                        <form method="POST" action="{{ route('auth.logout') }}">
                            @csrf
                            @method('POST')
                            
                            <button type="submit" class="btn btn-sm fw-semibold"
                                style="background-color: #de5285;color:white">Logout</button>
                        </form>
                        @else
                        <a href="/signin" class="btn btn-sm fw-semibold"
                            style="background-color: #de5285;color:white">Sign in</a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main style="flex-grow: 1">
        @yield('content')
    </main>

    <footer id="site-footer">
            <div class="bg-dark py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                            class="fa-brands fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                            class="fa-brands fa-youtube"></i></a></li>
                                <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                            class="fa-brands fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                            class="fa-brands fa-linkedin-in"></i></a></li>
                                <li class="list-inline-item"><a class="btn btn-outline-secondary" href="#"><i
                                            class="fa-brands fa-github"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-12"><span
                                class="text-secondary pt-1 float-md-end float-sm-start">Copyright
                                &copy; 2024</span></div>
                    </div>
                </div>
            </div>
        </footer>

    <a href="#" class="scrollToTop btn btn-outline-secondary">Top</a>

    <!-- JavaScript Files -->
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script type="text/javascript">
        /* Animate On Scroll */
        AOS.init();
        /* light Gallery */
        lightGallery(document.getElementById('lightgallery'), {
            subHtmlSelectorRelative: true,
        });
    </script>
</body>

</html>