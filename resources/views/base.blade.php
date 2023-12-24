<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'BlogMVC')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
        integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
    </script>
    <style>
        .navbar {
            margin-bottom: 2rem;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-fixed-top navbar-toggleable-md navbar-inverse bg-primary">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="">Blogmvc</a>
        <ul class="nav navbar-nav mr-auto mb-2">
            <li>
                {{-- <a @class(['nav-link', 'active' => request()->routeIs('blog.index')])>Acceuil</a> --}}
                <a href="{{ route('blog.index') }}"
                    class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}">
                    Acceuil
                </a>


            </li>
            <li class="nav-item active">
                <a class="nav-link" href="">Blog</a>
            </li>
        </ul>
        {{-- <ul class="navbar-nav mb-2">
            <li class="nav-item active">
                <a class="nav-link" href="">backend</a>
            </li>
        </ul> --}}
        <div class="navbar-nav ms-auto mb2 mb-lg-0">
            @auth
                Bienvenu {{ Auth::user()->name }}
                <form action="{{ route('blog.auth.logout') }}" class="nav-item mr-3 ml-3" method="POST">
                    @method('delete')
                    @csrf
                    <button>Se deconnecter</button>

                </form>
            @endauth
            @guest
                <div class="nav-item mr-3">
                    <a href="{{ 'blog.update' }}" class="nav-link">Se connecter</a>



                </div>


            @endguest

        </div>
    </nav>

    <div class="container">
        <main role="main">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div> <!-- /container -->

</body>

</html>
