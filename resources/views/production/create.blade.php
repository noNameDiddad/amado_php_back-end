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
        <form action="{{ route('product.store') }}" method="post">
            @csrf
            <h1 class="h3 mb-3 fw-normal">Addition</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name="product" id="floatingInput" placeholder="Product">
                <label for="floatingInput">Product</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="description" id="floatingInput" placeholder="Description">
                <label for="floatingInput">Description</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="number" id="floatingInput" placeholder="Number">
                <label for="floatingInput">Number</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="price" id="floatingInput" placeholder="Price">
                <label for="floatingInput">Price</label>
            </div>

            <div class="form-floating">
                <select name="category" class="form-control" id="floatingInput" placeholder="Category">
                    <option value="" disabled selected>Select category:</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <label for="floatingInput">Category</label>
            </div>

            <button class="w-100 btn btn-lg btn-outline-dark mt-3" type="submit">Add</button>
            <button class="w-100 btn btn-lg btn-outline-dark mt-3" type="submit">Add and go to Production</button>
        </form>
    </main>
    </div>

@endsection
