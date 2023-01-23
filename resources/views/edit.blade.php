@extends('layouts.layout')

@section('content')
    <h1 class="mt-2 mb-3">Редактировать задачу</h1>
    <form method="post" action="{{ route('update', ['id' => $task->id]) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Заголовок" required value="{{ $task->title }}">
        </div>
        <div class="form-group">
            <textarea name="body" class="form-control" placeholder="Текст поста" rows="7" required>{{ $task->body }}</textarea>
        </div>
        <div class="form-group">
            <input name="done" class="form-check-input" type="checkbox" value="success" id="flexCheckDefault" {{ ($task->done)?'checked':'' }}>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection