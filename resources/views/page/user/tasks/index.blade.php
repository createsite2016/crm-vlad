@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Задачи</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">задачи</li>
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
                    <h3 class="card-title">Все задачи</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <button type="button" id="new_task" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>
                                Новая задача
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
                            <th>Создана</th>
                            <th>Выполнить</th>
                            <th>Компания</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Приоритет</th>
                            <th>Создал задачу</th>
                            <th>Исполняет задачу</th>
                            <th>Оборудование</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr style=" background: {{ $background_color[$task->priority_id] }}; color: {{ $text_color[$task->priority_id] }}">
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->created_at }}</td>
                                <td>{{ $task->deadline }}</td>
                                @if($task->company)
                                    <td>{{ $task->company->name }}</td>
                                @else
                                    <td>Нет</td>
                                @endif
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->status_id }}</td>
                                <td>{{ $task->priority_id }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td>{{ $task->player->name }}</td>
                                <td>{{ $task->device->name }}</td>
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
    <div class="modal fade show" id="modal-default">
        <livewire:companies.index.store />
    </div>
@endsection
