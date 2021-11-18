@extends('layouts.app')
@section('title') Главная @endsection
@section('sign_panel')
    @if (Route::has('login'))

    @endif
@endsection
@section('content')
    <main>

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Album example</h1>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$product->product}}</text>
                                </svg>

                                <div class="card-body">
                                    <p class="card-text">{{$product->description}}</p>
                                    <p class="card-text">{{$product->price}} руб.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Осмотреть
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-dark mt-5">
                        <a href="{{ route('production.index') }}" class="text-secondary text-decoration-none">
                            <h2>Перейти к продукции</h2>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </main>
@endsection
