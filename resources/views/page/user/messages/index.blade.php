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
            <div class="card-header">
                <h3 class="card-title">Ваши диалоги</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <button type="button" id="new_task" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                            <i class="fas fa-paper-plane"></i>
                            Написать
                        </button>
                    </div>
                </div>
            </div>
            <div class="card direct-chat-contacts-open">
                <div class="direct-chat-contacts" style="background-color: white">
                    <ul class="contacts-list">
                        @forelse($dialogs as $dialog)
                            <li>
                                <a href="{{ route('user.messages.show', $dialog->id) }}">
                                    <img class="contacts-list-img" src="/dist/img/user1-128x128.jpg" alt="User Avatar">

                                    <div class="contacts-list-info" style="color: black;">
                                          <span class="contacts-list-name" style="color: black;">
                                            {{ $dialog->user->name }}
                                            <small class="contacts-list-date float-right" style="color: black;">2/28/2015</small>
                                          </span>
                                            <span class="contacts-list-msg" style="color: black;">{{ $dialog->message->text }}</span>
                                    </div>

                                </a>
                            </li>
                        @empty

                        @endforelse
                    </ul>
                </div>
            </div>
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
                                <select name="recipient_id" class="custom-select rounded-0">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-comment-dots"></i>
                                    Текст письма
                                    @error('text')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </label>
                                <textarea class="form-control" name="text" rows="3" placeholder="Тест письма">{{ old('text') }}</textarea>
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
