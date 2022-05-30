<?php

namespace App\Http\Livewire\Discount;

use App\Discount;
use Livewire\Component;

class DiscountVoucher extends Component
{
    public $code, $percentage, $type, $description, $statusLabel;
    public $status = true;
    public $edit_id_voucher, $edit_code, $edit_percentage, $edit_type, $edit_description, $edit_status;

    protected $listeners = [
        'deleteVoucher',
    ];

    protected $rules = [
        'code' => 'required',
        'percentage' => 'required',
        'description' => 'required'
    ];

    protected $messages = [
        'code.required' => 'Kode Voucher Potongan/Diskon kosong.',
        'percentage.required' => 'Potongan/diskon kosong',
        'description.required' => 'Deskripsi Potongan/Diskon kosong',

    ];

    public function mount(){
        $this->type = 1;
        if($this->status == true){
            $this->statusLabel == "Aktif";
        }else if($this->status == false){
            $this->statusLabel == "Non-aktif";
        }
    }

    public function updated($propertName){
        $this->validateOnly($propertName);
    }

    public function generateCode(){
        $codeString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 4);
        $codeNumber = substr(str_shuffle('0123456789'), 1, 2);
        $code = $codeString.$codeNumber;
        $this->code = $code;
        $this->edit_code = $code;
    }

    public function updatedStatus(){
        $this->percentage ="";
        if($this->status == true){
            $this->statusLabel == "Aktif";
        }else if($this->status == false){
            $this->statusLabel == "Non-aktif";
        }
    }

    public function saveVoucher(){
        $validatedData = $this->validate();

        if($this->type == 1){
            $percentage = str_replace(".", "", $this->percentage);
        }elseif($this->type == 2){
            $percentage = $this->percentage;
        }

        if($validatedData) {
            $insert = Discount::create([
                'code' => $this->code,
                'type' => $this->type,
                'percentage' => $percentage,
                'description' => $this->description,
                'status' => $this->status,
            ]);

            if($insert){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil menambahkan kode diskon/potongan'
                ]);
                $this->reset('code', 'percentage', 'description');
                $this->emitTo('transaction.transaction', 'updateVoucher');
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal menambahkan kode diskon/potongan'
                ]);
                $this->reset('code', 'percentage', 'description');
            }
        }
    }

    public function editVoucher($id){
        $editVoucher = Discount::where('id', $id)->first();
        $this->edit_id_voucher = $id;
        $this->edit_code = $editVoucher->code;
        $this->edit_percentage = $editVoucher->percentage;
        $this->edit_type = $editVoucher->type;
        $this->edit_description = $editVoucher->description;
        if($editVoucher->status == 1){
            $this->edit_status = true;
        }elseif($editVoucher->staus == 2){
            $this->edit_status = false;
        }

    }

    public function updateVoucher(){

        if($this->edit_type == 1){
            $percentage = str_replace(".", "", $this->edit_percentage);
        }elseif($this->edit_type == 2){
            $percentage = $this->edit_percentage;
        }

        $voucher = Discount::where('id', $this->edit_id_voucher)->update([
            'code' => $this->edit_code,
            'percentage' => $percentage,
            'type' => $this->edit_type,
            'status' => $this->edit_status,
            'description' => $this->edit_description
        ]);

        if($voucher){
            $this->dispatchBrowserEvent('message', [
                'status' => 200 ,
                'message' => 'Berhasil mengubah detail diskon/potongan'
            ]);
            $this->reset('code', 'percentage', 'description');
            $this->emitTo('transaction.transaction', 'updateVoucher');
        }else{
            $this->dispatchBrowserEvent('message', [
                'status' => 100 ,
                'message' => 'Gagal mengubah detail diskon/potongan'
            ]);
            $this->reset('code', 'percentage', 'description');
        }
    }

    public function deleteWindow($id){
        $voucher = Discount::findOrFail($id);
        $this->dispatchBrowserEvent('swal:confirm',
            [
                'id' => $id,
                'icon' => 'warning',
                'title' => 'Hapus Kode Diskon',
                'html' => 'Yakin ingin menghapus diskon <b>'.$voucher->code.'</b> ?',
                'showCancelButton' => true,
                'confirmButtonText' => 'Hapus !',
                'confirmButtonColor' => '#435EBE',
                'cancelButtonText' => 'Batal',
            ]);
    }

    public function deleteVoucher($id){
        if($id){
            $deleted = Discount::where('id', $id)->delete();
            if($deleted){
                $this->dispatchBrowserEvent('message', [
                    'status' => 200 ,
                    'message' => 'Berhasil meghapus kode diskon'
                ]);
                $this->emitTo('transaction.transaction', 'updateVoucher');
            }else{
                $this->dispatchBrowserEvent('message', [
                    'status' => 100 ,
                    'message' => 'Gagal menghapus kode diskon'
                ]);
            }
        }
    }

    public function render()
    {
        $coupons = Discount::paginate(10);
        return view('livewire.discount.discount-voucher', compact('coupons'))
                ->extends('layouts.dashboard')
                ->section('content');
    }
}
