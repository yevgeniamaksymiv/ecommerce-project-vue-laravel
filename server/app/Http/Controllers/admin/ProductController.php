<?php

namespace App\Http\Controllers\admin;

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
        $products = Product::all()->sortByDesc('created_at');
        $categories = Category::all()->where('parent_id', !null);
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
        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            $destination_path = 'public/images/products';
            $image = $request->file('img_path');
            $image_name = time()."_".$image->getClientOriginalName();
            $request->file('img_path')->storeAs($destination_path, $image_name);
            $data['img_path'] = $image_name;
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
        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            Storage::delete('public/images/products/'.$product->img_path);
            $destination_path = 'public/images/products';
            $image = $request->file('img_path');
            $image_name = time()."_".$image->getClientOriginalName();
            $request->file('img_path')->storeAs($destination_path, $image_name);
            $data['img_path'] = $image_name;
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
        Storage::delete('public/images/products/'.$product->img_path);
        $product->delete();

        session(['message' => 'Product deleted successfully']);
        return redirect()->route('products.index');
    }
}
