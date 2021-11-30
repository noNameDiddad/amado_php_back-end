<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $max_price = $request->max_price;
        $category_id = $request->category;
        $isDesc = $request->desc;
        $sort_by = 'id';
        if (isset($request->sort_by)) {
            $sort_by = $request->sort_by;
        }
        $categories = Category::all();
        if (isset($request->max_price) || isset($request->category)) {
            $products = $this->filter($request, $isDesc, $sort_by);
        } else {
            $products = Product::with('categories')->paginate(9);
        }
        return view('production.index', compact(
            'products',
            'categories',
            'max_price',
            'category_id',
            'sort_by',
            'isDesc',
        ));
    }

    public function filter($request, $isDesc, $sort_by)
    {
        $max_price = $request->max_price;
        $category = $request->category;
        $products = Product::with('categories')
            ->where('price', '<', $max_price)
            ->orderBy($sort_by, $isDesc);
        if ($category !== null) {
            $products = $products->where('category_id', $category);
        }
        return $products->paginate(9);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $categories = Category::all();
        return view('production.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create', Product::class);
        cache()->forget('product.index.without-filter');
        cache()->forget('product.main_pag');

        $product = new Product();

        $product->product = $request->product;
        $product->description = $request->description;
        $product->number = $request->number;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if ($file = $request->file('image')) {
            $upload_folder = 'public/images';
            $filename = $file->getClientOriginalName();

            if (Storage::exists("public/images/" . $filename)) {
                Storage::putFileAs($upload_folder, $file, $filename);
            }

            $product->image_path = $filename;
        }
        if (App::environment(['development', 'local'])) {
            Log::info("Product was created id=" . $product->id);
            Log::info($product);
        }
        $product->save();
        return redirect()->route('product.index');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
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
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $categories = Category::all();
        return view('production.edit', ['categories' => $categories, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        cache()->forget('product.index.without-filter');
        cache()->forget('product.main_pag');

        $product->product = $request->product;
        $product->description = $request->description;
        $product->number = $request->number;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if ($file = $request->file('image')) {
            $upload_folder = 'public/images';
            $filename = $file->getClientOriginalName();

            Storage::putFileAs($upload_folder, $file, $filename);

            $product->image_path = $filename;
        }
        if (App::environment(['development', 'local'])) {
            Log::info("Product was updated id=" . $product->id);
            Log::info($product);
        }
        $product->update();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        cache()->forget('product.index.without-filter');
        cache()->forget('product.main_pag');
        if (App::environment(['development', 'local'])) {
            Log::info("Product was deleted id=" . $product->id);
            Log::info($product);
        }
        $product->delete();

        return redirect()->back();
    }
}
