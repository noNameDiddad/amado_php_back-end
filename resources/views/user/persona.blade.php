@extends('layouts.app')
@section('title') Кабина @endsection
@section('content')
    <main class="container">
        <p>{{\Illuminate\Support\Facades\Auth::user()}}</p>

        <a href="{{ route('logout') }}">Logout</a>
        <a href="{{ route('main') }}">To main</a>
    </main>

@endsection
