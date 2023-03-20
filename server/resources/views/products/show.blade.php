@extends('layouts.sidebar')

@section('content')

    <div class="bg-white p-4 rounded">
        <div class="container text-center mt-4">
            <div class="card" style="width: 18rem;">
{{--                <img width="286" src="{{ asset('storage/images/products/'.$product->img_path) }}" class="card-img-top" alt="mens clothes">--}}
                <img width="286" src="{{ \Illuminate\Support\Facades\Storage::url('public/images/products/'.$product->img_path) }}" class="card-img-top" alt="mens clothes">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Price: {{ $product->price }} UAH</li>
                    <li class="list-group-item">Size: {{ $product->size }}</li>
                    <li class="list-group-item">Quantity: {{ $product->quantity }}</li>
                    <li class="list-group-item">Category: {{ $categories->where('id', $product->category_id)
                                    ->pluck('name')->implode('name') }}</li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
                </div>
            </div>
        </div>
    </div>

@endsection
