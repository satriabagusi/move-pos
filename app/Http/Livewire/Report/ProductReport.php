<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;

class ProductReport extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.report.product-report',
                ['products' => Product::paginate(10)])
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
