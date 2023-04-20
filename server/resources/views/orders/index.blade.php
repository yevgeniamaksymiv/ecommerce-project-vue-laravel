@extends('layouts.sidebar')

@section('content')
    <div class="bg-white p-4">
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
            @if(isset($startDate) && isset($endDate) && isset($ordersCount))
                <small class="bg-light p-2">
                    from {{ $startDate }} to {{ $endDate }}, number of orders: {{ $ordersCount }}
                </small>

                <a
                    class="btn btn-success ms-3 shadow-none d-inline-block float-end"
                    href="{{ route('orders.export', ['startDate' => $startDate, 'endDate' => $endDate]) }}"
                >
                    Excel
                    <img width="20" height="20" src="{{ asset('assets/download.svg') }}"
                         alt="download svg">
                </a>
                <a
                    class="btn btn-success ms-2 shadow-none d-inline-block float-end"
                    href="{{ route('orders.generate_pdf', ['startDate' => $startDate, 'endDate' => $endDate]) }}"
                >
                    PDF
                    <img width="20" height="20" src="{{ asset('assets/download.svg') }}"
                         alt="download svg">
                </a>
            @else
                <a
                    class="btn btn-success ms-3 shadow-none d-inline-block float-end"
                    href="{{ route('orders.export') }}"
                >
                    Excel
                    <img width="20" height="20" src="{{ asset('assets/download.svg') }}"
                         alt="download svg">
                </a>
                <a
                    class="btn btn-success ms-2 shadow-none d-inline-block float-end"
                    href="{{ route('orders.generate_pdf') }}"
                >
                    PDF
                    <img width="20" height="20" src="{{ asset('assets/download.svg') }}"
                         alt="download svg">
                </a>
            @endif
        </div>

        <div class="container mt-4">
            <form method="POST" action="{{ route('orders.in_period') }}">
                @csrf
                <div class="input-group mb-3 d-flex justify-content-evenly align-items-center">
                    <label for="startDate">From</label>
                    <input
                        id="startDate"
                        name="startDate"
                        class="form-control shadow-none"
                        type="date"
                        style="flex: 0 1 200px"
                    />

                    <label for="endDate">To</label>
                    <input
                        id="endDate"
                        name="endDate"
                        class="form-control shadow-none"
                        type="date"
                        style="flex: 0 1 200px"
                    />

                    <button id="button" type="submit" class="btn btn-primary shadow-none">Show orders</button>
                    <a class="btn btn-outline-success shadow-none" href="{{ route('orders.index') }}">
                        Clear filter
                    </a>
                </div>
            </form>

            <table class="table table-striped">
                <thead>
                <th scope="col" width="10%">Order ID</th>
                <th scope="col" width="15%">Date</th>
                <th scope="col" width="15%">Amount (UAH)</th>
                <th scope="col" width="15%">User name</th>
                <th scope="col" width="15%">Delivery</th>
                <th scope="col" width="25%">Status</th>
                <th scope="col" width="1%">
                <th scope="col" width="1%">

                </thead>

                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->order_amount }}</td>
                        <td>{{ $order->user?->fullName }}</td>
                        <td>{{ $order->delivery?->name }}</td>
                        <td>
                            @can('update', $order)
                                <a href="{{ route('orders.edit', $order->id) }}"
                                   class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">
                                </a>
                            @endcan
                                {{ $order->status }}
                        </td>
                        <td>
                            @can('view', $order)
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="btn btn-default shadow-none">
                                    <img width="20" height="20" src="{{ asset('assets/info.svg') }}" alt="info svg">
                                </a>
                            @endcan
                        </td>
{{--                        <td>--}}
{{--                            @can('update', $order)--}}
{{--                                <a href="{{ route('orders.edit', $order->id) }}"--}}
{{--                                   class="btn btn-default shadow-none">--}}
{{--                                    <img width="20" height="20" src="{{ asset('assets/edit.svg') }}" alt="edit svg">--}}
{{--                                </a>--}}
{{--                            @endcan--}}
{{--                        </td>--}}
                        <td>
                            @can('delete', $order)
                                <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-default shadow-none">
                                        <img width="20" height="20" src="{{ asset('assets/delete.svg') }}"
                                             alt="delete svg">
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </table>

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        const dateInputs = document.querySelectorAll('input');
        const currentDate = new Date().toLocaleDateString();
        const pattern = "\d{4}-(0[1-9]|1[0-2])-([012]\d|3[01])";

        dateInputs.forEach(el => {
            el.max = currentDate.split('.').reverse().join('-');
            el.pattern = pattern;
        });
    </script>
@endpush

