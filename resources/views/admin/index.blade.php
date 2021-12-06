@extends('layouts.app')
@section('title') Админпанель @endsection
@section('content')
    @include('includes.admin_btn')
    <section>
    @foreach ($unreadNotifications as $notification)
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32"
                     class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">Пользователь {{ $notification['username'] }}</h6>
                        <p class="mb-0 opacity-75">Приобрёл картину автора {{ $notification['painter'] }}</p>
                        <p class="mb-0 opacity-75">№ картины: {{ $notification['number'] }}</p>
                    </div>
                    <small class="opacity-50 text-nowrap">{{ $notification['created_at'] }}</small>
                    <form action="{{ route('readNotification') }}" method="post">
                        <input type="hidden" name="notification" value="{{ $notification['id'] }}">
                        @csrf
                        <button class="btn btn-outline-info">Прочитано</button>
                    </form>
                </div>
            </div>
        @endforeach
        @foreach ($withoutUnreadNotifications as $notification)
            <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32"
                     class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div class="opacity-25">
                        <h6 class="mb-0">Пользователь {{ $notification['username'] }}</h6>
                        <p class="mb-0 opacity-75">Приобрёл картину автора {{ $notification['painter'] }}</p>
                        <p class="mb-0 opacity-75">№ картины: {{ $notification['number'] }}</p>
                    </div>
                    <small class="opacity-50 text-nowrap">{{ $notification['created_at'] }}</small>
                    <form action="{{ route('deleteNotification') }}" method="post">
                        <input type="hidden" name="notification" value="{{ $notification['id'] }}">
                        @csrf
                        <button class="btn btn-outline-warning">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </section>


@endsection
