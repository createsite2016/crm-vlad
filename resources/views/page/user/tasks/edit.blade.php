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

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Задача</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('user.tasks.update', $task->id) }}">
                    @method('PATCH')
                    @csrf

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="far fa-building"></i>
                            Компания
                            @error('company_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <select wire:model="company_id" name="company_id" class="custom-select rounded-0">
                            <option value="0">нет</option>
                            @foreach($companies as $company)
                                @if($company->id == $task->company_id)
                                    <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                    continue;
                                @else
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                        <label for="exampleInputEmail1">
                            <i class="far fa-edit"></i>
                            Описание задачи
                            @error('description')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <textarea class="form-control" name="description" rows="15" placeholder="в свободной форме">{{ $task->description }}</textarea>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="far fa-building"></i>
                            Оборудование
                            @error('device_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <select name="device_id" class="custom-select rounded-0">
                            <option value="0">нет</option>
                            @foreach($devices as $device)
                                @if($device->id == $task->device_id)
                                    <option selected value="{{ $device->id }}">{{ $device->name }}</option>
                                    continue;
                                @else
                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Исполнитель
                            @error('user_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @error('status_id')
                        <code>{{ $message }}</code>
                        @enderror
                        @error('user_id')
                        <code>{{ $message }}</code>
                        @enderror
                        <select class="custom-select rounded-0" name="player_id">
                            @foreach($users as $user)
                                @if($user->id == $task->player_id)
                                    <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Статус
                            @error('status_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <select class="custom-select rounded-0" name="status_id">
                            @foreach($statuses as $key=>$value)
                                @if($task->status_id == $key)
                                    <option selected value="{{ $key }}">{{ $value }}</option>
                                    continue;
                                @else
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-exclamation-circle"></i>
                            Приоритет
                            @error('priority_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <select class="custom-select rounded-0" name="priority_id">
                        @foreach($priority as $key=>$value)
                            @if($task->priority_id == $key)
                                <option selected value="{{ $key }}">{{ $value }}</option>
                                continue;
                            @else
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>

                    <div class="card-body">
                        <label>
                            <i class="fas fa-calendar-alt"></i>
                            Дата выполнения:
                            @error('deadline')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input type="text" name="deadline" class="form-control datetimepicker-input" value="{{ $task->deadline }}" data-target="#datetimepicker2"/>
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
                                    format: 'YYYY-MM-DD HH:mm:00',
                                    locale: 'ru',
                                    allowInputToggle: true,
                                    icons: {
                                        time: 'far fa-clock'
                                    }
                                });
                            });
                        </script>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ URL::previous() }}" class="btn btn-default float-right">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
