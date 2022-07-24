<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;


class ProductPurchase extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.product.product-purchase',
                    ['products' => Product::paginate(10)])
                    ->extends('layouts.dashboard')
                    ->section('content');
    }
}
