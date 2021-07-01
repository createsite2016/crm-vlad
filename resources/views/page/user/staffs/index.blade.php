@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Склады</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">склады</li>
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
                    <h3 class="card-title">Склады</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>
                                Склады
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Склад</th>
                            <th>Время работы</th>
                            <th>Адрес</th>
                            <th>Город</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staffs as $staff)
                            <tr>
                                <td>{{ $staff->id }}</td>
                                <td>{{ $staff->name }}</td>
                                <td>{{ $staff->timework }}</td>
                                <td>{{ $staff->address }}</td>
                                <td>{{ $staff->city->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">
                                            <i class="fas fa-edit"></i>
                                            <a href="{{ route('user.staffs.edit', $staff->id) }}">Изменить</a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li class="dropdown-item danger">
                                            <i class="far fa-trash-alt"></i>
                                            <a href="{{ route('user.staffs.destroy', $staff->id) }}">Удалить</a>
                                        </li>
                                    </ul>
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

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Создание нового склада</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('user.staffs.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-file-signature"></i>
                                    Название склада
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="Название склада">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-phone-alt"></i>
                                    Адрес склада
                                </label>
                                <input type="text" name="address" class="form-control" placeholder="Например улица Пушкина 3">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Время работы склада
                                </label>
                                <input type="text" name="timework" class="form-control" placeholder="пн-птц с 9 до 18">
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
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
