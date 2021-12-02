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
            <h1 class="h3 mb-3 fw-normal">Sign In</h1>
            @if(session()->get('message'))
                <p>{{ session()->get('message') }}</p>
            @endif
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="floatingPassword"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" value="true"> Remember
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-dark mb-3" type="submit">Sign In</button>
            <a href="{{ route('register') }}" class="mt-3 text-dark">Sign Up</a>

            <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
        </form>
    </main>


@endsection
