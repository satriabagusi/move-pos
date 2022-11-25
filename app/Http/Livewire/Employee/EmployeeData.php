<?php

namespace App\Http\Livewire\Employee;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeeData extends Component
{

    public function render()
    {
        if (Auth::user()->user_role_id == 1) {
            return view('livewire.employee.employee-data',
                        ['employees' => User::where('id', '!=', Auth::user()->id)->paginate(10)])
                        ->extends('layouts.dashboard')
                        ->section('content');
        }else{
            return abort(403, "You're not allowed access this page!");
        }
    }
}
