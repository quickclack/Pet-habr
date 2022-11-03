<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GB-Habr-Admin</title>

    @vite(['resources/assets/admin/css/bootstrap.min.css', 'resources/assets/admin/css/dashboard.css'])
</head>
<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/">На сайт</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="{{-- route('logout') --}}">Выйти</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.index')) active @endif"
                               aria-current="page" href="{{ route('admin.index') }}">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Главная
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.category.*')) active @endif"
                               href="{{ route('admin.category.index') }}">
                                <span data-feather="file" class="align-text-bottom"></span>
                                Категории
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.articles.*')) active @endif"
                               href="{{-- route('admin.articles.index') --}}">
                                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                                Статьи
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->routeIs('admin.users.*')) active @endif"
                               href="{{-- route('admin.users.index') --}}">
                                <span data-feather="users" class="align-text-bottom"></span>
                                Пользователи
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('title')

                <div class="container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($message = flash()->get())
                        <div class="{{ $message->class() }}">
                            {{ $message->message() }}
                        </div>
                    @endif
                </div>
