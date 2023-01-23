@extends('layouts.layout')

@section('content')
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
                    <div class="card-footer">
                        <div class="clearfix">
                            <span class="float-left">
                                Пользователь: {{ $task->user_id }}
                                <br>
                                Дата: {{ date_format($task->created_at, 'd.m.Y H:i') }}
                            </span>
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