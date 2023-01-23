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
            <a class="navbar-brand" href="#">ToDoList</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        Таски
                    </li>
                </ul>
                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item">
                        Логин
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container mt-4">
    <div class="row">
        @foreach ($tasks as $task)
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ ($task->done)?'checked':'' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $task->title }}
                        </label>       
                    </div>
                    <div class="card-body">{{ $task->body }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>