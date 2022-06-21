<?php

namespace App\Http\Livewire\Setting;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AccountSetting extends Component
{

    public $editMode = false;
    public $username, $name, $paasword, $email;

    public function mount(){
        $this->username = Auth::user()->username;
        $this->name = Auth::user()->name;
        $this->password = Auth::user()->password;
        $this->email = Auth::user()->email;
    }

    public function edit_mode(){
        $this->editMode = true;
        $this->password = "";
    }

    public function save_settings(){
        $id = Auth::user()->id;
        if($id){

            $update = User::where('id', $id)->update([
                'name' => $this->name,
                'username' => $this->username,
                'password' => Hash::make($this->password),
                'email' => $this->email,
            ]);

            if($update){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil memperbaharui profil'
                ]);
                $this->editMode = false;
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal memperbaharui pengaturan'
                ]);
                $this->editMode = false;
            }
        }
    }

    public function render()
    {
        return view('livewire.setting.account-setting')
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
