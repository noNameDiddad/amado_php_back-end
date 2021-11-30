@extends('layouts.app')
@section('title') Main @endsection
@section('content')
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">ArtTradition</h1>
                </div>
            </div>
        </section>
        <section class="text-center container">
            <div class="row">
                <div class="col-6 mx-auto pb-5">
                    <h2>What's new?</h2>
                </div>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card shadow-sm">
                                @if($product->image_path != "")
                                    <img class="card-img-top product_image"
                                         src="{{ asset('storage/images/'.$product->image_path) }}" height="225" alt="">
                                @else
                                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                         xmlns="http://www.w3.org/2000/svg" role="img"
                                         aria-label="Placeholder: Thumbnail"
                                         preserveAspectRatio="xMidYMid slice" focusable="false"><title>
                                            Placeholder</title>
                                        <rect width="100%" height="100%" fill="#55595c"></rect>
                                    </svg>
                                @endif
                                <div class="card-body">
                                    <h2 class="card-text">{{$product->product}}</h2>
                                    <p class="card-text">{{mb_strimwidth($product->description,0,150, '...')}}</p>
                                    <p class="card-text"><b>Category:</b> {{$product->categories->category}}</p>
                                    <p class="card-text text-decoration-underline">{{$product->price}}$</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group row">
                                            <div class="col-4">
                                                <a href="{{ route('product.show', $product) }}">
                                                    <button class="btn btn-outline-secondary ">More</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('product.index') }}">
                        <button type="button" class="btn btn-outline-secondary mt-5">
                            <h2>To productions</h2>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
