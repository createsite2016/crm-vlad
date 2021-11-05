@php
use App\Actions\DialogAction;
@endphp
<section class="content">
    <div class="container-fluid">
        <h2 class="text-center display-4">Поиск</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form>
                    <div class="input-group">
                        <input wire:model="search" type="search" class="form-control form-control-lg" placeholder="Введите имя или фамилию сотрудника">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
                @forelse($players as $player)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">

                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>{{ $player->name }}</b></h2>
                                        <p class="text-muted text-sm"><i class="fas fa-user-tag"></i><b> Роль: </b> {{ $player->role->name }} </p>
                                        <p class="text-muted text-sm"><i class="fas fa-lg fa-building"></i><b> Город: </b> {{ $player->city->name }} </p>
                                        <p class="text-muted text-sm"><i class="fas fa-phone-volume"></i><b> Телефон: </b> {{ $player->phone }} </p>
                                        <p class="text-muted text-sm"><i class="fas fa-envelope-open-text"></i><b> E-mail: </b> {{ $player->email }} </p>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="../../dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    @if(DialogAction::getDialog($player->id, Auth::user()->id, true))
                                        <a href="{{ route('user.messages.show', DialogAction::getDialog($player->id, Auth::user()->id, true)) }}" class="btn btn-sm bg-teal">
                                            <i class="fas fa-comments"></i> Перейти в диалог
                                        </a>
                                    @endif
                                    <a href="#" data-toggle="modal" data-target="#modal-{{ $player->id }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('user.players.destroy', $player->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Сотрудник не найдет, проверте правильность запроса</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

@if($players)
@foreach($players as $player)
    <div class="modal fade" id="modal-{{ $player->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card card-primary">
                    <form action="{{ route('user.players.update', $player) }}" method="post">
                    <div class="card-header">
                        <h3 class="card-title">Изменение пользователя</h3>
                    </div>
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleSelectRounded0">
                                <i class="fas fa-file-signature"></i>
                                Имя Фамилия сотрудника
                            </label>
                            @error('name')
                            @enderror
                            <input type="text" name="name" class="form-control" value="{{ $player->name }}" placeholder="Имя Фамилия сотрудника">
                        </div>

                        <div class="form-group">
                            <label for="exampleSelectRounded0">
                                <i class="fas fa-phone-alt"></i>
                                Телефон сотрудника
                            </label>
                            @error('phone')
                            @enderror
                            <input type="text" name="phone" class="form-control" value="{{ $player->phone }}" placeholder="+79991234567">
                        </div>

                        <div class="form-group">
                            <label for="exampleSelectRounded0">
                                <i class="fas fa-at"></i>
                                E-mail сотрудника
                            </label>
                            @error('email')
                            @enderror
                            <input type="email" name="email" value="{{ $player->email }}" class="form-control" placeholder="email@email.ru">
                        </div>

                        <div class="form-group">
                            <label for="exampleSelectRounded0">
                                <i class="fas fa-exclamation-circle"></i>
                                Роль
                            </label>
                            @error('role_id')
                            <br>
                            <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <select name="role_id" class="custom-select rounded-0">
                                @foreach($roles as $role)
                                    @if($player->role_id == $role->id)
                                        <option selected value="{{ $role->id }}">{{ $role->name }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleSelectRounded0">
                                <i class="fas fa-exclamation-circle"></i>
                                Город
                            </label>
                            @error('city_id')
                            <br>
                            <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <select name="city_id" class="custom-select rounded-0">
                                @foreach($cities as $city)
                                    @if($player->city_id == $city->id)
                                        <option selected value="{{ $city->id }}">{{ $city->name }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleSelectRounded0">
                                <i class="fas fa-exclamation-circle"></i>
                                Автомобиль
                            </label>
                            @error('car_id')
                            <br>
                            <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                            <select name="car_id" class="custom-select rounded-0">
                                @foreach($cars as $car)
                                    @if($player->car_id == $car->id)
                                        <option selected value="{{ $car->id }}">{{ $car->name }}</option>
                                        @continue
                                    @endif
                                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endif
