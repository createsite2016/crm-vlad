<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

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
            <p class="login-box-msg">Регистрация нового сотрудника</p>

            <form action="{{ route('user.registration.store') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="name" name="name" class="form-control" placeholder="Имя сотрудника" value="{{ old('name') }}">
                    @error('name')
                    <div class="input-group mb-3">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-user-tag"></i>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    @error('phone')
                    <div class="input-group mb-3">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <input type="text" name="phone" class="form-control" placeholder="Номер телефона сотрудника" value="{{ old('phone') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    @error('email')
                    <div class="input-group mb-3">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <input type="email" name="email" class="form-control" placeholder="Email сотрудника" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    @error('password')
                    <div class="input-group mb-3">
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                    @enderror
                    <input type="password" name="password" class="form-control" placeholder="Пароль сотрудника">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleSelectRounded0">
                        <i class="fas fa-exclamation-circle"></i>
                        Роль
                    </label>
                    @error('role_id')
                    <br>
                    <span class="text-danger">
                                    {{ $message }}
                                </span>
                    @enderror
                    <select name="role_id" class="custom-select rounded-0">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleSelectRounded0">
                        <i class="fas fa-exclamation-circle"></i>
                        Город
                    </label>
                    @error('city_id')
                    <br>
                    <span class="text-danger">
                                    {{ $message }}
                                </span>
                    @enderror
                    <select name="city_id" class="custom-select rounded-0">
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <button type="submit" class="btn btn-block btn-primary">
                        <i class="fas fa-user-plus"></i> Создать уч.запись
                    </button>
                </div>
            </form>

            <p class="mb-1">
                <a href="/user">перейти на главную страницу</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</body>
</html>
