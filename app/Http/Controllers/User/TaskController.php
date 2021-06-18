<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        return view('page.user.tasks.index');
    }
}
