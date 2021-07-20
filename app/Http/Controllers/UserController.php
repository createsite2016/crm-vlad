<?php

namespace App\Http\Controllers;

use App\Actions\DialogAction;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
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

    public function index()
    {
        $my_tasks = Task::all()
            ->whereNotIn('status_id', self::CONTROL)
            ->whereNotIn('status_id', self::COMPLETE)
            ->where('player_id', \Auth::user()->id);
        $send_tasks = Task::all()
            ->whereNotIn('player_id', \Auth::user()->id)
            ->whereNotIn('status_id', self::CONTROL)
            ->whereNotIn('status_id', self::COMPLETE)
            ->where('user_id', \Auth::user()->id);
        $control_tasks = Task::all()
            ->where('user_id', \Auth::user()->id)
            ->where('status_id', self::CONTROL);
        $dialogs = DialogAction::getAll();
        return view('page.user.index',[
            'my_tasks' => $my_tasks,
            'send_tasks' => $send_tasks,
            'control_tasks' => $control_tasks,
            'dialogs' => $dialogs,
            'background_color' => $this->background_color,
            'text_color' => $this->text_color,
            'statuses' => $this->statuses,
            'priority' => $this->priority
        ]);
    }

    public  function players()
    {
        return view('page.user.players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $player = User::find($id);
        if ($player){
            $player->delete();
        }

        return redirect()->route('user.players.index');
    }

    /**
     * Обновление информации автомобиля.
     *
     * @param UserUpdateRequest $request
     * @param int $player
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, int $player): RedirectResponse
    {
        $user = User::findOrFail($player);
        $user->update($request->all());

        return redirect()->route('user.players.index');
    }
}
