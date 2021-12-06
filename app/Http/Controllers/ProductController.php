<?php

namespace App\Http\Controllers;

use App\Cache\Cache;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\UserProduct;
use App\Notifications\PictureAdded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request, Cache $cache)
    {
        $categories = $cache->cacheCategoryAll();
        $max_price = $request->max_price;
        $category_id = $request->category;
        $isDesc = $request->desc;
        $sort_by = 'id';
        if (isset($request->sort_by)) {
            $sort_by = $request->sort_by;
        }

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cache $cache)
    {
        $this->authorize('create', Product::class);
        $categories = $cache->cacheCategoryAll();
        return view('production.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Cache $cache)
    {
        $cache->cacheForgetAll();
        $request = $this->setFile($request);
        $product = Product::create($request->all());
        $this->logging("created", $product);

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, Cache $cache)
    {
        $this->authorize('update', $product);
        $categories = $cache->cacheCategoryAll();
        return view('production.edit', compact(['categories', 'product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product,  Cache $cache)
    {
        $this->authorize('update', $product);
        $cache->cacheForgetAll();
        $request = $this->setFile($request);
        $this->deleteFile($product->image_path);
        $product = Product::update($request->all());
        $this->logging("updated", $product);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Cache $cache)
    {
        $this->authorize('delete', $product);
        $cache->cacheForgetAll();
        $this->logging("deleted", $product);
        $this->deleteFile($product->image_path);
        $product->delete();

        return redirect()->back();
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

    public function takeProduct(Request $request, $product_id)
    {
        $user_product = new UserProduct();

        $user_product->user_id = $request->user()->id;
        $user_product->product_id = $product_id;

        $user_product->save();
        $user = $request->user();

        $product = Product::where('id', $user_product->product_id)->first();
        $user->notify(new PictureAdded($user, $product));

        return redirect()->back();
    }

    public function setFile(ProductRequest $request)
    {
        if ($file = $request->file('image')) {
            $upload_folder = 'public/images';
            $path = $file->store($upload_folder);
            $name = str_replace($upload_folder . "/", '', $path);
            $request->merge(['image_path' => $name]);
        }
        return $request;
    }

    public function deleteFile($file)
    {
        Storage::delete("public/images/" . $file);
    }

    public function logging($action, $product)
    {
        if (App::environment(['development', 'local'])) {
            Log::info("Product was ".$action." id=" . $product->id);
            Log::info($product);
        }
    }


}
