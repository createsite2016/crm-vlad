<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/plugins/moment/moment-with-locales.js') }}"></script>
    <script src="{{ asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/user" class="nav-link">Главная</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Поиск" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/user" class="brand-link">
            <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">OZBERG</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info" style="color: #FFAA3E">
                    <a href="/user/profile" class="d-block">{{ Auth::user()->name }}</a>
                    {{ Auth::user()->role->name }}
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item {{ request()->routeIs('user.tasks.index','user.tasks.edit','user.tasks.team','user.tasks.control','user.tasks.complete') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="fas fa-tasks"></i>
                            <p class="text-info">
                                Задачи
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        @php
                            use App\Models\Task;

                            const CONTROL = 1;
                            const COMPLETE = 2;

                            $url = URL::previous();
                            $route_name = collect(\Route::getRoutes())->first(function($route) use($url){
                                return $route->matches(request()->create($url));
                            });
                            $my_tasks = Task::all()
                                ->whereNotIn('status_id', CONTROL)
                                ->whereNotIn('status_id', COMPLETE)
                                ->where('player_id', \Auth::id())
                                ->count();

                            $send_tasks = Task::all()
                                ->whereNotIn('player_id', \Auth::id())
                                ->whereNotIn('status_id', CONTROL)
                                ->whereNotIn('status_id', COMPLETE)
                                ->where('user_id', \Auth::id())
                                ->count();

                            $control_tasks = Task::all()
                                ->where('user_id', \Auth::id())
                                ->where('status_id', CONTROL)
                                ->count();
                        @endphp
                        <ul class="nav nav-treeview" style="display: {{ request()->routeIs('user.tasks.index','user.tasks.team','user.tasks.control','user.tasks.edit','user.tasks.complete') ? 'block' : 'none' }};">
                            @if($my_tasks)
                            <li class="nav-item">
                                <a href="{{ route('user.tasks.index') }}" class="nav-link {{ request()->routeIs('user.tasks.index') ? 'active' : '' }}">
                                    <i class="fas fa-user"></i>
                                    <p>
                                        На мне
                                            <span class="badge badge-info right">{{ $my_tasks }}</span>
                                    </p>
                                </a>
                            </li>
                            @endif
                            @if($send_tasks)
                                <li class="nav-item">
                                    <a href="{{ route('user.tasks.team') }}" class="nav-link {{ request()->routeIs('user.tasks.team') ? 'active' : '' }}">
                                        <i class="fas fa-people-arrows"></i>
                                        <p>
                                            ‍Я поручил
                                                <span class="badge badge-info right">{{ $send_tasks }}</span>
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if($control_tasks)
                            <li class="nav-item">
                                <a href="{{ route('user.tasks.control') }}" class="nav-link {{ request()->routeIs('user.tasks.control') ? 'active' : '' }}">
                                    <i class="fas fa-user-check" style="color: #FFAA3E"></i>
                                    <p style="color: #FFAA3E">
                                        На проверке
                                            <span class="badge badge-info right">{{ $control_tasks }}</span>
                                    </p>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('user.tasks.complete') }}" class="nav-link {{ request()->routeIs('user.tasks.complete') ? 'active' : '' }}">
                                    <i class="fas fa-user-check" style="color: #00a87d"></i>
                                    <p style="color: #00a87d">
                                        Выполненые
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="{{ route('user.players.index') }}" class="nav-link {{ request()->routeIs('user.players.index') ? 'active' : '' }}">
                            <i class="fas fa-user-friends"></i>
                            <p>Исполнители</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.messages.index') }}" class="nav-link {{ request()->routeIs('user.messages.index') ? 'active' : '' }}">
                            <i class="far fa-comments"></i>
                            <p>Сообщения</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.companies.index') }}" class="nav-link {{ request()->routeIs('user.companies.index') ? 'active' : '' }}">
                            <i class="far fa-building"></i>
                            <p>Компании</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.devices.index') }}" class="nav-link {{ request()->routeIs('user.devices.index') ? 'active' : '' }}">
                            <i class="fas fa-hammer"></i>
                            <p>Оборудование</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('user.cars.index','user.staffs.index','user.cities.index') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="far fa-folder-open text-info"></i>
                            <p class="text-info">
                                Дополнительно
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: {{ request()->routeIs('user.cars.index','user.staffs.index','user.cities.index') ? 'block' : 'none' }};">
                            <li class="nav-item">
                                <a href="{{ route('user.cars.index') }}" class="nav-link {{ request()->routeIs('user.cars.index') ? 'active' : '' }}">
                                    <i class="fas fa-car"></i>
                                    <p>
                                        Автомобили
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.staffs.index') }}" class="nav-link {{ request()->routeIs('user.staffs.index') ? 'active' : '' }}">
                                    <i class="fas fa-boxes"></i>
                                    <p>
                                        Склады
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.cities.index') }}" class="nav-link {{ request()->routeIs('user.cities.index') ? 'active' : '' }}">
                                    <i class="fas fa-city"></i>
                                    <p>
                                        Города
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.registration.index') }}" class="nav-link">
                                    <i class="fas fa-user-plus"></i>
                                    <p>
                                        Создать пользователя
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.logout') }}" class="nav-link">
                            <i class="fas fa-door-open text-danger"></i>
                            <p class="text-danger">
                                Выход
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        @yield('header_content')
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Разработанно по индивидуальному заказу
        </div>
        <strong>OZBERG &copy; 2021</strong>
    </footer>
</div>
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('/plugins/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('/dist/js/demo.js') }}"></script>
@livewireScripts
</body>
</html>
