<?php

namespace App\Http\Livewire\Companies\Index;

use App\Models\Company;
use App\Models\Device;
use App\Models\User;
use Livewire\Component;

class Store extends Component
{
    public $company_id;

    public function render()
    {
        $companies = Company::all();

        if($this->company_id == 0){
            $users = User::all();
            $devices = Device::all();
        } else {
            $company = Company::where('id', $this->company_id)->first();
            $users = User::all()->where('city_id',  $company->city_id);
            $devices = Device::all()->load('staff')->where('staff.city_id',  $company->city_id);
        }

        return view('livewire.companies.index.store', compact('companies','users','devices'));
    }
}
