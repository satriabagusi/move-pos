<?php

namespace App\Http\Livewire\Product;

use App\Category;
use App\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $product_code, $product_name, $product_description, $product_stock, $product_price, $category_id, $categories;

    public $edit_product_id, $edit_product_code, $edit_product_name, $edit_product_description, $edit_product_price, $edit_product_stock, $edit_category_id;

    protected $listeners = [
        'deleteProduct',
    ];

    protected $rules = [
        'product_code' => 'required|max:50',
        'product_name' => 'required',
        'product_description' => 'required',
        'product_stock' => 'required|numeric',
        'product_price' => 'required|numeric',
    ];

    protected $messages = [
        'product_code.required' => 'Kode Produk Kosong.',
        'product_code.max' => 'Kode Produk Maks 50 karakter.',
        'product_name.required' => 'Nama Produk kosong.',
        'product_description.required' => 'Deskripsi Produk kosong.',
        'product_stock.required' => 'Stok awal Produk kosong.',
        'product_stock.numeric' => 'Stok awal Produk harus berupa angka.',
        'product_price.required' => 'Harga jual Produk kosong.',
        'product_price.numeric' => 'Harga jual produk harus berupa angka.',
    ];


    public function mount(){
        $this->categories = Category::all();
    }


    public function updatedCategoryId($value){
        $val = (object) $value;
        $this->product_code = $val->value.rand(100000000, 999999999).rand(100000000, 999999999);
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function saveProduct(){
        $validatedData = $this->validate();
        $category_id = (object) $this->category_id;

        $insert = Product::create([
            'product_code' => $this->product_code,
            'name' => $this->product_name,
            'description' => $this->product_description,
            'stock' => $this->product_stock,
            'price' => str_replace(".", "", $this->product_price),
            'category_id' => $category_id->value,
        ]);

        if($insert){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil menambahkan kategori produk'
            ]);
            $this->reset('product_code', 'product_name', 'product_description', 'product_stock', 'product_price');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal menambahkan kategori produk'
            ]);
            $this->reset('product_code', 'product_name', 'product_description', 'product_stock', 'product_price');
        }

    }

    public function editProduct($id){
        $product = Product::findOrFail($id);
        $this->edit_product_id = $product->id;
        $this->edit_product_code = $product->product_code;
        $this->edit_product_name = $product->name;
        $this->edit_product_description = $product->description;
        $this->edit_product_price = number_format($product->price, 0, ',' ,'.');
        $this->edit_product_stock = $product->stock;
        $this->edit_category_id = $product->category_id;
    }

    public function updateProduct(){
        $this->validate([
            'edit_product_code' => 'required|max:50',
            'edit_product_name' => 'required',
            'edit_product_description' => 'required',
            'edit_product_stock' => 'required|numeric',
            'edit_product_price' => 'required|numeric',
        ], [
            'edit_product_code.required' => 'Kode Produk Kosong.',
            'edit_product_code.max' => 'Kode Produk Maks 50 karakter.',
            'edit_product_name.required' => 'Nama Produk kosong.',
            'edit_product_description.required' => 'Deskripsi Produk kosong.',
            'edit_product_stock.required' => 'Stok awal Produk kosong.',
            'edit_product_stock.numeric' => 'Stok awal Produk harus berupa angka.',
            'edit_product_price.required' => 'Harga jual Produk kosong.',
            'edit_product_price.numeric' => 'Harga jual produk harus berupa angka.',
        ]);

        $update = Product::where('id', $this->edit_product_id)
                    ->update([
                        'product_code' => $this->edit_product_code,
                        'name' => $this->edit_product_name,
                        'description' => $this->edit_product_description,
                        'stock' => $this->edit_product_stock,
                        'price' => str_replace(".", "", $this->edit_product_price),
                        'category_id' => $this->edit_category_id,
                    ]);

        if($update){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil mengubah data produk'
            ]);
            $this->reset('edit_product_id', 'edit_product_code', 'edit_product_name', 'edit_product_description', 'edit_product_stock', 'edit_product_price');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal mengubah data produk'
            ]);
            $this->reset('edit_product_id', 'edit_product_code', 'edit_product_name', 'edit_product_description', 'edit_product_stock', 'edit_product_price');
        }
    }

    public function deleteWindow($id){
        $product = Product::findOrFail($id);
        $this->dispatchBrowserEvent('swal:confirm',
            [
                'id' => $id,
                'icon' => 'warning',
                'title' => 'Hapus Kategori',
                'html' => 'Yakin ingin menghapus produk <b>'.$product->name.'</b> ?',
                'showCancelButton' => true,
                'confirmButtonText' => 'Hapus !',
                'confirmButtonColor' => '#435EBE',
                'cancelButtonText' => 'Batal',
            ]);
    }

    public function deleteProduct($id){
        if($id){
            $deleted = Product::where('id', $id)->delete();
            if($deleted){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil meghapus data produk'
                ]);
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal menghapus data produk'
                ]);
            }
        }
    }

    public function render()
    {
        $products = Product::with(['categories'])->paginate(10);
        return view('livewire.product.product-list', compact('products'))
                    ->extends('layouts.dashboard')
                    ->section('content');
    }
}
