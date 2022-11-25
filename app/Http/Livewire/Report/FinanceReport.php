<?php

namespace App\Http\Livewire\Report;

use App\Order;
use App\ProductPurchase;
use Carbon\Carbon;
use Livewire\Component;

class FinanceReport extends Component
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

        $start_of_day = Carbon::now()->startOfWeek();

        $data['profit']['daily'] = [
            "Senin" => Order::whereDate('created_at', $start_of_day)->sum('total'),
            "Selasa" => Order::whereDate('created_at', $start_of_day->copy()->addDay())->sum('total'),
            "Rabu" => Order::whereDate('created_at', $start_of_day->copy()->addDay(2))->sum('total'),
            "Kamis" => Order::whereDate('created_at', $start_of_day->copy()->addDay(3))->sum('total'),
            "Jum'at" => Order::whereDate('created_at', $start_of_day->copy()->addDay(4))->sum('total'),
            "Sabtu" => Order::whereDate('created_at', $start_of_day->copy()->addDay(5))->sum('total'),
            "Minggu" => Order::whereDate('created_at', $start_of_day->copy()->addDay(6))->sum('total'),
        ];

        // $start_of_month = Carbon::now()->startOfMonth();

        // $data['profit']['monthly'] = [
        //     'test' => [date_format($start_of_month->startOfWeek()->addWeek(), "d m Y"), date_format($start_of_month->endOfMonth(), "d m Y")],
        //     'week_one' => Order::whereBetween('created_at', [$start_of_month, $start_of_month->endOfWeek()])->sum('total'),
        //     'week_two' => Order::whereBetween('created_at', [$start_of_month->startOfWeek()->addWeek(), $start_of_month->endOfWeek()])->sum('total'),
        //     'week_three' => Order::whereBetween('created_at', [$start_of_month->startOfWeek()->addWeek(), $start_of_month->endOfWeek()])->sum('total'),
        //     'week_four' => Order::whereBetween('created_at', [$start_of_month->startOfWeek()->addWeek(), $start_of_month->endOfMonth()])->sum('total'),
        // ];

        $month = Carbon::now()->firstOfYear();

        $data['profit']['monthly'] = [
            "Januari" => Order::whereMonth('created_at', $month)->sum('total'),
            "Februari" => Order::whereMonth('created_at', $month->copy()->addMonth())->sum('total'),
            "Maret" => Order::whereMonth('created_at', $month->copy()->addMonth(2))->sum('total'),
            "April" => Order::whereMonth('created_at', $month->copy()->addMonth(3))->sum('total'),
            "Mei" => Order::whereMonth('created_at', $month->copy()->addMonth(4))->sum('total'),
            "Juni" => Order::whereMonth('created_at', $month->copy()->addMonth(5))->sum('total'),
            "Juli" => Order::whereMonth('created_at', $month->copy()->addMonth(6))->sum('total'),
            "Agustus" => Order::whereMonth('created_at', $month->copy()->addMonth(7))->sum('total'),
            "September" => Order::whereMonth('created_at', $month->copy()->addMonth(8))->sum('total'),
            "Oktober" => Order::whereMonth('created_at', $month->copy()->addMonth(9))->sum('total'),
            "November" => Order::whereMonth('created_at', $month->copy()->addMonth(10))->sum('total'),
            "Desember" => Order::whereMonth('created_at', $month->copy()->addMonth(11))->sum('total'),
        ];

        $start_of_day_expense = Carbon::now()->startOfWeek();

        $data['expense']['daily'] = [
            'monday' => ProductPurchase::whereDate('created_at', $start_of_day_expense)->sum('total'),
            'tuesday' => ProductPurchase::whereDate('created_at', $start_of_day_expense->copy()->addDay())->sum('total'),
            'wednesday' => ProductPurchase::whereDate('created_at', $start_of_day_expense->copy()->addDay(2))->sum('total'),
            'thursday' => ProductPurchase::whereDate('created_at', $start_of_day_expense->copy()->addDay(3))->sum('total'),
            'friday' => ProductPurchase::whereDate('created_at', $start_of_day_expense->copy()->addDay(4))->sum('total'),
            'saturday' => ProductPurchase::whereDate('created_at', $start_of_day_expense->copy()->addDay(5))->sum('total'),
            'sunday' => ProductPurchase::whereDate('created_at', $start_of_day_expense->copy()->addDay(6))->sum('total'),
        ];

        $data['expense']['monthly'] = [
            "Januari" => ProductPurchase::whereMonth('created_at', $month)->sum('total'),
            "Februari" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth())->sum('total'),
            "Maret" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(2))->sum('total'),
            "April" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(3))->sum('total'),
            "Mei" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(4))->sum('total'),
            "Juni" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(5))->sum('total'),
            "Juli" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(6))->sum('total'),
            "Agustus" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(7))->sum('total'),
            "September" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(8))->sum('total'),
            "Oktober" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(9))->sum('total'),
            "November" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(10))->sum('total'),
            "Desember" => ProductPurchase::whereMonth('created_at', $month->copy()->addMonth(11))->sum('total'),
        ];

        return view('livewire.report.finance-report', $data)
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
