@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="lead">
            All orders
        </div>

        <div class="container mt-4">

            <table class="table table-striped">
                <thead>
                <th scope="col" width="20%">Date</th>
                <th scope="col" width="20%">Address</th>
                <th scope="col" width="20%">Amount (UAH)</th>
                <th scope="col" width="20%">User name</th>
                <th scope="col" width="20%">Delivery</th>

                </thead>

                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->delivery_address }}</td>
                        <td>{{ $order->order_amount }}</td>
                        <td>{{ $order->user->fullName }}</td>
                        <td>{{ $order->delivery->name }}</td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
@endsection

