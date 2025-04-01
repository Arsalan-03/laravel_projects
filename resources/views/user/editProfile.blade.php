<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
</head>

<body>
<form action="/postEditProfile" method="post">
    @csrf
    <div class="profile-container">
        <h2>Профиль пользователя</h2>
        <div class="profile-info">

            <label for="name">Имя:</label>
            <input type="text" name ="name" id="name" value="Новое Имя">
            @if($errors->has('name'))
                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
            @endif

            <label for="email">Почта:</label>
            <input type="email" name ="email" id="email" value="youremail@example.com">
            @if($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
            @endif

            <label for="password">Пароль:</label>
            <input type="password" name ="password" id="password" placeholder="Введите новый пароль">
            @if($errors->has('password'))
                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
            @endif

            <label for="password">Подтвердите пароль:</label>
            <input type="password" name ="password_confirmation" id="password_confirmation" placeholder="Подтвердите пароль">

            <button class="save-changes">Сохранить изменения</button>
        </div>
    </div>
</form>
</body>
</html>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: darkgrey;
        margin: 0;
        padding: 20px;
    }

    .profile-container {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
    }

    .profile-info {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
    }

    input {
        margin-top: 5px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .save-changes {
        margin-top: 20px;
        padding: 10px 15px;
        border: none;
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }


</style>
