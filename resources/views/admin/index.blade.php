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

    <section>
        @foreach ($users as $user)
            @foreach ($user->unreadNotifications as $notification)
                <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                    <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0">Пользователь {{ $notification->data['user']['name'] }}</h6>
                            <p class="mb-0 opacity-75">Приобрёл картину автора {{ $notification->data['painter'] }}</p>
                            <p class="mb-0 opacity-75">№ картины: {{ $notification->data['number'] }}</p>
                        </div>
                        <small class="opacity-50 text-nowrap">{{ $notification->created_at }}</small>
                        <form action="{{ route('readNotification') }}" method="post">
                            <input type="hidden" name="notification" value="{{ $notification->id }}">
                            @csrf
                            <button class="btn btn-outline-info">Прочитано</button>
                        </form>
                    </div>
                </a>
            @endforeach
        @endforeach
    </section>


@endsection
