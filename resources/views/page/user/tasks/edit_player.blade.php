@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Задача</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active"><a href="{{ URL::previous() }}">задачи</a></li>
                        <li class="breadcrumb-item active">просмотр</li>
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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Задача</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('user.tasks.update_player', $task->id) }}">
                    @method('PATCH')
                    @csrf

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Статус
                            @error('status_id')
                            <code>{{ $message }}</code>
                            @enderror
                            <input type="text" class="form-control" value="{{ $statuses[$task->status_id] }}" disabled>
                            <input type="hidden" name="status_id" class="form-control" value="1">
                        </label>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Название
                            <input type="text" class="form-control" value="{{ $task->name }}" disabled>
                        </label>
                    </div>

                    <div class="card-body">
                        <label for="exampleInputEmail1">
                            <i class="far fa-edit"></i>
                            Описание задачи
                        </label>
                        <textarea disabled class="form-control" name="description" rows="15" placeholder="в свободной форме">{{ $task->description }}</textarea>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Выполнить до:
                            <input type="text" class="form-control" value="{{ date_smart($task->deadline) }}" disabled>
                        </label>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Приоритет
                            <input type="text" class="form-control" value="{{ $priority[$task->priority_id] }}" disabled>
                        </label>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Оборудование
                            <input type="text" class="form-control"
                                   @if($task->device)
                                   value="{{ $task->device->name }}"
                                   @else
                                   value="Нет"
                                   @endif

                                   disabled>
                        </label>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Назначил задачу
                            <input type="text" class="form-control" value="{{ $task->user->name }}" disabled>
                        </label>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Компания:
                            <input type="text" class="form-control"
                                   @if($task->company)
                                   value="{{ $task->company->name }}"
                                   @else
                                   value="Нет"
                                   @endif

                                   disabled>
                        </label>
                    </div>

                    <div class="card-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default float-right">Отмена</a>
                        <button type="submit" class="btn btn-primary">Выполнить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
