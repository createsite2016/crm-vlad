@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Оборудование</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.companies.index') }}">оборудование</a></li>
                        <li class="breadcrumb-item active">изменить</li>
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
                    <h3 class="card-title">Изменение оборудование</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('user.devices.update', $device->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название оборудования</label>
                            <input type="text" name="name" class="form-control" value="{{ $device->name }}" placeholder="например Молоток">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Количество</label>
                            <input type="text" name="volume" class="form-control" value="{{ $device->volume }}" placeholder="количество">
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-exclamation-circle"></i>
                            Склад
                        </label>
                        <select name="staff_id" class="custom-select rounded-0">
                            @foreach($staffs as $staff)
                                @if($staff->id == $device->staff_id)
                                    <option selected value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @else
                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('user.devices.index') }}" class="btn btn-default float-right">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
