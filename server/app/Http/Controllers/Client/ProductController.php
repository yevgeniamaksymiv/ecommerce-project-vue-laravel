<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductFilter $filter)
    {
        $products = Product::filter($filter)->paginate(20);

        return ProductsResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getColorsSizes()
    {
        $colors = Product::query()->distinct()->pluck('color')->toArray();
        $sizes = Product::query()->distinct()->pluck('size')->toArray();
        $data = ['colors'=> $colors, 'sizes' => $sizes];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
