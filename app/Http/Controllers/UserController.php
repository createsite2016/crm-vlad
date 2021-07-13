<?php

namespace App\Http\Controllers;

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
}
