<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
