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
                        <li class="breadcrumb-item active">автомобили</li>
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
                    <h3 class="card-title">Все автомобили</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <button type="button" id="new_task" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus-circle"></i>
                                Новая машина
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Марка</th>
                            <th>Номер</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($cars as $car)
                            <tr onclick="document.location = '{{ route('user.cars.edit', $car->id) }}';" style=" cursor:pointer;">
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->number }}</td>
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
                        <h3 class="card-title">Добавление новой машины</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('user.cars.store') }}">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-car"></i>
                                    Марка машины
                                    @error('name')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </label>
                                <input type="text" name="name" class="form-control" placeholder="Марка машины">
                            </div>

                            <div class="form-group">
                                <label for="exampleSelectRounded0">
                                    <i class="fas fa-ad"></i>
                                    Номер машины
                                    @error('number')
                                    <code>{{ $message }}</code>
                                    @enderror
                                </label>
                                <input type="text" name="number" class="form-control" placeholder="м233м23">
                            </div>

                            <label for="exampleSelectRounded0">
                                <i class="fas fa-ad"></i>
                                Сотрудник
                                @error('number')
                                <code>{{ $message }}</code>
                                @enderror
                            </label>
                            <select class="custom-select rounded-0" name="user_id">
                                @foreach($users as $user)
                                    @if(Auth::user()->id == $user->id)
                                        continue;
                                    @else
                                        <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                @endforeach
                                <option value="{{ Auth::user()->id }}">Я</option>
                            </select>

                        </div>
                        <!-- /.card-body -->

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>


    </div>
@endsection
