@extends('layouts.home')
@section('title', 'Login')
@section('content')
    <div class="row mt-5 h-100 justify-content-center">

        <div class="card bg-white col-12 col-lg-7 col-sm-10 rounded">
            <div class="card-header text-center">
                <h3 class="display-4 text-primary fw-bold">Move POS</h3>
            </div>
            <div class="card-body">

                <h1 class="fs-2 text-primary-25">Login</h1>
                <p class="fs-5">Masukan Username dan Password untuk mengakses aplikasi.</p>

                <form method="POST" action="{{route('post-login')}}">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control  @error('username')
                            is-invalid
                            @enderror" placeholder="Username" name="username">
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
                            @enderror" placeholder="Password" name="password">
                            <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn float-end btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>

    @if (Session::has('error'))
        Toastify({
            text: '{{session('error')}}',
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            style: {
                background: "#DC3545",
            }
        }).showToast();
    @endif

    @if (Session::has('success'))
        Toastify({
            text: '{{session('success')}}',
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "top",
            position: "right",
            style: {
                background: "#DC3545",
            }
        }).showToast();
    @endif
</script>

@endpush
