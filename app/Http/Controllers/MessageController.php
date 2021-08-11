<?php

namespace App\Http\Controllers;

use App\Actions\DialogAction;
use App\Actions\MessageAction;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('id','<>', auth()->user()->id)->get();
        $dialogs = DialogAction::getAll();

        return view('page.user.messages.index', compact('dialogs', 'users'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $dialog): View
    {
        $messages = Message::where('dialog_id', $dialog)->get();
        if(!count($messages)){
            abort(404);
        }

        return view('page.user.messages.show', compact('dialog', 'messages'));
    }

    /**
     * Создание сообщений.
     *
     * @param MessageRequest $request
     * @return RedirectResponse
     */
    public function store(MessageRequest $request): RedirectResponse
    {
        MessageAction::add($request);

        return redirect()->route('user.messages.index');
    }

    /**
     * @param MessageRequest $request
     * @return RedirectResponse
     */
    public function store_chat(MessageRequest $request): RedirectResponse
    {
        $dialog = $request->get('dialog');
        MessageAction::add($request);

        return redirect()->route('user.messages.show', $dialog);
    }
}
