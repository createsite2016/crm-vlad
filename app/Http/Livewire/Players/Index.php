<?php

namespace App\Http\Livewire\Players;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public $search;

    public function render()
    {

        $cities = City::all();
        $roles = Role::all();

        if($this->search){
            $players = User::where('name', 'like', "%$this->search%")
                ->where('id','<>',\Auth::user()->id)
                ->get();

            return view('livewire.players.index', compact('players','cities','roles'));
        } else {
            $players = User::all()
                ->whereNotIn('id', \Auth::user()->id)
                ->sortBy('name');
        }

        return view('livewire.players.index', compact('players','cities','roles'));
    }
}
