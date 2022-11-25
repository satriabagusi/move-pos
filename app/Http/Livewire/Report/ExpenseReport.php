<?php

namespace App\Http\Livewire\Report;

use App\ProductPurchase;
use App\Order;
use Carbon\Carbon;
use Livewire\Component;

class ExpenseReport extends Component
{

    public $daily_sales, $monthly_sales, $annualy_sales, $daily_expense, $monthly_expense;

    public function mount(){
        $this->daily_sales = Order::whereDate('created_at', Carbon::today())->sum('total');
        $this->monthly_sales = Order::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()->lastOfMonth()])->sum('total');
        $this->daily_profit = Order::whereTime('created_at', '>=', Carbon::parse('10:00'))->whereTime('created_at', '<=', Carbon::parse('02:00'))->get();

        $this->daily_expense = ProductPurchase::whereDate('created_at', Carbon::today())->sum('total');
        $this->monthly_expense = ProductPurchase::whereBetween('created_at', [Carbon::now()->firstOfMonth(), Carbon::now()->lastOfMonth()])->sum('total');
    }

    public function render()
    {
        return view('livewire.report.expense-report')
                ->extends('layouts.dashboard')
                ->section('content');;
    }
}
