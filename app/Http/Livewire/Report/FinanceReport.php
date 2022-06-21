<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class FinanceReport extends Component
{
    public function render()
    {
        return view('livewire.report.finance-report')
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
