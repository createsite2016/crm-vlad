<?php

namespace App\Http\Controllers;


use App\Http\Requests\TaskForMeEditRequest;
use App\Http\Requests\TaskFromMeEditRequest;
use App\Http\Requests\TaskPostRequest;
use App\Models\Company;
use App\Models\Device;
use App\Models\Task;
use App\Models\User;
use App\Models\Way;
use App\Service\Telegram\Bot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TaskController extends Controller
{

    const CONTROL = 1;
    const COMPLETE = 2;

    public $background_color = [
        0 => '',
        1 => 'yellow',
        2 => 'red'
    ];
    public $text_color = [
        0 => '',
        1 => '',
        2 => 'white'
    ];
    public $statuses = [
        0 => '🆕 новая',
        1 => '👀 на проверке',
        2 => '✅ выполнена'
    ];
    public $priority = [
        0 => '❕ низкий',
        1 => '⚠️️ средний',
        2 => '🔥️ высокий'
    ];

    /**
     * Мои задачи
     * */
    public function index()
    {
        $tasks = Task::all()
            ->whereNotIn('status_id', self::CONTROL)
            ->whereNotIn('status_id', self::COMPLETE)
            ->where('player_id', \Auth::user()->id);

        return view('page.user.tasks.index',
            [
                'tasks' => $tasks,
                'background_color' => $this->background_color,
                'text_color' => $this->text_color,
                'statuses' => $this->statuses,
                'priority' => $this->priority
            ]);
    }

    /**
     * Внешние задачи
     */
    public function team()
    {
        $tasks = Task::all()
            ->whereNotIn('player_id', \Auth::user()->id)
            ->whereNotIn('status_id', self::CONTROL)
            ->whereNotIn('status_id', self::COMPLETE)
            ->where('user_id', \Auth::user()->id);

        return view('page.user.tasks.index',
            [
                'tasks' => $tasks,
                'background_color' => $this->background_color,
                'text_color' => $this->text_color,
                'statuses' => $this->statuses,
                'priority' => $this->priority
            ]);
    }

    /**
     * Задачи на проверку
     */
    public function control()
    {
        $tasks = Task::all()
            ->where('user_id', \Auth::user()->id)
            ->where('status_id', self::CONTROL);

        return view('page.user.tasks.index',
            [
                'tasks' => $tasks,
                'background_color' => $this->background_color,
                'text_color' => $this->text_color,
                'statuses' => $this->statuses,
                'priority' => $this->priority
            ]);
    }

    /**
     * Выполненые задачи
     */
    public function complete()
    {
        $tasks = Task::all()
            ->where('user_id', \Auth::user()->id)
            ->where('status_id', self::COMPLETE);

        return view('page.user.tasks.index',
            [
                'tasks' => $tasks,
                'background_color' => $this->background_color,
                'text_color' => $this->text_color,
                'statuses' => $this->statuses,
                'priority' => $this->priority
            ]);
    }



    /**
     * Создание задачи
     *
     * @param TaskPostRequest $request
     * @return RedirectResponse
     */
    public function store(TaskPostRequest $request): RedirectResponse
    {
        Task::create($request->validated());
        $user = User::where('id', '=', $request->get('player_id'))->first();
        if($user->telegram_chat_id){
            $bot = new Bot();
            $bot->sendToTelegram('У Вас новая задача! посмотреть можно тут: ' . route('user.tasks.index'), $user->telegram_chat_id);
        }

        return redirect()->route('user.tasks.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task $task
     * @return View
     */
    public function edit(Task $task): View
    {
        $task = Task::find($task->id);
        $devices = Device::all();
        if($task->user_id == \Auth::user()->id){
            $users = User::all();
            $companies = Company::all();
            $way = Way::find($task->way_id);

            return view('page.user.tasks.edit', [
                'task' => $task,
                'users' => $users,
                'statuses' => $this->statuses,
                'companies' => $companies,
                'priority' => $this->priority,
                'devices' => $devices,
                'way' => $way
            ]);
        }

       unset($this->statuses[2]);

        $way = Way::find($task->way_id);

        return view('page.user.tasks.edit_player', [
            'task' => $task,
            'statuses' => $this->statuses,
            'priority' => $this->priority,
            'way' => $way
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskFromMeEditRequest $request
     * @param int $task
     * @return RedirectResponse
     */
    public function update(TaskFromMeEditRequest $request, int $task): RedirectResponse
    {
        $task = Task::findOrFail($task);
        $task->update($request->all());

        Storage::disk('public')->delete($task->image_start);
        Storage::disk('public')->delete($task->image_finish);

        return redirect()->route('user.tasks.index');
    }

    /**
     * Обновление задачи исполнителем.
     *
     * @param TaskForMeEditRequest $request
     * @param int $task
     * @return RedirectResponse
     */
    public function update_player(TaskForMeEditRequest $request, int $task): RedirectResponse
    {
        if($request->get('way_id')){
            $way = Way::find($request->get('way_id'));
            $way->order_id = $task;
            $way->start = $request->get('way_start');
            $way->finish = $request->get('way_finish');
            $way->user_id = Auth::user()->id;
            $way->car_id = Auth::user()->car_id;
            $way->update();
        } else {
            $way = new Way();
            $way->order_id = $task;
            $way->start = $request->get('way_start');
            $way->finish = $request->get('way_finish');
            $way->user_id = Auth::user()->id;
            $way->car_id = Auth::user()->car_id;
            $way->save();
        }

        $task = Task::findOrFail($task);
        $task->status_id = $request->get('status_id');
        $task->way_id = $way->id ?? $request->get('way_id');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($task->image_start);
            $path_start = $request->image->store('images', 'public');
            $task->image_start = $path_start;
        }

        if ($request->hasFile('image_finish')) {
            Storage::disk('public')->delete($task->image_finish);
            $path_finish = $request->image_finish->store('images', 'public');
            $task->image_finish = $path_finish;
        }

        $task->update();

        return redirect()->route('user.tasks.index');
    }
}
