<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FriendGram</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/') }}">
                    <img src="/svg/logo.svg" style="height: 25px; padding-right: 8px; border-right: #333 solid 1px" alt="">
                    <div style="padding-left: 8px;">FriendGram</div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <div class="align-items-center">
                                <form class="typeahead ms-3 mt-1" role="search">
                                    <input type="search" name="q" class="form-control search-input" placeholder="Search..." autocomplete="off">
                                </form>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ url('') }}" class="dropdown-item">Home</a>
                                    <a href="{{ route('show', Auth::user()->id) }}" class="dropdown-item">Show Profile</a>
                                    <a href="{{ route('edit', Auth::user()->id) }}" class="dropdown-item">Edit Profile</a>
                                    <a href="/users" class="dropdown-item">Users list</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <img src="{{Auth::user()->profile->profileImage()}}" alt="" class="rounded-circle ms-2" style="width: 50px">
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
        $(document).ready(function($) {
            var engine1 = new Bloodhound({
                remote: {
                    url: '/search/name?value=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            var engine2 = new Bloodhound({
                remote: {
                    url: '/search/caption?value=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            })

            $(".search-input").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },[
                {
                    source: engine1.ttAdapter(),
                    name: 'users-name',
                    display: function (data) {
                        return data.name
                    },
                    templates: {
                        empty: [
                            '<div class="header-title">Name</div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                        ],
                        header: [
                            '<div class="header-title">Name</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return '<a href="/profile/' + data.id + '" class="list-group-item">' + data.name + '</a>';
                        }
                    }
                },
                {
                    source: engine2.ttAdapter(),
                    name: 'posts-caption',
                    display: function(data) {
                        return data.caption;
                    },
                    templates: {
                        empty: [
                            '<div class="header-title">Post</div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                        ],
                        header: [
                            '<div class="header-title">Post</div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return '<a href="/p/' + data.id + '" class="list-group-item">' + data.caption + '</a>';
                        }
                    }
                }
            ])
        });
    </script>
</body>
</html>
