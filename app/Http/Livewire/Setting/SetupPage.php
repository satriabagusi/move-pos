<?php

namespace App\Http\Livewire\Setting;

use App\AppSetting;
use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SetupPage extends Component
{

    public $username, $password, $password_confirmation, $shop_name, $shop_address, $shop_phone, $shop_mail, $tax;
    public $step = 1;

    protected $rules = [
        'username' => 'required|min:4|unique:users',
        'password' => 'required|confirmed|min:6',
        'shop_name' => 'required',
        'shop_address' => 'required',
        'shop_phone' => 'nullable',
        'shop_mail' => 'email|nullable',
        'tax' => 'required|min:0|max:100|numeric',
    ];

    protected $messages = [
        'username.required' => 'Username admin kosong.',
        'username.min' => 'Minimal 4 karakter untuk username',
        'username.unique' => 'Username sudah terpakai',
        'password.required' => 'Password kosong',
        'password.confirmed' => 'Password konfirmasi tidak sama',
        'password.min' =>'Minimal 6 karakter untuk password',
        'shop_name.required' => 'Nama Toko kosong.',
        'shop_address.required' => 'Alamat Toko kosong.',
        'shop_mail.email' => 'E-mail toko tidak sesuai. cth : tokoku@email.com',
        'tax.required' => 'Pajak transaksi kosong',
        'tax.min' => 'Pajak transaksi kurang dari 0%',
        'tax.max' => 'Pajak transaksi lebih dari 100%',
        'tax.numeric' => 'Format pajak transaksi tidak sesuai',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function saveConfig(){
        $this->validate();
        $phone = str_replace('+62', '', $this->shop_phone);
        $username = $this->username;
        // dd($this->username);
        $insertUser = User::create([
            'username' => $username,
            'name' => 'Administrator',
            'password' => Hash::make($this->password),
            'user_role_id' => '1'
        ]);

        $insert = AppSetting::create([
            'shop_name' => $this->shop_name,
            'shop_address' => $this->shop_address,
            'shop_phone' => $phone,
            'shop_mail' => $this->shop_mail,
            'tax' => $this->tax
        ]);

        if(!$insert || !$insertUser){
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal menyimpan pengaturan awal.'
            ]);
            $this->reset('shop_name', 'shop_address', 'shop_phone', 'shop_mail', 'tax');
        }else{
            $this->reset('shop_name', 'shop_address', 'shop_phone', 'shop_mail', 'tax');
            session()->flash('message', 'Berhasil menyimpan pengaturan awal');
            return redirect()->to('/');
        }
    }

    public function setStep($step){
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.setting.setup-page')
                ->extends('layouts.home')
                ->section('content');
    }
}
