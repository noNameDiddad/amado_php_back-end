@extends('layouts.app')
@section('title') Вход @endsection
@section('content')
    <main>
        <div class="container pt-5">
            <div class="row align-items-md-stretch ">
                <div class="col-md-6 product-show">
                    <div class="h-100 p-5 text-white bg-dark rounded-3">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="100%"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="45%" y="90%" fill="#eceeef" dy=".3em">{{$product->product}}</text>
                        </svg>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 p-5 bg-light border rounded-3">
                        <h1 class="card-text"><b>{{$product->product}}</b></h1>
                        <p class="card-text"><b>Category:</b> {{$product->category->category}}</p>
                        <p class="card-text text-decoration-underline">{{$product->price}} руб.</p>
                        <p class="card-text">{{$product->description}}</p>
                        <a href="{{ url()->previous() }}">
                            <button class="btn btn-outline-secondary" type="button">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
