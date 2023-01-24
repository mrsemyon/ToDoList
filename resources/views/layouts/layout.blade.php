<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDoList</title>
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
                        <a class="nav-link" href="/">Задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('create') }}">Создать задачу</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item">
                        <span class="m-2">Логин</span>
                    </li>
                </ul>
                <form class="row g-2" action="{{ route('search') }}" method="POST">
                    <div class="col-auto">
                        <input class="col-auto form-control mr-sm-2" type="search" name="search" placeholder="Найти задачу..." aria-label="Поиск">
                    </div>
                    <div class="col-auto">
                        <button class="col-auto btn btn-outline-dark my-2 my-sm-0" type="submit">Поиск</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>