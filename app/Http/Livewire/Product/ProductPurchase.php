<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Product;
use App\ProductPurchase as AppProductPurchase;
use Illuminate\Support\Facades\Auth;

class ProductPurchase extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $products;
    public $price, $quantity, $total, $product_id;

    protected $listeners = [
        'deleteProductPurchase',
    ];

    public function mount(){
        $this->products = Product::all();
    }

    protected $rules = [
        'price' => 'required|between:0,999.999|min:1',
        'quantity' => 'required|numeric|min:1'
    ];

    protected $messages = [
        'price.required' => 'Harga tidak boleh kosong.',
        'price.between' => 'Harga harus berupa angka',
        'price.min' => 'Harga tidak boleh 0',
        'quantity.required' => 'Jumlah barang tidak boleh kosong.',
        'quantity.numeric' => 'Jumlah barang harus berupa angka',
        'quantity.min' => 'Jumlah barang tidak boleh 0',
    ];

    public function updated($propertName){
        $this->validateOnly($propertName);
    }

    public function saveProductPurchase(){
        $validatedData = $this->validate();

        $total = str_replace(".", "", $this->price)*$this->quantity;

        $insert = AppProductPurchase::create([
            'price' => str_replace(".", "", $this->price),
            'quantity' => $this->quantity,
            'total' => $total,
            'product_id' => $this->product_id,
            'user_id' => Auth::user()->id,
        ]);

        $updateStock = Product::where('id', $this->product_id)
                            ->increment('stock', $this->quantity);

        if($insert && $updateStock){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil menginput pembelian produk'
            ]);
            $this->reset('price', 'quantity');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal menginput pembelian produk'
            ]);
            $this->reset('price', 'quantity');
        }
    }

    public function deleteWindow($id){
        $product_purchase = AppProductPurchase::with(['products'])->findOrFail($id);
        // dd($product_purchase);
        $this->dispatchBrowserEvent('swal:confirm',
            [
                'id' => $id,
                'icon' => 'warning',
                'title' => 'Hapus Kategori',
                'html' => 'Yakin ingin menghapus data pembelian <b>'.$product_purchase->products->name.'</b> ?',
                'showCancelButton' => true,
                'confirmButtonText' => 'Hapus !',
                'confirmButtonColor' => '#435EBE',
                'cancelButtonText' => 'Batal',
            ]);
    }

    public function deleteProductPurchase($id){
        if($id){
            $product_purchase = AppProductPurchase::where('id', $id)->first();
            $deleted = AppProductPurchase::where('id', $id)->delete();
            $updateStock = Product::where('id', $id)
                            ->decrement('stock', $product_purchase->quantity);
            if($deleted && $updateStock){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil menghapus data pembelian'
                ]);
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal menghapus data pembelian'
                ]);
            }
        }
    }


    public function render()
    {
        return view('livewire.product.product-purchase',
                    ['product_purchases' => AppProductPurchase::with(['products'])->paginate(10)])
                    ->extends('layouts.dashboard')
                    ->section('content');
    }
}
