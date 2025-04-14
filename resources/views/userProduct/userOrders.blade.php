<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
</head>
<body>
<div class="container">
    <h1>Мои заказы</h1>

    <div class="customer-info">
        <h2>Данные покупателя</h2>
        <p><strong>Email:</strong>{{ $user->email }}</p>
{{--        <p><strong>Телефон:</strong>@if(isset($user)) {{ $user->phone }} @endif</p>--}}
{{--        <p><strong>Имя:</strong> @if(isset($user)) {{ $user->name }} @endif</p>--}}
{{--        <p><strong>Адрес:</strong> @if(isset($user)) {{ $user->address }} @endif</p>--}}
{{--        <p><strong>Город:</strong> @if(isset($user)) {{ $user->city }} @endif</p>--}}
{{--        <p><strong>Страна:</strong> @if(isset($user)) {{ $user->country }} @endif</p>--}}
{{--        <p><strong>Почтовый индекс:</strong> @if(isset($user)) {{ $user->postcode }} @endif</p>--}}
    </div>

    <div class="order-items">
        <h2>Заказанные продукты</h2>
        <table>
            <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
            </tr>
            </thead>
            @if(isset($userOrders))
                 @foreach($userOrders as $userOrder)
            <tbody>
            <tr>
                <td><img src="{{ $userOrder->product->image }}" alt="Продукт 1"></td>
                <td>{{ $userOrder->product->name }}</td>
                <td>{{ $userOrder->product->price }}</td>
                <td>{{ $userOrder->amount }}</td>
            </tr>
            </tbody>
                @endforeach
            @endif
        </table>
        <div class="total-price">
{{--            <h3>Общая цена: <?php--}}
{{--                            $totalPrice = 0;--}}
{{--                            foreach ($newOrderProducts as $newOrderProduct) {--}}
{{--                                $totalPrice += $newOrderProduct->getProduct()->getPrice() * $newOrderProduct->getQuantity();--}}
{{--                            }--}}
{{--                            echo "$" . $totalPrice;--}}
{{--                            ?></h3>--}}
        </div>
    </div>
</div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .customer-info {
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .order-items table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-items th, .order-items td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .order-items th {
        background-color: #f2f2f2;
    }

    .order-items img {
        width: 50px;
        height: auto;
    }

    .total-price {
        margin-top: 20px;
        text-align: right; /* Выравнивание общей цены вправо */
        font-weight: bold;
        font-size: 1.2em; /* Увеличение размера шрифта для общей цены */
    }

</style>

