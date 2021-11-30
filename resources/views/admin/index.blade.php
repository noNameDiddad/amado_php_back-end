@extends('layouts.app')
@section('title') Админпанель @endsection
@section('content')
    <section class="py-5 text-center container">
        <div class="mx-auto">
            <a href="{{route('admin.user')}}"><button class="btn btn-sm btn-outline-primary">Пользователи</button></a>
            <a href="{{route('admin.category')}}"><button class="btn btn-sm btn-outline-primary">Категории</button></a>
            <a href="{{route('admin.product')}}"><button class="btn btn-sm btn-outline-primary">Товары</button></a>
        </div>
    </section>
@endsection
