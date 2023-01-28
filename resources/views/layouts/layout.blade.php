<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'ToDoList' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-info bg-opacity-25">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">ToDoList</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create') }}">Создать задачу</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('active') }}">Активные</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('completed') }}">Завершенные</a>
                    </li>
                </ul>
                <form class="d-flex" action="{{ route('search') }}">
                    <input class="form-control me-2" type="search" aria-label="Search">
                    <button class="btn btn-outline-info text-dark" type="submit">Найти</button>
                    @csrf
                </form>
                <ul class="d-flex navbar-nav">
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
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} <!-- ссылка выхода -->
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible m-4" role="alert">
            {{ $message }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible m-4" role="alert">
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>