@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Автомобили</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.cars.index') }}">Автомобили</a></li>
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
                    <h3 class="card-title">Изменение автомобиля</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('user.cars.update', $car->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название автомобиля</label>
                            <input type="text" name="name" class="form-control" value="{{ $car->name }}" placeholder="например Молоток">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Номер автомобиля</label>
                            <input type="text" name="number" class="form-control" value="{{ $car->number }}" placeholder="количество">
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('user.cars.index') }}" class="btn btn-default float-right">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
