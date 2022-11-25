<?php

namespace App\Http\Livewire;

use App\OrderDetail;
use App\Product;
use App\ProductPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{

    public $product_stock_warn, $product_sale, $product_total;

    public function mount(){
        $this->product_stock_warn = Product::where('stock', "<=", 20)->get();
        $this->product_total = Product::where('stock', ">", 0)->sum('stock');
        $this->product_sale = OrderDetail::sum('quantity');
    }

    public function render( \Codedge\Updater\UpdaterManager $updater )
    {

        if( $updater->source()->isNewVersionAvailable()) {

            // Get the current installed version
            echo $updater->source()->getVersionInstalled();

            // Get the new version available
            $versionAvailable = $updater->source()->getVersionAvailable();

            // Create a release
            $release = $updater->source()->fetch($versionAvailable);

            // Run the update process
            $updater->source()->update($release);

        } else {
            echo "No new version available.";
        }

        $mostSaleProduct = OrderDetail::select('product_id', DB::raw('count(*) as total'))
                                ->groupBy('product_id')
                                ->orderBy('total', 'DESC')
                                ->get();
        $data['most_sale_product'] = Product::whereIn('id', $mostSaleProduct->pluck('product_id'))->paginate(10);
        return view('livewire.dashboard', $data)
            ->extends('layouts.dashboard')
            ->section('content');
    }
}
