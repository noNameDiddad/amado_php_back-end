@extends('layouts.app')
@section('title') Production @endsection
@section('content')
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Productions</h1>
                </div>
            </div>
            <div>
                <div class="mx-auto">
                    <h2 class="fw-light">Filter</h2>
                    <form action="{{ route('set-filter') }}" method="post">
                        @csrf
                        <div class="row py-5">
                            <div class="col-4">
                                <select name="category">
                                    <option value="" disabled selected>Select category:</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="d-block min-price">Max price</label>
                                <label class="d-block min-price" id="max-price">1000000 руб.</label>
                                <input class="d-block m-auto" name="max_price" type="range" min="0" max="1000000" step="10" value="1000000">
                            </div>
                            <div class="col-4"></div>

                        </div>
                        <button class="btn btn-sm btn-outline-secondary">Set filter</button>
                    </form>

                    <a href="{{ route('production.index') }}">
                        <button class="btn btn-sm btn-outline-secondary mt-3">Drop filter</button>
                    </a>

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
                                    <p class="card-text"><b>Category:</b> {{$product->categories->category}}</p>
                                    <p class="card-text text-decoration-underline">{{$product->price}} руб.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">More
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination_upper text-center">
                    <div class="pagination mt-5 m-auto">
                        @if($products->lastPage() > 1)
                            @if($products->currentPage()> 1)
                                <a href="http://127.0.0.1:8000/production?page={{$products->currentPage()-1}}">
                                    <button class="btn btn-outline-primary me-3">Previous</button>
                                </a>
                            @endif

                            @foreach($products->links()->elements as $element)
                                @if($element == "...")
                                    <a href="">
                                        <button class="btn btn-outline-info">...</button>
                                    </a>
                                @else
                                    @foreach($element as $key => $page)
                                        <a href="{{$page}}">
                                            <button class="btn btn-outline-info">{{ $key }}</button>
                                        </a>
                                    @endforeach
                                @endif
                            @endforeach
                            @if($products->currentPage()< $products->lastPage())
                                <a href="http://127.0.0.1:8000/production?page={{$products->currentPage()+1}}">
                                    <button class="btn btn-outline-primary ms-3">Next</button>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
