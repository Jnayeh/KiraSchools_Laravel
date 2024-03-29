<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KiraSchools</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="{{ asset('lib/flaticon/font/flaticon.css') }}" rel="stylesheet">

    <!-- Boxicons Font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
</head>

{{-- <body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-5 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="text-center dark:text-white">WELCOME</div>
        </div>
    </div>
    </div>
</body> --}}

<body class="d-flex flex-column justify-content-between body-user">
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 ">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <i class="flaticon-043-teddy-bear"></i>
                <span class="text-primary">KiraSchools</span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    @guest
                        <a href="/" class="nav-item nav-link  {{ Request::is('/') ? 'active' : '' }}">Accueil</a>
                        <a href="/about" class="nav-item nav-link  {{ Request::is('about') ? 'active' : '' }}">
                            A Propos Nous</a>
                        <a href=" /contact"
                            class="nav-item nav-link  {{ Request::is('contact') ? 'active' : '' }}">Contactez-Nous</a>
                    @else
                        @if (Auth::user()->role == 'professeur')
                            <script>
                                $(document).ready(function() {
                                    $.ajax({
                                        type: 'GET',
                                        url: "{{ route('prof_homeworks_notification') }}",

                                        success: function(data) {
                                            if (data.length > 0) {
                                                document.getElementById("prof_homeworks").innerHTML =
                                                    'Homeworks <span class="position-absolute top-5 start-1 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">notifications non-lus</span></span>';
                                            }
                                        }
                                    });
                                });
                            </script>

                            <script>
                                $(document).ready(function() {
                                    $.ajax({
                                        type: 'GET',
                                        url: "{{ route('prof_reclamations_notification') }}",

                                        success: function(data) {
                                            if (data.length > 0) {
                                                document.getElementById("prof_reclamations").innerHTML =
                                                    'Reclamations <span class="position-absolute top-5 start-1 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">notifications non-lus</span></span>';
                                            }
                                        }
                                    });
                                });
                            </script>

                            <a href="/prof_home"
                                class="nav-item nav-link  {{ Request::is('prof_home') ? 'active' : '' }}">Accueil</a>
                            <a href="/prof_homeworks" id="prof_homeworks"
                                class="nav-item nav-link  position-relative p-2 my-auto px-3 {{ str_contains(Route::currentRouteName(), 'homeworks') ? 'active' : '' }}">Homeworks
                            </a>
                            <a href="/prof_reclamations" id="prof_reclamations"
                                class="nav-item nav-link  position-relative p-2 my-auto px-3 {{ str_contains(Route::currentRouteName(), 'reclamations') ? 'active' : '' }}">Reclamations
                            </a>
                            <a href="/professeur/emplois_prof" target="blank" class="nav-item nav-link ">Emploi</a>
                        @elseif (Auth::user()->role == 'parent')
                            <script>
                                $(document).ready(function() {
                                    $.ajax({
                                        type: 'GET',
                                        url: "{{ route('parent_homeworks_notification') }}",

                                        success: function(data) {
                                            console.log("Parent homeworks: ", data);
                                            if (data.length > 0) {
                                                document.getElementById("parent_homeworks").innerHTML =
                                                    'Homeworks <span class="position-absolute top-5 start-1 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">notifications non-lus</span></span>';
                                            }
                                        }
                                    });
                                });
                            </script>

                            <script>
                                $(document).ready(function() {
                                    $.ajax({
                                        type: 'GET',
                                        url: "{{ route('parent_reclamations_notification') }}",

                                        success: function(data) {
                                            console.log("Parent reclamations: ", data);
                                            if (data.length > 0) {
                                                document.getElementById("parent_reclamations").innerHTML =
                                                    'Reclamations <span class="position-absolute top-5 start-1 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">notifications non-lus</span></span>';
                                            }
                                        }
                                    });
                                });
                            </script>
                            <a href="/parent_home"
                                class="nav-item nav-link  {{ Request::is('parent_home') ? 'active' : '' }}">Accueil</a>
                            <a href="/parent_homeworks" id="parent_homeworks"
                                class="nav-item nav-link  position-relative p-2 my-auto px-3 {{ str_contains(Route::currentRouteName(), 'homeworks') ? 'active' : '' }}">Homeworks
                            </a>
                            <a href="/parent_reclamations" id="parent_reclamations"
                                class="nav-item nav-link  position-relative p-2 my-auto px-3 {{ str_contains(Route::currentRouteName(), 'reclamations') ? 'active' : '' }}">Reclamations
                            </a>
                            <a href="/parent_emplois"
                                class="nav-item nav-link  position-relative p-2 my-auto px-3 {{ str_contains(Route::currentRouteName(), 'parent_emplois') ? 'active' : '' }}">
                                Emplois d'élèves
                                {{-- <span
                                    class="position-absolute top-5 start-1 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                    <span class="visually-hidden">notifications non-lus</span>
                                </span> --}}
                            </a>
                            <a href="/parent_bulletins"
                                class="nav-item nav-link  {{ str_contains(Route::currentRouteName(), 'bulletins') ? 'active' : '' }}">Bulletins</a>
                        @elseif (Auth::user()->role == 'admin')
                            <a href="/" class="nav-item nav-link  {{ Request::is('/') ? 'active' : '' }}">Accueil</a>
                            <a href="/home" class="nav-item nav-link  {{ Request::is('home') ? 'active' : '' }}">Espace
                                admin</a>
                        @endif

                    @endguest
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="  navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-primary text-nowrap">Se Connecter</a>
                        @endif
                    @else
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Notifications <span class="badge badge-danger"> </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li> --}}

                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-item nav-link  d-flex align-items-center " style="font-weight: bold">
                            <i class='bx bx-log-out-circle px-2' style="font-size: 20px"></i>
                            <span>{{ Auth::user()->name . ' ' . Auth::user()->firstname }}</span>
                        </a>
                    @endguest
                </ul>

            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-white mt-5 py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col">
                <a href="" class="navbar-brand font-weight-bold text-primary m-0 mb-4 p-0"
                    style="font-size: 40px; line-height: 40px;">
                    <i class="flaticon-043-teddy-bear"></i>
                    <span class="text-white">KiraSchools</span>
                </a>
                <p>Labore dolor amet ipsum ea, erat sit ipsum duo eos. Volup amet ea dolor et magna
                    dolor, elitr
                    rebum
                    duo est sed diam elitr. Stet elitr stet diam duo eos rebum ipsum diam ipsum elitr.
                </p>
                <div class="d-flex justify-content-start mt-4 mb-2">
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary rounded-circle text-center mr-2 px-0"
                        style="width: 38px; height: 38px;" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col">
                <h3 class="text-primary mb-4">Contactez-nous</h3>
                <div class="d-flex">
                    <h4 class="fa fa-map-marker-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Adresse</h5>
                        <p>Notre adresse</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-envelope text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Email</h5>
                        <p>info@kira-schools.com</p>
                    </div>
                </div>
                <div class="d-flex">
                    <h4 class="fa fa-phone-alt text-primary"></h4>
                    <div class="pl-3">
                        <h5 class="text-white">Téléphone</h5>
                        <p>+216 22 222 222</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <h3 class="text-primary mb-4">Les Liens</h3>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Accueil</a>
                    <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>A Propos
                        Nous</a>
                    <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>Contactez-Nous</a>
                </div>
            </div>

        </div>
        <div class="container-fluid pt-5" style="border-top: 1px solid rgba(23, 162, 184, .2);;">
            <p class="m-0 text-center text-white">
                &copy; <a class="text-primary font-weight-bold" href="#">KiraSchools</a>. All Rights
                Reserved.
            </p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>


</body>

</html>
