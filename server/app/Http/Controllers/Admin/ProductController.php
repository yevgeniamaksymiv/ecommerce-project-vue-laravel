<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $products = Product::all()->sortByDesc('created_at');
        $products = Product::query()->orderBy('created_at', 'desc')->get();
        $categories = Category::query()->where('parent_id', !null)->get();
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->where('parent_id', !null);
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->except('_token');

        if ($request->hasFile('img_path')) {
            $destination_path = 'images/products/';
            $image = $request->file('img_path');
            $image_name = time()."_".$image->getClientOriginalName();
            $request->file('img_path')->storeAs($destination_path, $image_name, 'public');
            $data['img_path'] = $destination_path.$image_name;
        }
        Product::create($data);

        session(['message' => 'Product created successfully']);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $categories = Category::all()->where('parent_id', !null);
        return view('products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->where('parent_id', !null);
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->except('_token');

        if ($request->hasFile('img_path')) {

            if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
                Storage::disk('public')->delete($product->img_path);
            }

            $destination_path = 'images/products/';
            $image = $request->file('img_path');
            $image_name = time()."_".$image->getClientOriginalName();
            $request->file('img_path')->storeAs($destination_path , $image_name, 'public');
            $data['img_path'] = $destination_path.$image_name;
        }
        $product->update($data);

        session(['message' => 'Product updated successfully']);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
            Storage::disk('public')->delete($product->img_path);
        }

        $product->delete();

        session(['message' => 'Product deleted successfully']);
        return redirect()->route('products.index');
    }
}
