<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;

class ProductReport extends Component
{
    public function render()
    {
        return view('livewire.report.product-report')
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
