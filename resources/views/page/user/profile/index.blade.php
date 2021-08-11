@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Профиль</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">профиль</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header" style="background-color: #FFAA3E">
                            <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                            <h5 class="widget-user-desc">{{ Auth::user()->role->name }}</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="/dist/img/avatar5.png" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Город</h5>
                                        <span class="description-text">{{ Auth::user()->city->name }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Телефон</h5>
                                        <span class="description-text">{{ Auth::user()->phone }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">Email</h5>
                                        <span class="description-text">{{ Auth::user()->email }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link
                                        @if(Request::has('cars'))

                                        @else
                                            active
                                        @endif
                                        " href="#settings" data-toggle="tab">Данные профиля</a></li>
                                <li class="nav-item"><a class="nav-link
                                        @if(Request::has('cars'))
                                            active
                                        @else

                                        @endif
                                        " href="#cars" data-toggle="tab">Автомобили</a></li>
                                <li class="nav-item"><a class="nav-link" href="#event" data-toggle="tab">Уведомления</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="event">
                                    @if(Auth::user()->telegram_chat_id)
                                        Телеграмм бот уже подключен
                                    @else
                                        <a href="https://t.me/ozberg_bot" target="_blank" type="button" class="btn btn-default" >
                                            <i class="fas fa-plus-circle"></i>
                                            Подключить телеграмм бот
                                        </a>
                                    @endif
                                </div>

                                <div class="
                                @if(Request::has('cars'))

                                @else
                                    active
                                @endif
                                    tab-pane" id="settings">
                                    <form class="form-horizontal" method="POST" action="{{ route('user.profile.update') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Имя и Фамилия</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="Введите ваше имя и фамилию">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Введите ваш e-mail">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Номер телефона</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="Введите ваш номер телефона">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Новый пароль</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Повторите новый пароль</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password_two" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Сохранить данные профиля</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="
                                @if(Request::has('cars'))
                                    active
                                @else

                                @endif
                                tab-pane" id="cars">
                                    <div class="row">
                                        @foreach($cars as $car)
                                            @if(Auth::user()->car_id === $car->id)

                                                    <div class="col-lg-3 col-12">
                                                            <!-- small card -->
                                                            <div class="small-box bg-success">
                                                                    <div class="inner">
                                                                        <h3>{{ $car->way($car->id) }} <sup style="font-size: 20px">км</sup></h3>

                                                                        <p>{{ $car->name }} (активен) <small>{{ $car->number }}</small></p>
                                                                    </div>
                                                                    <div class="icon">

                                                                        <i class="fas fa-check-circle"></i>
                                                                    </div>

                                                                @if($car->way($car->id) > 0)
                                                                    <a href="#" style="cursor: context-menu;" data-toggle="modal" data-target="#modal-lg{{ $car->id }}" class="small-box-footer">
                                                                        Посмотреть пробег <i class="fas fa-arrow-circle-right"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                    </div>

                                            @else
                                                <div class="col-lg-3 col-12">
                                                    <!-- small card -->
                                                    <div class="small-box bg-warning">
                                                        <div class="inner" style="cursor: grab;" onclick="document.location = '{{ route('user.profile.car.select', $car->id) }}';">
                                                            <h3>{{ $car->way($car->id) }}<sup style="font-size: 20px">км</sup></h3>
                                                            <p>{{ $car->name }} <small>{{ $car->number }}</small></p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fas fa-car"></i>
                                                        </div>
                                                        @if($car->way($car->id) > 0)
                                                            <a href="#" style="cursor: context-menu;" data-toggle="modal" data-target="#modal-lg{{ $car->id }}" class="small-box-footer">
                                                                Посмотреть пробег <i class="fas fa-arrow-circle-right"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <button type="button" id="new_task" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                        <i class="fas fa-plus-circle"></i>
                                        Новая машина
                                    </button>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @foreach($cars as $car)
    <div class="modal fade" id="modal-lg{{ $car->id }}" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Пробег {{ $car->name }} <small>{{ $car->number }}</small></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Крайние 10 поездок</h3>

                                    <div class="card-tools">
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Дата</th>
                                            <th>Задача</th>
                                            <th>Пробег</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>11-7-2014</td>
                                            <td>Забрать молоток</td>
                                            <td>11 км</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach

    <div class="modal fade show" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Добавление новой машины</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('user.cars.store') }}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-car"></i>
                                    Марка машины
                                    @error('name')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="БМВ е46">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-ad"></i>
                                    Номер машины
                                    @error('number')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </label>
                                <input type="text" name="number" class="form-control" placeholder="мм111м23">
                                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::user()->id }}">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>


    </div>
@endsection
