<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Info</title>
</head>
<body>
    <div>Шановний {{ $userName }}</div>
    <div>Ваше замовлення формується</div>
    <div>Загальна сума до сплати: {{ $orderAmount }} UAH</div>
    <div>Дата створення замовлення: {{ $orderDate }}</div>
    <div>Адреса доставки: {{ $deliveryAddress }}</div>
    <div>Очікуйте інформацію про дату доставки від {{ $deliveryName }}</div>
</body>
</html>
