<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/desk.jpg">
    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>login page</title>
</head>
<body>
<div class="login-box">
    <form action="/postLogin" method="POST">
        @csrf
        <h2>Login</h2>

        <div class="input-box">
            <span class="icon">
                <i class="fa-solid fa-envelope"></i>
            </span>
            <input type="email" name="email" required value="{{ old('email') }}">
            <label for="">Login</label>
            @if($errors->has('email'))
                <div class="error-message">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="input-box">
            <span class="icon">
                <i class="fa-solid fa-lock"></i>
            </span>
            <input type="password" name="password" required>
            <label for="">Password</label>
            @if($errors->has('password'))
                <div class="error-message">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="remember-forgot">
            <label>
                <input type="checkbox"> Remember me
            </label>
            <a href="#">Forgot password?</a>
        </div>
        <button type="submit">Login</button>
        <div class="link">
            <p>
                Don't have an account?
                <a href="/registration">Register</a>
            </p>
        </div>
    </form>
</div>
</body>
</html>


<style>
    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
        -webkit-tap-highlight-color: transparent;
    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-image: url(https://i.postimg.cc/W11cDBzH/desk.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        font-family: sans-serif;
    }
    .login-box {
        position: relative;
        width: 400px;
        height: 450px;
        background-color: red;
        border: 1px solid #fff;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: transparent;
        backdrop-filter: blur(5px);
    }
    h2 {
        color: #fff;
        font-size: 2rem;
        text-align: center;
    }
    .input-box {
        position: relative;
        width: 310px;
        margin: 30px 0;
        border-bottom: 2px solid #fff;
    }
    .input-box label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        color: #fff;
        font-size: 16px;
        transition: all 0.5s ease;
    }
    .input-box input:focus~label,
    .input-box input:valid~label {
        top: -5px;
    }

    .input-box input {
        width: 100%;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        color: #fff;
        padding: 0 35px 0 5px;
    }
    .input-box .icon {
        position: absolute;
        right: 8px;
        font-size: 20px;
        color: white;
        line-height: 57px;
    }
    .remember-forgot {
        color: #fff;
        display: flex;
        justify-content: space-between;
    }
    .remember-forgot label,
    .remember-forgot a {
        margin: -15px 0 15px 0;
    }
    .remember-forgot label input {
        margin-right: 3px;
    }
    .remember-forgot a {
        color: #fff;
        text-decoration: none;
    }
    .remember-forgot a:hover {
        text-decoration: underline;
    }
    button {
        width: 100%;
        height: 40px;
        color: #000;
        background-color: #fff;
        border-radius: 20px;
        outline: none;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        border: 1px solid #fff;
        transition: all 0.3s ease;
    }
    button:hover {
        background-color: transparent;
        color: #fff;
    }
    .link {
        margin-top: 20px;
        color: #fff;
        text-align: center;
    }
    .link p a {
        text-decoration: none;
        color: #fff;
        font-weight: 600;
    }
    .link p a:hover {
        text-decoration: underline;
    }
    /* start  mobile */
    @media (max-width: 375px) {
        .login-box {
            width: 300px;
            height: 450px;
        }
        .input-box {
            position: relative;
            width: 275px;
            margin: 30px 0;
            border-bottom: 2px solid #fff;
        }
    }
    @media (min-width: 375px) and (max-width: 576px) {
        .login-box {
            width: 350px;
            height: 450px;
        }
        .input-box {
            position: relative;
            width: 275px;
            margin: 30px 0;
            border-bottom: 2px solid #fff;
        }
    }
    /* end  mobile */
</style>
