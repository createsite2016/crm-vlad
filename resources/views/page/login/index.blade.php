<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OZBERG | Вход</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/user"><b>OZBERG</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Войдите, чтобы начать работу</p>

            <form action="{{ route('login.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <span class="text-danger">@error('email'){{ $message }} @enderror</span><br>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <button type="submit" class="btn btn-block btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Войти
                    </button>
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">Забыли пароль?</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</body>
</html>
