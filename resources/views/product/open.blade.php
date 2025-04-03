<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукт и Отзывы</title>
</head>
<body>
<div class="container">
    <div class="product">
        <div class="product-details">
            <button class="product-button">
                <img
                    src="{{ $product->image }}"
                    class="product-image"
                />
            </button>
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-description">
                    {{ $product->description }}
                </p>
                <p class="product-price">Цена: {{ '$' . $product->price }}</p>
            </div>
        </div>
    </div>

    <div class="reviews-section">
        <h2>Отзывы о продукте</h2>
        <div class="review-form">
            <h3>Оставьте отзыв</h3>
            <form action="/review" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group">
                    @if($errors->has('rating'))
                        <div class="alert alert-danger">{{ $errors->first('rating') }}</div>
                    @endif
                    <label for="rating">Оценка (1-5):</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" required>
                </div>
                <div class="form-group">
                    @if($errors->has('author'))
                        <div class="alert alert-danger">{{ $errors->first('author') }}</div>
                    @endif
                    <label for="author">Ваше имя:</label>
                    <input type="text" name="author" id="author" required>
                </div>
                <div class="form-group">
                    @if($errors->has('content'))
                        <div class="alert alert-danger">{{ $errors->first('content') }}</div>
                    @endif
                    <label for="content">Ваш отзыв:</label>
                    <textarea name="content" id="content" rows="4" required></textarea>
                </div>

                <button type="submit">Отправить отзыв</button>
            </form>
        </div>

        <div class="reviews-list">
            <h3>Все отзывы</h3>
            @if(isset($reviews))
            @foreach($reviews as $review)
            <div class="review">
                <p class="review-rating">Оценка: {{ $review->rating }}</p>
                <p class="review-author">Автор: {{ $review->author }}</p>
                <p class="review-date">Дата: {{$review->created_at}}</p>
                <p class="review-text">{{ $review->content }}</p>
            </div>
            @endforeach;
            @endif
        </div>
    </div>
</div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .product {
        margin-bottom: 40px;
    }

    .product-details {
        display: flex;
        align-items: center;
    }

    .product-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
        margin-right: 20px;
    }

    .product-image {
        width: 150px;
        height: auto;
        border-radius: 8px;
    }

    .product-info {
        flex-grow: 1;
    }

    .product-title {
        font-size: 1.8em;
        margin: 0;
    }

    .product-description {
        margin: 10px 0;
    }

    .product-price {
        font-size: 1.2em;
        font-weight: bold;
        color: #d9534f;
    }

    .reviews-section {
        border-top: 1px solid #ccc;
        padding-top: 20px;
    }

    .review-form {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="number"],
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #218838;
    }

    .reviews-list {
        margin-top: 20px;
    }

    .review {
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .review-rating {
        font-weight: bold;
    }

    .review-author{
        color: black;

    }
    .review-date{
        color: red;
    }
    .review-text {
        margin: 5px 0;
        font-weight: 900;
    }

</style>
