<?php

namespace App\Http\Controllers;


use App\Models\Car;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // профиль главная страница
    public function index()
    {
        $cars = Car::where('user_id', \Auth::user()->id)->get();
        return view('page.user.profile.index', compact('cars'));
    }

    /**
     * Обновить информацию профиля
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::findOrFail(\Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->password){
            if($request->password == $request->password_two){
                $user->password = $request->password;
                $user->update();

                return redirect()->route('user.logout');
            }
        }
        $user->update();

        return redirect()->route('user.profile.index');
    }
}
