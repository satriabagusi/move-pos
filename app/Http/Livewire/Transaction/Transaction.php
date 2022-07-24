<?php

namespace App\Http\Livewire\Transaction;

use App\AppSetting;
use App\Category;
use App\Discount;
use App\Http\Livewire\Product\ProductCategory;
use App\Order;
use App\OrderDetail;
use App\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Transaction extends Component
{
    public $cart, $vouchers, $voucherSelected, $customer_name, $search, $products, $subTotal, $discount, $discountType, $discount_feature;
    public $sessionId, $qty, $no, $tax, $voucherCode, $totalTransaction = 0;
    public $appSetting, $invoice_no, $sectionCond, $total_pay;

    public function mount(){
        $this->sessionId = Auth::user()->id;
        $this->tax = AppSetting::select('tax')->first()->tax;
        $this->appSetting = AppSetting::first();
        $this->vouchers = Discount::all();
        $this->cart = Cart::session($this->sessionId);
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;

        $this->products = Product::with(['categories'])->get();

        $this->invoice_no = rand(1000,9999)."0".$this->sessionId.date("dmY");

    }

    protected $listeners = ['updateVoucher'];

    public function addToCart($id){
        $product = Product::where('id', $id)->select('id', 'product_code', 'name', 'price')->first();

        $addCart = Cart::session($this->sessionId)->add([
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $this->qty+1,
            'price' => $product->price,
            'associatedModel' => $product
        ]);

        if($addCart){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil menambahkan ke Keranjang'
            ]);
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal menambahkan ke Keranjang'
            ]);
        }

        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;

    }

    public function increaseItem($id, $qty){
        $qty = $qty++;
        Cart::session($this->sessionId)->update($id, [
            'quantity' => 1,
        ]);
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;
    }

    public function decreaseItem($id, $qty){
        $qty = $qty--;
        if($qty > 1){
            Cart::session($this->sessionId)->update($id, [
                'quantity' => -1,
            ]);
        }else{
            $removeItem = Cart::session($this->sessionId)->remove($id);
            if($removeItem){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil menghapus barang dari Keranjang'
                ]);
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal menghapus barang dari Keranjang'
                ]);
            }
        }
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;
    }

    public function deleteItem($id){
        $removeItem = Cart::session($this->sessionId)->remove($id);
        if($removeItem){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil menghapus barang dari Keranjang'
            ]);
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal menghapus barang dari Keranjang'
            ]);
        }
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;
    }

    public function updatedSearch(){
        $this->products = Product::with(['categories'])
                    ->where('product_code', 'like', '%'.$this->search.'%')
                    ->orWhere('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->get();
        $this->cart = Cart::session($this->sessionId);
    }

    public function checkoutCart(){

        $this->cart = Cart::session($this->sessionId);

        // $insertOrder = Order::create([
        //     'invoice' => $this->invoice_no,
        //     'total' => $this->totalTransaction,
        //     'payment_type' => 'cash',
        //     'customer_name' => $this->customer_name,
        //     'user_id' => $this->sessionId,
        //     'discount_id' => $this->voucherSelected ? $this->voucherSelected->id : null,
        // ]);

        // for ($i=1; $i <= count($this->cart) ; $i++) {
        //     $insertOrderDetail = OrderDetail::create([
        //         'quantity' => $this->cart[$i]['quantity'],
        //         'price' => $this->cart[$i]['price'],
        //         'product_id' => $this->cart[$i]['id'],
        //         'order_id' => $insertOrder->id,
        //     ]);
        // }

        $this->emit('showResiModal');
        // if($insertOrder && $insertOrderDetail) {
        //     $this->subTotal = 0;
        //     $this->totalTransaction = 0;
        //     $this->voucherSelected = null;
        //     Cart::session($this->sessionId)->clear();
        //     $this->cart = Cart::session($this->sessionId);

        //     $this->dispatchBrowserEvent('message', [
        //         'status' => 200 ,
        //         'message' => 'Berhasil input transaksi'
        //     ]);


        // }else{
        //     $this->dispatchBrowserEvent('message', [
        //         'status' => 100 ,
        //         'message' => 'Gagal input transaksi'
        //     ]);

        // }
    }

    public function updatedVoucherCode(){
        $this->cart = Cart::session($this->sessionId);
        // dd($this->voucherSelected);

        if(!$this->voucherCode){
            $this->totalTransaction = Cart::getTotal();
            $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;
            $this->discount == null;
        }else if($this->voucherSelected->type == 1){
            $this->totalTransaction = Cart::getTotal();
            $tax = ($this->totalTransaction * $this->tax / 100);
            $total = Cart::getTotal() + $tax ;
            $disc = $total - $this->voucherSelected->percentage;
            $this->subTotal = $disc;
            $this->discount = $this->voucherSelected->percentage;
        }else if($this->voucherSelected->type == 2){
            $this->totalTransaction = Cart::getTotal();
            $tax = ($this->totalTransaction * $this->tax / 100);
            $total = Cart::getTotal() + $tax ;
            $disc = $total - ($total * $this->voucherSelected->percentage / 100);
            $this->subTotal = $disc;
            $this->discount = $total * $this->voucherSelected->percentage / 100;
        }
    }

    public function applyVoucher($id){
        $this->voucherSelected = Discount::where('id', $id)->first();
        $this->voucherCode = $this->voucherSelected->code;
        $this->cart = Cart::session($this->sessionId);
        if(!$this->voucherCode){
            $this->totalTransaction = Cart::getTotal();
            $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;
            $this->discount == null;
        }else if($this->voucherSelected->type == 1){
            $this->totalTransaction = Cart::getTotal();
            $tax = ($this->totalTransaction * $this->tax / 100);
            $total = Cart::getTotal() + $tax ;
            $disc = $total - $this->voucherSelected->percentage;
            $this->subTotal = $disc;
            $this->discount = $this->voucherSelected->percentage;
        }else if($this->voucherSelected->type == 2){
            $this->totalTransaction = Cart::getTotal();
            $tax = ($this->totalTransaction * $this->tax / 100);
            $total = Cart::getTotal() + $tax ;
            $disc = $total - ($total * $this->voucherSelected->percentage / 100);
            $this->subTotal = $disc;
            $this->discount = $total * $this->voucherSelected->percentage / 100;
        }
        $this->emit('hideModal');
    }

    public function updatedSectionCond(){
        $this->cart = Cart::session($this->sessionId);
    }

    public function removeVoucher(){
        $this->voucherCode = null;
        $this->voucherSelected = null;
        $this->discount = null;
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;
    }

    public function render()
    {
        $this->cart = Cart::getContent()->toArray();
        return view('livewire.transaction.transaction')
                ->extends('layouts.home')
                ->section('content');
    }
}
