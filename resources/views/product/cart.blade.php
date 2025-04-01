<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Корзина</title>
</head>
<body>
<div class="cart-container">
    <h2>Ваша корзина</h2>
    @foreach($cartProducts as $cartProduct)
    <ul class="cart-items">
        <li class="cart-item">
            <img src="{{ $cartProduct->Product->image }}" alt="Товар 1" class="product-image">
            <div class="item-details">
                <h3>{{ $cartProduct->Product->name }}</h3>
                <p>{{ $cartProduct->Product->price . '$' }} </p>

                <div style="display: flex; align-items: center;">
                    <form action="/deleteToCart" method="post" style="margin: 0;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartProduct->Product->id }}">
                        <input type="hidden" name="amount" value="1">
                        <button type="submit">-</button>
                    </form>

                    <span style="margin: 0 10px;">{{ $cartProduct->amount }}</span>

                    <form action="/addToCart" method="post" style="margin: 0;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $cartProduct->Product->id }}">
                        <input type="hidden" name="amount" value="1">
                        <button type="submit">+</button>
                    </form>
                </div>

            </div>
            <button class="remove-item">Удалить</button>
        </li>
        @endforeach
    </ul>
    <div class="cart-summary">
        <h3>Итого:</h3>
        <p class="total-price">{{ '$' . $cartProduct->amount *= $cartProduct->Product->price }}</p>
        <button class="checkout-button">Оформить заказ</button>
    </div>

</div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    .cart-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    .cart-items {
        list-style-type: none;
        padding: 0;
    }

    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .item-details {
        flex-grow: 1;
        margin-left: 10px;
    }

    .item-quantity {
        width: 60px;
        margin-left: 10px;
    }

    .remove-item {
        background-color: #ff4d4d;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .cart-summary {
        margin-top: 20px;
        text-align: center;
    }

    .total-price {
        font-size: 1.5em;
        font-weight: bold;
    }

    .checkout-button {
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

</style>

