<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;

class EmployeeData extends Component
{
    public function render()
    {
        return view('livewire.employee.employee-data')
                    ->extends('layouts.dashboard')
                    ->section('content');
    }
}
