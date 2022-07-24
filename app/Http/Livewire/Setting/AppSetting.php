<?php

namespace App\Http\Livewire\Setting;

use App\AppSetting as App_Setting;
use Livewire\Component;

class AppSetting extends Component
{

    public $shop_name, $shop_address, $shop_email, $shop_phone, $tax;
    public $editMode = false;
    public $disc_mode = false;

    protected $rules = [
        'shop_name' => 'required',
        'shop_address' => 'required',
        'shop_email' => 'email',
        'tax' => 'required|min:0|max:100|numeric',
    ];

    protected $messages = [
        'shop_name.required' => 'Nama Toko kosong.',
        'shop_address.required' => 'Alamat Toko kosong.',
        'shop_email.email' => 'E-mail toko tidak sesuai. cth : tokoku@email.com',
        'tax.required' => 'Pajak transaksi kosong',
        'tax.min' => 'Pajak transaksi kurang dari 0',
        'tax.max' => 'Pajak transaksi lebih dari 100',
        'tax.numeric' => 'Format pajak transaksi tidak sesuai',
    ];

    public function updated($propertName){
        $this->validateOnly($propertName);
    }

    public function mount(){
        $settings = App_Setting::first();
        // dd($settings);
        if(!$settings){
            $this->edit_mode = true;
        }else{
            $this->shop_name = $settings->shop_name;
            $this->shop_address = $settings->shop_address;
            $this->shop_email = $settings->shop_mail;
            $this->shop_phone = $settings->shop_phone;
            $this->tax = $settings->tax;
        }
    }

    public function edit_mode(){
        $this->editMode = true;
    }

    public function updatedDiscMode($value){
        return $value;
    }

    public function save_settings(){
        $settings = App_Setting::first();
        if(!$settings){
            $save = App_Setting::create([
                'shop_name' => $this->shop_name,
                'shop_address' => $this->shop_address,
                'shop_mail' => $this->shop_email,
                'shop_phone' => $this->shop_phone,
                'tax' => $this->tax,
            ]);
        }else{
            $save = App_Setting::where('id', 1)->update([
                'shop_name' => $this->shop_name,
                'shop_address' => $this->shop_address,
                'shop_mail' => $this->shop_email,
                'shop_phone' => $this->shop_phone,
                'tax' => $this->tax,
            ]);
        }
        if($save){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil memperbaharui pengaturan'
            ]);
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal memperbaharui pengaturan'
            ]);
        }

        $this->editMode = false;
    }

    public function render()
    {
        $setting = AppSetting::all();
        return view('livewire.setting.app-setting', compact('setting'))
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
