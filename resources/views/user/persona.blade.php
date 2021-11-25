@extends('layouts.app')
@section('title') Кабина @endsection
@section('content')
    <main class="container pb-5 mb-5">
        <h1>{{Auth::user()->name}}</h1>
        <h2>{{Auth::user()->email}}</h2>
        <p><b>role:</b>
        @if(Auth::user()->role == 0)
            user</p>
        @else
            admin</p>
            <a href="/admin?table=user">
                <button class="btn btn-outline-danger">To AdminPanel</button>
            </a>
        @endif
        <div class="album py-5">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($purchases as $purchase)
                        <div class="col">
                            <div class="card shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                     xmlns="http://www.w3.org/2000/svg" role="img"
                                     aria-label="Placeholder: Thumbnail"
                                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>
                                        Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text x="50%" y="50%" fill="#eceeef"
                                          dy=".3em">{{$purchase->products->product}}</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">{{mb_strimwidth($purchase->products->description,0,150, '...')}}</p>
                                    <p class="card-text">
                                        <b>Category:</b> {{$purchase->products->categories->category}}
                                    </p>
                                    <p class="card-text text-decoration-underline">{{$purchase->products->price}}
                                        руб.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group row">
                                            <div class="col-4">
                                                <a href="{{ route('product.show', $purchase) }}">
                                                    <button class="btn btn-outline-secondary ">More</button>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <form action="{{ route('product.destroy', $purchase) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection



{{--$product->categories->category--}}
