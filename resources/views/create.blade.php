@extends('layouts.layout')

@section('content')
    <h1 class="mt-2 mb-3">Добавить задачу</h1>
    <form method="post" action="{{ route('store') }}">
        @include('layouts.form')
    </form>
@endsection