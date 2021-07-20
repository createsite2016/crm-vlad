@extends('layouts.master')
@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Панель быстрого доступа</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@php
    /**
     * Человекопонятная русская дата (и время)
     *
     * @param string $date_input Что-то хоть как-то похожее на дату
     * @param bool $time Показывать время
     * @return string
     */
    function date_smart($date_input, $time=true) {
        $monthes = array(
            '', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
            'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
        );
        $date = strtotime($date_input);

        //Время
        if($time) $time = ' G:i';
        else $time = '';

        //Сегодня, вчера, завтра
        if(date('Y') == date('Y',$date)) {
            if(date('z') == date('z', $date)) {
                $result_date = date('Сегодня'.$time, $date);
            } elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)+1,date('Y',$date)))) {
                $result_date = date('Вчера'.$time, $date);
            } elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)-1,date('Y',$date)))) {
                $result_date = date('Завтра'.$time, $date);
            }

            if(isset($result_date)) return $result_date;
        }

        //Месяца
        $month = $monthes[date('n',$date)];

        //Года
        if(date('Y') != date('Y', $date)) $year = 'Y г.';
        else $year = '';

        $result_date = date('j '.$month.' '.$year.$time, $date);
        return $result_date;
    }
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> Задачи на мне</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if($my_tasks->isEmpty())
                        <br>
                        <div class="col-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Нет задач</span>
                                    <span class="progress-description">
                                        Позже они обязательно будут
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Выполнить</th>
                                <th>Компания</th>
                                <th>Статус</th>
                                <th>Приоритет</th>
                                <th>Создал</th>
                                <th>Выполняет</th>
                                <th>Оборудование</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($my_tasks as $task)
                                <tr onclick="document.location = '{{ route('user.tasks.edit', $task->id) }}';" style=" background: {{ $background_color[$task->priority_id] }}; cursor:pointer; color: {{ $text_color[$task->priority_id] }}">
                                    <td>{{ $task->name }}</td>
                                    <td>{{ date_smart($task->deadline) }}</td>
                                    @if($task->company)
                                        <td>{{ $task->company->name }}</td>
                                    @else
                                        <td>Нет</td>
                                    @endif
                                    <td>{{ $statuses[$task->status_id] }}</td>
                                    <td>{{ $priority[$task->priority_id] }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>{{ $task->player->name }}</td>
                                    @if($task->device)
                                        <td>{{ $task->device->name }}</td>
                                    @else
                                        <td>Нет</td>
                                    @endif
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-people-arrows"></i>
                        ‍Я поручил
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if($send_tasks->isEmpty())
                        <br>
                        <div class="col-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Нет задач</span>
                                    <span class="progress-description">
                                        Позже они обязательно будут
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Выполнить</th>
                                <th>Компания</th>
                                <th>Статус</th>
                                <th>Приоритет</th>
                                <th>Создал</th>
                                <th>Выполняет</th>
                                <th>Оборудование</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($send_tasks as $task)
                                <tr onclick="document.location = '{{ route('user.tasks.edit', $task->id) }}';" style=" background: {{ $background_color[$task->priority_id] }}; cursor:pointer; color: {{ $text_color[$task->priority_id] }}">
                                    <td>{{ $task->name }}</td>
                                    <td>{{ date_smart($task->deadline) }}</td>
                                    @if($task->company)
                                        <td>{{ $task->company->name }}</td>
                                    @else
                                        <td>Нет</td>
                                    @endif
                                    <td>{{ $statuses[$task->status_id] }}</td>
                                    <td>{{ $priority[$task->priority_id] }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>{{ $task->player->name }}</td>
                                    @if($task->device)
                                        <td>{{ $task->device->name }}</td>
                                    @else
                                        <td>Нет</td>
                                    @endif
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="color: #FFAA3E">
                        <i class="fas fa-user-check" style="color: #FFAA3E"></i>
                            На проверке
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if($control_tasks->isEmpty())
                        <br>
                        <div class="col-12">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Нет задач</span>
                                    <span class="progress-description">
                                        Позже они обязательно будут
                                    </span>
                                </div>
                            </div>
                        </div>
                    @else
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Выполнить</th>
                                <th>Компания</th>
                                <th>Статус</th>
                                <th>Приоритет</th>
                                <th>Создал</th>
                                <th>Выполняет</th>
                                <th>Оборудование</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($control_tasks as $task)
                                <tr onclick="document.location = '{{ route('user.tasks.edit', $task->id) }}';" style=" background: {{ $background_color[$task->priority_id] }}; cursor:pointer; color: {{ $text_color[$task->priority_id] }}">
                                    <td>{{ $task->name }}</td>
                                    <td>{{ date_smart($task->deadline) }}</td>
                                    @if($task->company)
                                        <td>{{ $task->company->name }}</td>
                                    @else
                                        <td>Нет</td>
                                    @endif
                                    <td>{{ $statuses[$task->status_id] }}</td>
                                    <td>{{ $priority[$task->priority_id] }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>{{ $task->player->name }}</td>
                                    @if($task->device)
                                        <td>{{ $task->device->name }}</td>
                                    @else
                                        <td>Нет</td>
                                    @endif
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12" style="height: 505px;">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-comments"></i>
                        Ваши диалоги
                    </h3>
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
@endsection
