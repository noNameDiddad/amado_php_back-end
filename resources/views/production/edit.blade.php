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
        <form action="{{ route('product.update',$product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <h1 class="h3 mb-3 fw-normal">Addition</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="product" id="floatingInput" value="{{ $product->product }}">
                <label for="floatingInput">Product</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="description" id="floatingInput" value="{{ $product->description }}">
                <label for="floatingInput">Description</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="number" id="floatingInput" value="{{ $product->number }}">
                <label for="floatingInput">Number</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="price" id="floatingInput" value="{{ $product->price }}">
                <label for="floatingInput">Price</label>
            </div>

            <div class="form-floating">
                <input type="file" class="form-control" name="image" id="floatingInput">
                <label for="floatingInput">Price</label>
            </div>

            <div class="form-floating">
                <select name="category_id" class="form-control" id="floatingInput" >
                    <option value="">Select category:</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if($product->category_id == $category->id) selected @endif>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
                <label for="floatingInput">Category</label>
            </div>

            <button class="w-100 btn btn-lg btn-outline-dark mt-3 mb-3" type="submit">Update</button>
        </form>
            <a href="{{ url()->previous() }}">
                <button class="w-100 btn btn-outline-secondary" type="button">Back</button>
            </a>
    </main>

@endsection
