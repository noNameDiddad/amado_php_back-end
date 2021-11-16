@extends('layouts.app')
@section('title') Вход @endsection
@section('content')
        <main class="form-center text-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1 class="h3 mb-3 fw-normal">Вход</h1>

                <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Пароль">
                    <label for="floatingPassword">Пароль</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" name="remember" value="true"> Запомнить
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Войти</button>
                <a href="{{ route('register') }}" class="mt-3">Зарегестрироваться</a>

                <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
            </form>
        </main>
    </div>

@endsection
