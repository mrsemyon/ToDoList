@extends('layouts.layout')

@section('content')
    <h1 class="mt-2 mb-3">Результаты поиска</h1>
    @if (isset($tasks) && count($tasks))
        <div class="row">
            @foreach ($tasks as $task)
            <div class="col-6 mb-4">
                <div class="card mt-4 mb-4">
                    <div class="card-header">
                        <span>{{ $task->title }}</span>
                        <span name="status" class="float-md-end">{{ $task->status }}</span>
                    </div>
                    <div class="card-body">
                        <p class="mt-3 mb-0">{{ $task->body }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="clearfix">
                                <span>
                                    Пользователь: {{ $task->author }}
                                    <br>
                                    Дата: {{ date_format($task->created_at, 'd.m.Y H:i') }}
                                </span>
                            @auth
                                @if (auth()->id() == $task->user_id || auth()->id() == 1)
                                    <form action="{{ route('destroy', ['id' => $task->id]) }}"
                                        method="post" onsubmit="return confirm('Удалить эту задачу?')" class="d-inline float-md-end ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger" value="Удалить">
                                    </form>
                                    <a href="{{ route('edit', ['id' => $task->id]) }}" class="col-md-3 float-md-end btn btn-info">Редактировать</a>
                                @else
                                    <span class="float-md-end">
                                        Редактировать и удалять можно только свою задачу
                                    </span>
                                @endif
                            @else
                                <span class="float-md-end">
                                    Только зарегистрированные пользователи могут редактировать и удалять задачи
                                </span>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-2">
            {{ $tasks->links() }}
            </div>
        </div>
    @else
        <p>По вашему запросу ничего не найдено</p>
    @endif
@endsection