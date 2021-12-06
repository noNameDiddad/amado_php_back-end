<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\UserProduct;
use App\Notifications\PictureAdded;
use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;

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

        $categories = Category::cacheAll();
        if (isset($request->max_price) || isset($request->category)) {
            $products = $this->filter($request, $isDesc, $sort_by);
        } else {
            $products = Product::with('category')->orderBy('id', 'desc')->paginate(9);
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
        $products = Product::with('category')
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
        $categories = Category::cacheAll();
        return view('production.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
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
            $path = $file->store($upload_folder);
            $name = str_replace($upload_folder."/", '',$path);
            $product->image_path = $name;
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
        return view('production.show', compact('product'));
    }

    public function takeProduct(Request $request, $product_id)
    {
        $user_product = new UserProduct();

        $user_product->user_id = $request->user()->id;
        $user_product->product_id = $product_id;

        $user_product->save();
        $user = $request->user();
        $user->notify( new PictureAdded($user_product));

        return redirect()->back();
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
        $categories = Category::cacheAll();
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
        cache()->forget('product.main_page');
        if (App::environment(['development', 'local'])) {
            Log::info("Product was deleted id=" . $product->id);
            Log::info($product);
        }
        $file = $product->image_path;
        $product->delete();
        Storage::delete("public/images/".$file);

        return redirect()->back();
    }
}
