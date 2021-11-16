@extends('layouts.app')
@section('title') Кабина @endsection
@section('content')
    <p>{{\Illuminate\Support\Facades\Auth::user()}}</p>

    <a href="{{ route('logout') }}">Выход</a>
    <a href="{{ route('main') }}">На главную</a>
@endsection
