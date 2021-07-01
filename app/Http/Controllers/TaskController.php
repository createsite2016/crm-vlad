<?php

namespace App\Http\Controllers;


use App\Http\Requests\TaskPostRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index()
    {
        $background_color = [
            0 => '',
            1 => 'yellow',
            2 => 'red'
        ];
        $text_color = [
            0 => '',
            1 => '',
            2 => 'white'
        ];
        $tasks = Task::all();
        return view('page.user.tasks.index', compact('tasks', 'background_color', 'text_color'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskPostRequest $request
     * @return RedirectResponse
     */
    public function store(TaskPostRequest $request): RedirectResponse
    {
        Task::create($request->validated());
        return redirect()->route('user.tasks.store');
    }
}
