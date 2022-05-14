<?php

namespace App\Http\Livewire\Transaction;

use App\AppSetting;
use App\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Livewire\Component;

class Transaction extends Component
{
    public $cart;
    public $sessionId, $qty, $no, $tax, $totalTransaction = 0;

    public function mount(){
        $this->sessionId = rand(1,100);
        $this->tax = AppSetting::select('tax')->first()->tax;
    }

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

    }

    public function increaseItem($id, $qty){
        $qty = $qty++;
        Cart::session($this->sessionId)->update($id, [
            'quantity' => 1,
        ]);
        $this->totalTransaction = Cart::getTotal();
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
    }

    public function deleteItem($id){
        $removeItem = Cart::session($this->sessionId)->remove($id);
        $this->totalTransaction = Cart::getTotal();

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

    public function checkoutCart(){
        dd($this->cart);
    }



    public function render()
    {
        $products = Product::with(['categories'])->get();
        $this->cart = Cart::getContent()->toArray();
        return view('livewire.transaction.transaction', compact('products'))
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
