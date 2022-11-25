@section('page-title', 'Tambah Akun Pegawai')
@section('pegawai', 'active')
@section('akun-pegawai', 'active')

<div>
    <div class="card">
        <div class="card-body">
            <div wire:target="employees">
                <div class="row justify-content-around">
                    <div class="col-3 mb-4">
                        <img src="{{asset('images/logo/user1.png')}}" class="img-fluid">
                    </div>
                    <div class="col-6">
                        <form wire:submit.prevent="addEmployee">
                            <div class="form-group">
                                <label for="name">Nama Pegawai</label>
                                <input type="text" class="form-control @error('employee_name')
                                    is-invalid
                                @enderror" wire:model='employee_name'>
                                @error('employee_name')
                                    <span class='text-danger muted'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('employee_username')
                                    is-invalid
                                @enderror" wire:model='employee_username'>
                                @error('employee_username')
                                    <span class='text-danger muted'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('employee_email')
                                    is-invalid
                                @enderror" wire:model='employee_email'>
                                @error('employee_email')
                                    <span class='text-danger muted'>{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group position-relative has-icon-right">
                                <label for="password">Password</label>
                                <input type="password" class="password form-control  @error('employee_password')
                                    is-invalid
                                @enderror" wire:model='employee_password'>
                                @error('employee_password')
                                    <span class='text-danger muted'>{{ $message }}</span>
                                @enderror
                                <div class="form-control-icon  mt-2">
                                    <i class="show-password bi bi-eye"></i>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class=" btn btn-info" wire:click='generatePassword'>
                                Generate Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.show-password', function(){
                $('.password').attr('type', 'text');
                $(this).addClass('text-primary')
            })

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
        })
    </script>

@endpush
