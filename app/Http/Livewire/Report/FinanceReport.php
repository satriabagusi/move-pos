<?php

namespace App\Http\Livewire\Report;

use App\Order;
use Carbon\Carbon;
use Livewire\Component;

class FinanceReport extends Component
{


    public $daily_sales, $monthly_sales, $annualy_sales;

    public function mount(){
        $this->daily_sales = Order::whereDate('created_at', Carbon::today())->sum('total');
        $this->monthly_sales = Order::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()->lastOfMonth()])->sum('total');
    }

    public function render()
    {
        return view('livewire.report.finance-report')
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
