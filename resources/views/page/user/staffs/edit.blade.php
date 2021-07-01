@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Склады</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.companies.index') }}">склады</a></li>
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
                    <h3 class="card-title">Изменение склада</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('user.staffs.update', $staff->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название склад</label>
                            <input type="text" name="name" class="form-control" value="{{ $staff->name }}" placeholder="например Москва">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Время работы склада</label>
                            <input type="text" name="timework" class="form-control" value="{{ $staff->timework }}" placeholder="например Москва">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Адрес компании</label>
                            <input type="text" name="address" class="form-control" value="{{ $staff->address }}" placeholder="например Москва">
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-exclamation-circle"></i>
                            Город
                        </label>
                        <select name="city_id" class="custom-select rounded-0">
                            @foreach($cities as $city)
                                @if($city->id == $staff->city_id)
                                    <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                @else
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="{{ route('user.staffs.index') }}" class="btn btn-default float-right">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
