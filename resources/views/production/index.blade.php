@extends('layouts.app')
@section('title') Продукция @endsection
@section('sign_panel')
@endsection
@section('content')
    
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Productions</h1>
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
                @if($products->lastPage() > 1)
                    @if($products->currentPage()> 1)
                        <a href="{{ $products->links()->elements[0][$products->currentPage()-1] }}">Previous</a>
                    @endif
                    @for($i = 1; $i<$products->lastPage(); $i++)
                        <a href="{{$products->links()->elements[0][$i]}}">{{ $i }}</a>
                    @endfor
                    @if($products->currentPage()< $products->lastPage())
                        <a href="{{ $products->links()->elements[0][$products->currentPage()+1] }}">Next</a>
                    @endif

                @endif
            </div>
        </div>
    </main>
@endsection
