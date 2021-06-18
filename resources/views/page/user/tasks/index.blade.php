@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Заявки</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">заявки</li>
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
                    <h3 class="card-title">Все заявки</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>
                                Новая заявка
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
                            <th>Задача</th>
                            <th>Ответственный</th>
                            <th>Исполнитель</th>
                            <th>Срок</th>
                            <th>Статус</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>183</td>
                            <td>Тест</td>
                            <td>Влад</td>
                            <td>Андрей</td>
                            <td>11-7-2021.</td>
                            <th>Не готово</th>
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
                        <h3 class="card-title">Создание новой заявки</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="far fa-building"></i>
                                    Объект
                                </label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                                    <option>объект 1</option>
                                    <option>объект 2</option>
                                    <option>объект 3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">
                                    <i class="far fa-edit"></i>
                                    Описание заявки
                                </label>
                                <textarea class="form-control" rows="3" placeholder="в свободной форме"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-exclamation-circle"></i>
                                    Приоритет
                                </label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                                    <option>Высокий</option>
                                    <option>Средний</option>
                                    <option>Низкий</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-user-tie"></i>
                                    Исполнитель
                                </label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                                    <option>Илья Иванов</option>
                                    <option>Макс Петров</option>
                                    <option>Евгений Крутов</option>
                                </select>
                            </div>
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>
                                    <i class="fas fa-calendar-alt"></i>
                                    Дата выполнения:
                                </label>
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker2').datetimepicker({
                                            locale: 'ru',
                                            allowInputToggle: true,
                                            icons: {
                                                time: 'far fa-clock'
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-hammer"></i>
                                    Оборудование
                                </label>
                                <select class="custom-select rounded-0" id="exampleSelectRounded0">
                                    <option>Молоток</option>
                                    <option>Пила</option>
                                    <option>Отвертка</option>
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
