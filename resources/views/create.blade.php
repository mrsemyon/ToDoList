@extends('layouts.layout')

@section('content')
    <h1 class="mt-2 mb-3">Добавить задачу</h1>
    <form method="post" action="{{ route('store') }}">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Заголовок" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" placeholder="Текст задачи" rows="7" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
@endsection