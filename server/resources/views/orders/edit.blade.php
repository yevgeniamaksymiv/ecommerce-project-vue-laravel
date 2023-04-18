@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4 rounded">
        <div class="lead">
            Edit order status
        </div>

        <div class="container mt-4">
            <form method="POST" action="{{ route('orders.update', $order->id) }}">
                @method('PUT')
                @csrf
                @foreach($statuses as $status)
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="status" id="{{$status}}"
                               value="{{ $status }}">
                        <label class="form-check-label" for="{{$status}}">
                            {{ $status }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-outline-primary shadow-none">Update order</button>

            </form>
        </div>

    </div>

@endsection
