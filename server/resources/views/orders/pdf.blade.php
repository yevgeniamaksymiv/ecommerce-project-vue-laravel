<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
</head>
<body>
<h2>Orders details {{ date('Y-m-d h:i:s') }}</h2>

@if(isset($startDate) && isset($endDate))
    <p>Search period from {{ $startDate }} to {{ substr($endDate, 0, 10) }}</p>
@endif

<table class="table table-striped">
    <tr>
        <th scope="col" width="15%">Order ID</th>
        <th scope="col" width="15%">Date</th>
        <th scope="col" width="15%">Amount (UAH)</th>
        <th scope="col" width="15%">User name</th>
        <th scope="col" width="15%">Delivery</th>
        <th scope="col" width="15%">status</th>
    </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->order_amount }}</td>
            <td>{{ $order->user?->fullName }}</td>
            <td>{{ $order->delivery?->name }}</td>
            <td>{{ $order->status }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
