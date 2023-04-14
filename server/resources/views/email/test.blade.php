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
  <div>Order Info</div>
  <hr>
  <div>Order ID: {{ $order->id }}</div>
  <div>Order Amount: {{ $order->order_amount }} UAH</div>
  <div>Address: {{ $order->delivery_address }}</div>
{{--  <div>Delivery: {{ $order->delivery->name }}</div>--}}
  <div>Created at: {{ $order->created_at }}</div>
</body>
</html>
