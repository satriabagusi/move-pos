@section('page-title', 'Pengaturan')
@section('page-subtitle', 'Pengaturan Aplikasi')
@section('pengaturan', 'active')
@section('pengaturan-aplikasi', 'active')


<div>
    <div class="card">
        <div class="card-header">
            <span class="fs-4">Pengaturan Aplikasi</span>
        <hr>
        </div>
        <div class="card-body">

            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Toko</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="shop_name" class="form-control @error('shop_name')
                                is-invalid
                            @enderror" placeholder="Nama Toko" wire:model="shop_name"
                            @if ($editMode == false)
                                readonly
                            @endif
                            >
                            @error('shop_name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea type="text" id="shop_address" class="form-control @error('shop_address')
                                is-invalid
                            @enderror" placeholder="Alamat" wire:model="shop_address"
                            @if ($editMode == false)
                                readonly
                            @endif
                            ></textarea>
                            @error('shop_address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Email Toko</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="shop_email" class="form-control @error('shop_email')
                                is-invalid
                            @enderror" placeholder="Email" wire:model="shop_email"
                            @if ($editMode == false)
                                readonly
                            @endif
                            >
                            @error('shop_email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>No Telp Toko</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" id="shop_phone" class="form-control @error('shop_phone')
                                is-invalid
                                @enderror" placeholder="No Telp" wire:model="shop_phone"
                                @if ($editMode == false)
                                readonly
                                @endif
                                >
                                @error('shop_phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Pajak Transaksi</label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <div class="input-group">
                                <input type="text" maxlength="4" max="100" id="tax" class="form-control @error('tax')
                                    is-invalid
                                @enderror" placeholder="Pajak Transaksi" wire:model="tax"
                                @if ($editMode == false)
                                    readonly
                                @endif
                                >
                                <span class="input-group-text">%</span>
                            </div>
                            <small>*Non aktifkan pajak transaksi dengan mengisi pajak transaksi dengan angka 0</small>
                            @error('tax')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="">Fitur Diskon</label>
                        </div>
                        <div class="col-md-8 form-group ">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="disc_mode">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="card-footer border-top-0">
            @if ($editMode == true)
                <button type="button" class="rounded float-end btn btn-sm icon icon-left btn-success" wire:click="save_settings">
                    <span >
                        <i data-feather="check"></i> Simpan Pengaturan
                    </span>
                </button>
            @elseif($editMode == false)
                <button type="button" class="rounded float-end btn btn-sm icon icon-left btn-outline-primary" wire:click="edit_mode" >
                    <span >
                        <i data-feather="edit"></i> Ubah Pengaturan
                    </span>
                </button>
            @endif
        </div>
    </div>

</div>


@push('script')
        <script>
            window.addEventListener('message', e => {
                if(e.detail.status == 200){
                    Toastify({
                        text: e.detail.message,
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#00b09b",
                        }
                    }).showToast();
                }else if(e.detail.status == 100){
                    Toastify({
                        text: e.detail.message,
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "#DC3545",
                        }
                    }).showToast();
                }
            })

            window.addEventListener('swal:confirm', function(e){
                Swal.fire(e.detail)
                .then((result) => {
                    if(result.isConfirmed) {
                        window.livewire.emit('deleteProduct', e.detail.id);
                    }
                });
            });

            $(document).ready(function(){
                $('#shop_phone').mask('000-0000-0000');
            })
        </script>
@endpush
