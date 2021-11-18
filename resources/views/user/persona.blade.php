@extends('layouts.app')
@section('title') Кабина @endsection
@section('content')
    <p>{{\Illuminate\Support\Facades\Auth::user()}}</p>

    <a href="{{ route('logout') }}">Logout</a>
    <a href="{{ route('main') }}">To main</a>
@endsection
