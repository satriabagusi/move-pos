<?php

namespace App\Http\Livewire\Report;

use App\Order;
use App\OrderDetail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
use App\User;

class ProductReport extends Component
{
    use WithPagination;
    public function render()
    {
        $data['product_out'] = Order::with(['users', 'order_details.products'])->paginate(10);
        $data['products'] = Product::paginate(10);
        return view('livewire.report.product-report', $data)
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
