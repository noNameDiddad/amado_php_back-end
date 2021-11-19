@extends('layouts.app')
@section('title') Production @endsection
@section('content')
    {{--    \Illuminate\Support\Facades\Auth::user()->role--}}
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Productions</h1>
                </div>
            </div>
            <div>
                {{--start filter--}}
                <div class="mx-auto">
                    <h2 class="fw-light">Filter</h2>
                    <form action="{{ route('set-filter') }}" method="post">
                        @csrf
                        <div class="row py-5">
                            <div class="col-4">
                                <select name="category">
                                    @if(isset($category_id))
                                        <option value="">Select category:</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if($category_id == $category->id) selected @endif>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="" selected>Select category:</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-4">
                                @if(isset($max_price))
                                    <label class="d-block min-price">Max price</label>
                                    <input class="d-block m-auto" name="max_price" type="range" min="0" max="1000000"
                                           step="10" value="{{$max_price}}"
                                           oninput="this.nextElementSibling.value = this.value">
                                    <output class="d-inline min-price" id="max-price-val">{{$max_price}}</output>
                                    <p class="d-inline"> руб.</p>
                                @else
                                    <label class="d-block min-price">Max price</label>
                                    <input class="d-block m-auto" name="max_price" type="range" min="0" max="1000000"
                                           step="10" value="1000000"
                                           oninput="this.nextElementSibling.value = this.value">
                                    <output class="d-inline min-price" id="max-price-val">1000000</output>
                                    <p class="d-inline"> руб.</p>
                                @endif

                            </div>
                            <div class="col-4"></div>

                        </div>
                        <button class="btn btn-sm btn-outline-secondary">Set filter</button>
                    </form>

                    <a href="{{ route('product.index') }}">
                        <button class="btn btn-sm btn-outline-secondary mt-3">Drop filter</button>
                    </a>

                </div>
                {{--end filter--}}
            </div>
        </section>
        <section class="py-2 text-center bg-light">
            <a href="{{ route('product.create') }}">
                <button class="btn btn-outline-dark mt-5 w-25">Add product</button>
            </a>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    {{--start productions--}}
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
                                        <div class="btn-group row">
                                            <div class="col-4">
                                                <a href="{{ route('product.show', $product) }}">
                                                    <button class="btn btn-outline-secondary ">More</button>
                                                </a>
                                            </div>

                                            @if(\Illuminate\Support\Facades\Auth::user()->role == '1')
                                                <div class="col-4">
                                                    <a href="{{ route('product.edit', $product) }}">
                                                        <button class="btn btn-outline-info ">Edit</button>
                                                    </a>
                                                </div>

                                                <div class="col-4">
                                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger">Delete</button>
                                                    </form>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{--end productions--}}
                </div>
                {{--start pagination--}}
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
                {{--end pagination--}}
            </div>
        </div>
    </main>
@endsection
