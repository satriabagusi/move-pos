<?php

namespace App\Http\Livewire\Employee;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EmployeeAccount extends Component
{

    public $employee_name, $employee_username, $employee_password, $employee_email;

    protected $rules = [
        'employee_name' => 'required',
        'employee_username' => 'required|max:12',
        'employee_password' => 'alpha_num',
        'employee_email' => 'email|nullable'
    ];

    protected $messages = [
        'employee_name.required' => 'Nama Pegawai tidak boleh kosong.',
        'employee_username.required' => 'Username Pegawai tidak boleh kosong.',
        'employee_username.max' => 'Username Pegawai maksimal 12 karakter.',
        'employee_password.alpha_num' => 'Password Pegawai harus berupa karakter dan angka',
        'employee_email.email' => 'Format email Pegawai tidak sesuai.',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function generatePassword(){
        $this->employee_password = "";
        $alphabet = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $generatedPassword = substr(str_shuffle($alphabet),0,7);
        $this->employee_password = $generatedPassword;
    }

    public function addEmployee(){

        $insertEmployee = User::create([
            'name' => $this->employee_name,
            'username' => $this->employee_username,
            'password' => Hash::make($this->employee_password),
            'email' => $this->employee_email,
            'user_role_id' => 2,
        ]);

        if($insertEmployee){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil menambahkan akun Pegawai'
            ]);
            $this->reset('employee_name', 'employee_username', 'employee_password', 'employee_email');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal  menambahkan akun Pegawai'
            ]);
            $this->reset('employee_name', 'employee_username', 'employee_password', 'employee_email');
        }
    }

    public function render()
    {
        if (Auth::user()->user_role_id == 1) {
            return view('livewire.employee.employee-account')
                    ->extends('layouts.dashboard')
                    ->section('content');
        }else{
            return abort(403, "You're not allowed access this page!");
        }

    }
}
