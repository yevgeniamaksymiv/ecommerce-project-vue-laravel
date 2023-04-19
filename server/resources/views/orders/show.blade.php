@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Order {{ $order->id }}
            <div class="d-inline-block ms-5">
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary shadow-none">Back</a>
            </div>
        </div>

        <div class="container mt-4">
            <table class="table table-striped mb-3">
                <thead>
                <th scope="col" width="20%">Details</th>
                <th scope="col" width="80%"></th>
                </thead>
                <tr>
                    <td>User</td>
                    <td>{{ $order->user?->fullName }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $order->delivery_address }}</td>
                </tr>
                <tr>
                    <td>Delivery</td>
                    <td>{{ $order->delivery?->name }}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{ $order->order_amount }} UAH</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $order->status }}</td>
                </tr>
            </table>
            <table class="table table-striped">
                <thead>
                <th scope="col" width="16%">Product ID</th>
                <th scope="col" width="16%">Name</th>
                <th scope="col" width="16%">Image</th>
                <th scope="col" width="16%">Price (UAH)</th>
                <th scope="col" width="16%">Count</th>
                <th scope="col" width="16%">Total price</th>
                </thead>

                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img
                                src="{{ $product->getImagePath }}"
                                style="width: 40px; height: auto;"
                                alt="mens clothes"
                            >
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->pivot->count }}</td>
                        <td>{{ $product->price * $product->pivot->count }} UAH</td>
                    </tr>
                @endforeach

            </table>
        </div>
@endsection
