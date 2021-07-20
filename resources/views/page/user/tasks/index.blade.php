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
                    @if($tasks->isEmpty())
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
                            @forelse($tasks as $task)
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
    <div class="modal fade show" id="modal-default">
        @livewire('companies.index.store')
    </div>
@endsection
