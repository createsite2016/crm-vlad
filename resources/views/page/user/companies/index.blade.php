@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Компании</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">компании</li>
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
                    <h3 class="card-title">Компании</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>
                                Компания
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
                            <th>Название компании</th>
                            <th>Телефон</th>
                            <th>Адрес</th>
                            <th>Город</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Компания 1</td>
                            <td>+79991234567</td>
                            <td>г. Москва, ул. Пушкина, дом Тарахтушкина</td>
                            <td>г. Москва</td>
                        </tr>

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
                        <h3 class="card-title">Создание новой компании</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-file-signature"></i>
                                    Название компании
                                </label>
                                <input type="text" class="form-control" placeholder="Название компании">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-phone-alt"></i>
                                    Телефон компании
                                </label>
                                <input type="text" class="form-control" placeholder="+79991234567">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Адрес компании
                                </label>
                                <input type="text" class="form-control" placeholder="+79991234567">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Город
                                </label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                                    <option>Москва</option>
                                    <option>Казань</option>
                                    <option>Самара</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="button" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
