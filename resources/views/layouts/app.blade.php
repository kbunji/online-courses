<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header>
        <div class="container-xl">
            <div class="row header__row">
                <div class="col-md-3">
                    <img src="/media/logo.jpeg" alt="" width="104" height="54">
                </div>
                <div class="col-md-9">
                    <div class="nav right">
                        <form class="search" action="{{ route('course.search') }}">
                            <input type="text" class="search__text" name="search_text" placeholder="Введите текст..."
                                   required>
                            <button type="submit" class="search__btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <div class="nav--auth">
                            @if (Auth::guest())
                                <a href="{{ route('login') }}"><i class="far fa-user-circle"></i> Войти</a>
                            @else
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="nav menu">
                        <a class="nav__item" href=""><span>Категории</span></a>
                        <a class="nav__item" href=""><span>Олимпиады</span></a>
                        <a class="nav__item" href=""><span>Конференции</span></a>
                        <a class="nav__item" href=""><span>Лицензия</span></a>
                        <a class="nav__item" href=""><span>Контакты</span></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
