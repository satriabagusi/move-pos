<?php

namespace App\Http\Livewire\Product;

use App\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCategory extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category_name, $category_description, $edit_category_id, $edit_category_name, $edit_category_description;

    protected $listeners = [
        'deleteCategory',
    ];

    protected $rules = [
        'category_name' => 'required|string',
        'category_description' => 'required'
    ];

    protected $messages = [
        'category_name.required' => 'Nama kategori kosong.',
        'category_name.string' => 'Nama kategori hanya berisikan huruf',
        'category_description.required' => 'Deskripsi kategori kosong'
    ];

    // public function mount(){
    //     $this->categories = Category::all();
    // }

    public function updated($propertName){
        $this->validateOnly($propertName);
    }

    public function saveCategory(){
        // dd($this->category_name);
        $validatedData = $this->validate();
        // dd($validatedData);
        $insert = Category::create([
            'name' => $this->category_name,
            'description' => $this->category_description
        ]);

        if($insert){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil menambahkan kategori produk'
            ]);
            $this->reset('category_name', 'category_description');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal menambahkan kategori produk'
            ]);
            $this->reset('category_name', 'category_description');
        }
    }

    public function editCategory($id){
        $category = Category::findOrFail($id);
        $this->edit_category_id = $id;
        $this->edit_category_name = $category->name;
        $this->edit_category_description = $category->description;
    }

    public function updateCategory(){
        $this->validate(
            [
                'edit_category_name' => 'required|string',
                'edit_category_description' => 'required',
            ], [
                'edit_category_name.required' => 'Nama kategori kosong.',
                'edit_category_name.string' => 'Nama kategori hanya berisikan huruf',
                'edit_category_description.required' => 'Deskripsi kategori kosong'
            ]
        );

        $update = Category::where('id', $this->edit_category_id)
                    ->update([
                        'name' => $this->edit_category_name,
                        'description' => $this->edit_category_description,
                    ]);

        if ($update) {
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil mengubah kategori produk'
            ]);
            $this->reset('edit_category_name', 'edit_category_description');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal mengubah kategori produk'
            ]);
            $this->reset('edit_category_name', 'edit_category_description');
        }

    }

    public function deleteWindow($id){
        $category = Category::findOrFail($id);
        $this->dispatchBrowserEvent('swal:confirm',
            [
                'id' => $id,
                'icon' => 'warning',
                'title' => 'Hapus Kategori',
                'html' => 'Yakin ingin menghapus kategori <b>'.$category->name.'</b> ?',
                'showCancelButton' => true,
                'confirmButtonText' => 'Hapus !',
                'confirmButtonColor' => '#435EBE',
                'cancelButtonText' => 'Batal',
            ]);
    }

    public function deleteCategory($id){
        if($id){
            $deleted = Category::where('id', $id)->delete();
            if($deleted){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil meghapus kategori produk'
                ]);
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal menghapus kategori produk'
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.product.product-category',
                    ['categories' => Category::paginate(10)])
                    ->extends('layouts.dashboard')
                    ->section('content');
    }
}
