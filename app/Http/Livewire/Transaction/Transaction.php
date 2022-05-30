<?php

namespace App\Http\Livewire\Transaction;

use App\AppSetting;
use App\Category;
use App\Discount;
use App\Http\Livewire\Product\ProductCategory;
use App\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Transaction extends Component
{
    public $cart, $vouchers, $voucherSelected;
    public $sessionId, $qty, $no, $tax, $voucherCode, $totalTransaction = 0;
    public $search;
    public $products;
    public $subTotal;
    public $discount, $discountType;

    public function mount(){
        $this->sessionId = Auth::user()->id;
        $this->tax = AppSetting::select('tax')->first()->tax;

        $this->vouchers = Discount::all();
        $this->cart = Cart::session($this->sessionId);
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;

        $this->products = Product::with(['categories'])->get();
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
        $this->totalTransaction = Cart::getTotal();
        $this->subTotal = Cart::getTotal() + ($this->totalTransaction * $this->tax / 100) ;

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

    public function updatedSearch(){
        $this->products = Product::with(['categories'])
                    ->where('product_code', 'like', '%'.$this->search.'%')
                    ->orWhere('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->get();
        $this->cart = Cart::session($this->sessionId);
    }

    public function checkoutCart(){
        dd($this->cart);
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
