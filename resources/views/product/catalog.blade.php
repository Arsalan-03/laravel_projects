<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Меню</title>
</head>
<body>
<header>
    <a href="#" class="logo"> LOGO </a>
    <nav>
        <ul>
            <li><a href="/myOrders">Purchase</a></li>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/cart">Cart</a></li>
            <li><a href="#">Design &bigtriangledown;</a>
                <ul>
                    <li><a href="#">UI Design</a></li>
                    <li><a href="#">UX Design</a></li>
                </ul>
            </li>
            <li>
                <form action="/signOut" method="post">
                    @csrf
                    <a> <button>Log Out</button> </a>
                </form>
            </li>
        </ul>
    </nav>
</header>

<section class="cards">
    <div class="container container_cards">
        @foreach($products as $product)
            <!-- Карточка товара -->
        <div class="card">
            <!-- Верхняя часть -->
            <div class="card__top">

                <!-- Изображение-ссылка товара -->
                <form action="/openProduct" method="get">
                    @csrf
                    <a class="card__image"> <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button class="product-button">
                            <img
                                src="{{ $product->image }}"
                                class="product-image"
                            />
                        </button>
                    </a>
                </form>
                <!-- Скидка на товар -->
                <div class="card__label">-10%</div>
            </div>
            <!-- Нижняя часть -->
            <div class="card__bottom">
                <!-- Цены на товар (с учетом скидки и без)-->
                <div class="card__prices">
                    <div class="card__price card__price--discount">{{ $product->price }}</div>
                    <div class="card__price card__price--common">150 000</div>
                </div>
                <!-- Ссылка-название товара -->
                <a href="#" class="card__title">
                    {{ $product->name }}
                </a>
                <!--Кнопка добавить в корзину-->
                <form action="/addProduct" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="amount" value="1">
                    <button class="card__add">В корзину</button>
                </form>
            </div>
        </div>
        @endforeach;
    </div>
</section>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        // Обработчик для всех форм с классом add-to-cart-form--}}
{{--        $('.add-to-cart-form').on('submit', function (event) {--}}
{{--            // Предотвращаем стандартное поведение формы--}}
{{--            event.preventDefault();--}}

{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: "/addProduct",--}}
{{--                data: $(this).serialize(),--}}
{{--                dataType: 'json',--}}
{{--                success: function (response) {--}}
{{--                    // Обновляем количество товаров в бейдже корзины--}}
{{--                    $('.card__bottom').text(response.count);--}}
{{--                },--}}
{{--                errors: function(xhr, status, errors) {--}}
{{--                    console.errors('Ошибка при добавлении товара:', errors);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: sans-serif;
        list-style: none;
        text-decoration: none;
    }

    body {
        height: 100vh;
        background-color: mediumpurple;
        background-size: cover;
        background-position: center;
    }

    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 8%;
        box-shadow: 0 5px 10px #000000;
    }
    header.logo {
        font-size: 20px;
        font-weight: 900;
        color: black;
        transition: .5s;
    }

    header.logo:hover {
        transform: scale(1.2);
    }

    header nav ul li {
        position: relative;
        float: left;
    }

    header nav ul li a {
        padding: 15px;
        color: black;
        font-size: 16px;
        display: block;
    }

    header nav ul li a:hover {
        background: black;
        color: white;
    }

    nav ul li ul {
        position: absolute;
        left: 0;
        width: 100px;
        background: white;
        display: none;
    }

    nav ul li ul li {
        width: 100%;
        border: 1px solid rgba(0, 0,0,.1);
    }

    nav ul li ul li ul {
        left: 100px;
        top: 0;
    }

    nav ul li:hover > ul {
        display: initial;''
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }


    .card {
        width: 225px;
        min-height: 350px;
        box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column; /* Размещаем элементы в колонку */
        border-radius: 4px;
        transition: 0.2s;
        position: relative;
    }

    /* При наведении на карточку - меняем цвет тени */
    .card:hover {
        box-shadow: 4px 8px 16px rgba(255, 102, 51, 0.2);
    }

    .card__top {
        flex: 0 0 220px; /* Задаем высоту 220px, запрещаем расширение и сужение по высоте */
        position: relative;
        overflow: hidden; /* Скрываем, что выходит за пределы */
    }

    /* Контейнер для картинки */
    .card__image {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .card__image > img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Встраиваем картинку в контейнер card__image */
        transition: 0.2s;
    }

    /* При наведении - увеличиваем картинку */
    .card__image:hover > img {
        transform: scale(1.1);
    }

    /* Размещаем скидку на товар относительно изображения */
    .card__label {
        padding: 4px 8px;
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: #ff6633;
        border-radius: 4px;
        font-weight: 400;
        font-size: 16px;
        color: #fff;
    }

    .card__bottom {
        display: flex;
        flex-direction: column;
        flex: 1 0 auto; /* Занимаем всю оставшуюся высоту карточки */
        padding: 10px;
    }

    .card__prices {
        display: flex;
        margin-bottom: 10px;
        flex: 0 0 50%; /* Размещаем цены равномерно в две колонки */
    }

    .card__price::after {
        content: "₽";
        margin-left: 4px;
        position: relative;
    }

    .card__price--discount {
        font-weight: 700;
        font-size: 19px;
        color: #414141;
        display: flex;
        flex-wrap: wrap-reverse;
    }

    .card__price--discount::before {
        content: "Со скидкой";
        font-weight: 400;
        font-size: 13px;
        color: #bfbfbf;
    }

    .card__price--common {
        font-weight: 400;
        font-size: 17px;
        color: #606060;
        display: flex;
        flex-wrap: wrap-reverse;
        justify-content: flex-end;
    }

    .card__price--common::before {
        content: "Обычная";
        font-weight: 400;
        font-size: 13px;
        color: #bfbfbf;
    }

    .card__title {
        display: block;
        margin-bottom: 10px;
        font-weight: 400;
        font-size: 17px;
        line-height: 150%;
        color: #414141;
    }

    .card__title:hover {
        color: #ff6633;
    }

    .card__add {
        display: block;
        width: 100%;
        font-weight: 400;
        font-size: 17px;
        color: #70c05b;
        padding: 10px;
        text-align: center;
        border: 1px solid #70c05b;
        border-radius: 4px;
        cursor: pointer; /* Меняем курсор при наведении */
        transition: 0.2s;
        margin-top: auto; /* Прижимаем кнопку к низу карточки */
    }

    .card__add:hover {
        border: 1px solid #ff6633;
        background-color: #ff6633;
        color: #fff;
    }

    .cards {
        padding: 75px 0;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        padding: 0 15px;
        margin: 0 auto;
    }

    .container_cards {
        display: grid;
        width: 100%;
        grid-template-columns: repeat(auto-fill, 225px);
        justify-content: center;
        justify-items: center;
        margin: 0 auto;
        column-gap: 30px;
        row-gap: 40px;
    }
    .product-button {
        background-color: transparent; /* Задать прозрачный фон для кнопки */
        border: none; /* Удалить границы кнопки */
        cursor: pointer; /* Изменить указатель при наведении */
        padding: 0; /* Удалить внутренние отступы */
    }

    .product-image {
        max-width: 100%; /* Ограничить ширину до 100% от контейнера */
        height: auto; /* Автоматическая высота для сохранения пропорций */
        border-radius: 8px; /* Округление углов изображения (по желанию) */
        display: block; /* Сделать изображение блочным элементом */
    }

</style>
