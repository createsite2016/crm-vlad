@extends('layouts.master')

@section('title')Админка @endsection

@section('header_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Исполнители</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/user">Главная</a></li>
                        <li class="breadcrumb-item active">исполнители</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('players.index')
@endsection
