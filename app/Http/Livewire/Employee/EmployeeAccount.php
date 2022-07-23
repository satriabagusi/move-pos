<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;

class EmployeeAccount extends Component
{
    public function render()
    {
        return view('livewire.employee.employee-account')
                    ->extends('layouts.dashboard')
                    ->section('content');
    }
}
