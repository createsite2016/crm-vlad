<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index()
    {
        return view('page.user.index');
    }

    public  function players()
    {
        $players = User::all();
        $cities = City::all();
        $roles = Role::all();
        return view('page.user.players', compact('players','cities', 'roles'));
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
}
