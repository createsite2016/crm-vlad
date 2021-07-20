@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("new_task").click();
    }, false);
</script>
@endif

<div class="modal-dialog">
    <div class="modal-content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Создание новой задачи</h3>
            </div>
            <form method="post" action="{{ route('user.tasks.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
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
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelectRounded0">
                            <i class="far fa-building"></i>
                            Название
                            @error('name')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Название задачи">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            <i class="far fa-edit"></i>
                            Описание задачи
                            @error('description')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <textarea class="form-control" name="description" rows="3" placeholder="в свободной форме">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-exclamation-circle"></i>
                            Приоритет
                            @error('priority_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <select class="custom-select rounded-0" name="priority_id">
                            <option value="2">Высокий</option>
                            <option value="1">Средний</option>
                            <option value="0">Низкий</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-user-tie"></i>
                            Исполнитель
                            @error('status_id')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <input type="hidden" name="status_id" value="0">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @error('status_id')
                        <code>{{ $message }}</code>
                        @enderror
                        @error('user_id')
                        <code>{{ $message }}</code>
                        @enderror
                        <select class="custom-select rounded-0" name="player_id">
                            @foreach($users as $user)
                                @if(Auth::user()->id == $user->id)
                                    continue;
                                @else
                                    <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                            <option value="{{ Auth::user()->id }}">Назначить на себя самого</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>
                            <i class="fas fa-calendar-alt"></i>
                            Дата выполнения:
                            @error('deadline')
                            <code>{{ $message }}</code>
                            @enderror
                        </label>
                        <div class="form-group">
                            <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                <input type="text" name="deadline" class="form-control datetimepicker-input" value="{{ old('deadline') }}" data-target="#datetimepicker2"/>
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
                    <div class="form-group">
                        <label for="exampleSelectRounded0">
                            <i class="fas fa-hammer"></i>
                            Оборудование
                        </label>
                        <select name="device_id" class="custom-select rounded-0">
                            <option value="0">Нет</option>
                            @foreach($devices as $device)
                                <option selected value="{{ $device->id }}">{{ $device->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

