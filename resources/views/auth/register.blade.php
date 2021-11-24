@extends('layouts.app')
@section('title') Регистрация @endsection
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
        <form action="{{ route('register') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Sign Up</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="name" id="floatingInput" placeholder="Игорь">
                <label for="floatingInput">Name</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Пароль">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password_confirm" id="floatingPassword" placeholder="Подтверждение пароля">
                <label for="floatingPassword">Confirm Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-dark mb-3" type="submit">Sign Up</button>
            <a href="{{ route('login') }}" class="mt-3 text-dark">Sign In</a>
            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>
    </main>
@endsection
