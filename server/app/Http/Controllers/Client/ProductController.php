<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilter;
use App\Http\Requests\FilterProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $categoriesIds = Category::query()->where('parent_id', 1)->pluck('id')->toArray();
//        $products = Product::query()->whereIn('category_id', $categoriesIds)->paginate(20);
//        dd($products);
        $products = Product::paginate(20);

        return ProductsResource::collection($products);
    }

    public function latest()
    {
        $products = Product::latest()->paginate(20);
        return ProductsResource::collection($products);
    }


    public function filter(FilterProductRequest $request)
    {
        $filters = $request->get('filters');
        $sorters = $request->get('sorters');

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($filters)]);

        $query = Product::filter($filter);
        if (isset($sorters['field'])) {
            $query->orderBy($sorters['field'], $sorters['direction']);
        }
        $products = $query->paginate(20);
        return ProductsResource::collection($products);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function getColorsSizes()
    {
        $colors = Product::query()->distinct()
            ->orderBy('color', 'asc')->pluck('color')->toArray();
        $sizes = Product::query()->distinct()
            ->orderBy('size', 'asc')->pluck('size')->toArray();
        $data = ['colors'=> $colors, 'sizes' => $sizes];
        return response()->json($data, 200);
    }

    public function search(Request $request)
    {
        $searchValue = $request->get('inputSearch');
        $products = Product::query()
            ->where('name', 'LIKE', "%{$searchValue}%")
            ->get();

        return ProductsResource::collection($products);
    }


    public function show(Product $product)
    {
        return new ProductResource($product);
    }

}
