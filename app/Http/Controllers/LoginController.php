<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Форма авторизации сотрудника
     */
    public function index()
    {
        return view('page.login.index');
    }

    /**
     * Авторизация сотрудника.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('user.index');
        }

        return back()->withErrors([
            'email' => 'Не верный логин или пароль.',
        ]);
    }

    /**
     * Выход сотрудника
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        return redirect()->back();
    }
}
