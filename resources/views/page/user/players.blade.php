@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Исполнители</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">исполнители</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Исполнители</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>E-mail</th>
                            <th>Роль</th>
                            <th>Город</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td>{{ $player->id }}</td>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->phone }}</td>
                                <td>{{ $player->email }}</td>
                                <td>{{ $player->role->name }}</td>
                                <td>{{ $player->city->name }}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#modal-{{ $player->id }}" class="btn btn-outline-info btn-block btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                        @if($player->id !== Auth::user()->id)
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item danger">
                                                <i class="far fa-trash-alt"></i>
                                                <a href="{{ route('user.players.destroy', $player->id) }}">Удалить</a>
                                            </li>
                                        </ul>
                                        @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    @foreach($players as $player)
    <div class="modal fade" id="modal-{{ $player->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Изменение пользователя</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
{{--                    <form method="post" action="{{ route('user.players.store') }}">--}}
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-file-signature"></i>
                                    Имя Фамилия сотрудника
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ $player->name }}" placeholder="Имя Фамилия сотрудника">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-phone-alt"></i>
                                    Телефон сотрудника
                                </label>
                                <input type="text" name="phone" class="form-control" value="{{ $player->phone }}" placeholder="+79991234567">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-at"></i>
                                    E-mail сотрудника
                                </label>
                                <input type="email" name="email" value="{{ $player->email }}" class="form-control" placeholder="email@email.ru">
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
                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    @endforeach
@endsection
