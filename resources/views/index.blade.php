@extends('layouts.layout')

@section('content')
    <h1 class="mt-2 mb-3">Задачи</h1>
    <div class="row">
        @foreach ($tasks as $task)
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <input disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ ($task->done)?'checked':'' }}>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $task->title }}
                        </label>       
                    </div>
                    <div class="card-body">{{ Str::limit($task->body, 140) }}</div>
                    <div class="card-footer">
                        <div class="clearfix">
                            <span>
                                Пользователь: {{ $task->author }}
                                <br>
                                Дата: {{ date_format($task->created_at, 'd.m.Y H:i') }}
                            </span>
                                <a href="{{ route('show', ['id' => $task->id]) }}" class="col-md-3 float-md-end btn btn-info float-right">Просмотреть</a>
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
@endsection