@section('title', 'Setup Aplikasi')

<div>

    <div class="row mt-5 h-100 justify-content-center">

        <div class="card bg-white col-12 col-lg-7 col-sm-10 rounded">
            <div class="card-header text-center">
                <h3 class="display-4 text-primary fw-bold">Move POS</h3>
            </div>
            <div class="card-body">

                <h1 class="fs-2 text-primary-25">Selamat Datang !</h1>
                <p class="fs-5">Isi konfigurasi sebelum menggunakan Aplikasi ini</p>

                <form wire:submit.prevent="saveConfig">
                @if ($step == 1)
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control  @error('username')
                            is-invalid
                        @enderror" placeholder="Username" wire:model="username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('username')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control  @error('password')
                            is-invalid
                        @enderror" placeholder="Password" wire:model="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control  @error('password_confirmation')
                            is-invalid
                        @enderror" placeholder="Konfirmasi Password" wire:model="password_confirmation">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                        <button type="button" class="btn float-end btn-primary
                        @if ($username == null && $password == null && $password_confirmation == null)
                        disabled
                        @endif
                        " wire:click="setStep(2)">Selanjutnya</button>

                @elseif($step == 2)

                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control  @error('shop_name')
                            is-invalid
                        @enderror" placeholder="Nama Toko" wire:model="shop_name">
                        <div class="form-control-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        @error('shop_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <textarea type="text" class="form-control  @error('shop_address')
                        is-invalid
                    @enderror" placeholder="Alamat Toko" wire:model="shop_address">
                        </textarea>
                        <div class="form-control-icon">
                            <i class="bi bi-signpost-split"></i>
                        </div>
                        @error('shop_address')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" id="shop_phone" class="form-control  @error('shop_phone')
                        is-invalid
                    @enderror" placeholder="No Telp Toko" wire:model="shop_phone">
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                        @error('shop_phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" class="form-control  @error('shop_mail')
                        is-invalid
                    @enderror" placeholder="E-mail Toko" wire:model="shop_mail">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        @error('shop_mail')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" id="tax" class="form-control  @error('tax')
                        is-invalid
                    @enderror" placeholder="Pajak Transaksi" wire:model="tax">
                        <div class="form-control-icon">
                            <i class="bi bi-percent"></i>
                        </div>
                        @error('tax')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-warning" wire:click="setStep(1)">Kembali</button>
                        <button type="Submit" class="btn btn-primary">Simpan</button>
                    </div>
                @endif
                </form>




            </div>
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

        $(document).ready(function(){
            $('#shop_phone').mask('+62 000 0000 0000');
            $('#tax').mask('###', {reverse: true});

        })
        var stepper3

        stepper3 = new Stepper(document.querySelector('#stepper3'), {
            linear: false,
            animation:true
        })
    </script>
@endpush
