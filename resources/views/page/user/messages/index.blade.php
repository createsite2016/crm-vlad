@extends('layouts.master')
@section('title')Админка @endsection
@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Сообщения</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">сообщения</li>
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
                    <h3 class="card-title">Все сообщения</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <button type="button" id="new_task" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>
                                Новое сообщение
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Кому</th>
                            <th>Текст сообщения</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($messages as $message)
                            <tr onclick="document.location = '{{ route('user.messages.edit', $message->id) }}';" style=" cursor:pointer;">
                                <td>{{ $message->user->name }}</td>
                                <td>{{ $message->text }}</td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="modal fade show" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Создание письма</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('user.messages.store') }}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-user-edit"></i>
                                    Кому
                                </label>
                                @error('user_id')
                                <br>
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                                <select name="user_id" class="custom-select rounded-0">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-comment-dots"></i>
                                    Текст письма
                                    @error('text')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </label>
                                <input type="text" name="text" class="form-control" placeholder="Тест письма">
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>


    </div>
@endsection
