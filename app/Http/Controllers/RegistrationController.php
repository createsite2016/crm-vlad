<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Форма регистрации сотрудника
     */
    public function index()
    {
        return view('page.user.registration.index');
    }

    /**
     * Регистрация нового пользователя
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        Auth::login($user);

        return redirect()->route('user.index');
    }
}
