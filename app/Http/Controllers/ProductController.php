<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if (isset($request->max_price)  || isset($request->category)) {

            $max_price =  $request->max_price;
            $category =  $request->category;

            if ($category == null)
            {
                $products = Product::with('categories')
                    ->where('price','<', $max_price)
                    ->orderBy('id','desc')
                    ->paginate(6);
            }
            else
            {
                $products = Product::with('categories')
                    ->where('category_id', $category)
                    ->where('price','<', $max_price)
                    ->orderBy('id','desc')
                    ->paginate(6);
            }
            return view('production.index', [
                'products' => $products,
                'categories' => $categories,
                'max_price' => $max_price,
                'category_id' => $category,
                ]);
        }
        else {
            $products = Product::with('categories')->orderBy('id','desc')->paginate(6);
        }

        return view('production.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('production.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
//        if ($redirect) {
            $product = Product::create($request->all());
            $product->save();
            return redirect()->route('product.index');
//        }else{
//            $product = Product::create($request->all());
//            $product->save();
//            return redirect()->back();
//        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all();
        return view('production.show', ['categories' => $categories, 'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('production.edit', ['categories' => $categories, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}
