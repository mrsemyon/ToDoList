@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mt-4 mb-4">
                <div class="card-header">
                    <input disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ ($task->done)?'checked':'' }}>
                    <label class="form-check-label" for="flexCheckDefault">
                        {{ $task->title }}
                    </label>       
                </div>
                <div class="card-body">
                    <p class="mt-3 mb-0">{{ $task->body }}</p>
                </div>
                <div class="card-footer">
                    <div class="clearfix">
                        <span>
                            Пользователь: {{ $task->user_id }}
                            <br>
                            Дата: {{ date_format($task->created_at, 'd.m.Y H:i') }}
                        </span>
                            <a href="{{ route('edit', ['id' => $task->id]) }}" class="col-md-3 float-md-end btn btn-info float-right">Редактировать</a>      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection