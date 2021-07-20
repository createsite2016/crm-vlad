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
                        <li class="breadcrumb-item"><a href="/user/messages">сообщения</a></li>
                        <li class="breadcrumb-item active">диалог</li>
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
            <div class="card direct-chat direct-chat-primary">
                <div class="card-header">
                    <h3 class="card-title">Диалог</h3>
                </div>
                <div class="card-body">
                    <div class="direct-chat-messages">

                        @foreach($messages as $message)
                            @if($message->sender_id == Auth::user()->id)
                                @php
                                    $sender_id = $message->recipient->id;
                                @endphp
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right">{{ Auth::user()->name }}</span>
                                        <span class="direct-chat-timestamp float-left">{{ $message->date_smart($message->created_at) }}</span>
                                    </div>

                                    <img class="direct-chat-img" src="/dist/img/avatar5.png" alt="message user image">
                                    <div class="direct-chat-text">
                                        {{ $message->text }}
                                    </div>
                                </div>
                            @else
                                @php
                                    $recipient_id = $message->sender->id;
                                @endphp
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">{{ $message->sender->name }}</span>
                                        <span class="direct-chat-timestamp float-right">{{ $message->date_smart($message->created_at) }}</span>
                                    </div>
                                    <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="message user image">
                                    <div class="direct-chat-text">
                                        {{ $message->text }}
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('user.messages.store_chat') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="text" placeholder="Написать сообщение ..." class="form-control">
                            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="recipient_id" value="{{ $recipient_id ?? $sender_id }}">
                            <input type="hidden" name="dialog" value="{{ $dialog }}">
                            <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">Отправить</button>
                    </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection






