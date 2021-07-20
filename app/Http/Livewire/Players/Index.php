<?php

namespace App\Http\Livewire\Players;

use App\Models\Car;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public $search;

    public $msg = '';
    public $studentId = 55;

    public function render()
    {

        $cities = City::all();
        $cars = Car::all();
        $roles = Role::all();

        if($this->search){
            $players = User::where('name', 'like', "%$this->search%")
                ->where('id','<>',\Auth::user()->id)
                ->get();

            return view('livewire.players.index', compact('players','cities','roles','cars'));
        } else {
            $players = User::all()
                ->whereNotIn('id', \Auth::user()->id)
                ->sortBy('name');
        }

        return view('livewire.players.index', compact('players','cities','roles','cars'));
    }
}
