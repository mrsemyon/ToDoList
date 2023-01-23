@extends('layouts.layout')

@section('content')
    <h1 class="mt-2 mb-3">Редактировать задачу</h1>
    <form method="post" action="{{ route('update', ['id' => $task->id]) }}">
        @method('PATCH')
        @include('layouts.form')
    </form>
@endsection