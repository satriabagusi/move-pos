@section('page-title', 'Akun Pegawai')
@section('pegawai', 'active')
@section('akun-pegawai', 'active')

<div>
    <div class="card">
        <div class="card-body">
            <div wire:target="employees">
                <div class="row justify-content-end">
                    <div class="col-3 mb-4">
                    <img src="{{asset('images/logo/user1.png')}}" width="250">
                    <form>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Nama Pegawai</label>
                                <input type="text" class="form-control" disabled value={{Auth::user()->name}} >
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" disabled value={{Auth::user()->username}} disbaled>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" disabled value={{Auth::user()->name}} disbaled>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-warning">Edit</button>
                    </div>
                    <div class="col-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
