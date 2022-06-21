@section('page-title', 'Pengaturan')
@section('page-subtitle', 'Pengaturan Akun')
@section('pengaturan', 'active')
@section('pengaturan-akun', 'active')


<div>
    <div class="card">
        <div class="card-header">
            <span class="fs-4">Pengaturan Akun</span>
        <hr>
        </div>
        <div class="card-body">

            <form class="form form-horizontal">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" id="name" class="form-control @error('name')
                                is-invalid
                            @enderror" placeholder="Nama" wire:model="name"
                            @if ($editMode == false)
                                readonly
                            @endif
                            >
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Username</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea type="text" id="username" class="form-control @error('username')
                                is-invalid
                            @enderror" placeholder="Username" wire:model="username"
                            @if ($editMode == false)
                                readonly
                            @endif
                            ></textarea>
                            @error('username')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Password (*</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="password" id="password" class="form-control @error('password')
                                is-invalid
                            @enderror" placeholder="Password" wire:model="password"
                            @if ($editMode == false)
                                readonly
                            @endif
                            >
                            <small class="text-muted">*Kosongkan password jika tidak ingin di ubah</small>
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label>Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" id="email" class="form-control @error('email')
                                is-invalid
                            @enderror" placeholder="Email" wire:model="email"
                            @if ($editMode == false)
                                readonly
                            @endif
                            >
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <div class="card-footer border-top-0">
            @if ($editMode == true)
                <button type="button" class="rounded float-end btn btn-sm icon icon-left btn-success" wire:click="save_settings">
                    <span >
                        <i data-feather="check"></i> Simpan Perubahan
                    </span>
                </button>
            @elseif($editMode == false)
                <button type="button" class="rounded float-end btn btn-sm icon icon-left btn-outline-primary" wire:click="edit_mode" >
                    <span >
                        <i data-feather="edit"></i> Ubah Detail Akun
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


            $(document).ready(function(){
                $('#shop_phone').mask('000-0000-0000');
            })
        </script>
@endpush
