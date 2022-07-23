@section('title', 'Transaksi Baru')
@section('page-title', 'Transaksi Baru')
@section('page-subtitle', 'Transaksi Baru')
@section('transaksi', 'active')


<div>

    <div class="row justify-content-between container-fluid">
        <div class="col-12 col-md-6 col-xs-12 p-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-group position-relative has-icon-right">
                        <input wire:model="search" type="text" class="form-control" placeholder="Cari nama barang/scan barcode">
                        <div class="form-control-icon">
                            @if ($search)
                            <span wire:ignore>
                                <i class="bi bi-x-circle text-danger" wire:click="$set('search', '')"></i>
                            </span>
                            @else
                                <i class="bi bi-upc-scan"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row scroll rounded">
                @forelse ($products as $item)
                    <div class="col-lg-6 col-6 col-md-6 col-sm-6">
                        <div class="card mb-3 mx-auto shadow h-80" wire:click="addToCart({{$item->id}})">
                            <div class="card-content mx-0 px-0">
                                <img class="card-img-top img-fluid" src="{{asset('images/illustrations/product.png')}}" alt="{{$item->name}}" />
                                <div class="card-body">
                                    <h6 class="fs-6 card-title">{{$item->name}}</h6>
                                    <p class="card-text ">
                                        {{$item->description}}
                                    </p>

                                    <span class="text-success fw-bold">
                                        Rp. {{number_format($item->price, 0, ',', '.')}},-
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <img src="{{asset('images/illustrations/empty.svg')}}" class="img-fluid mx-auto mt-5" alt="" width="150px">
                    <h1 class="display-5 text-center text-white">Belum ada data Produk !</h1>
                @endforelse
            </div>
        </div>
            @include('livewire.transaction._cart')
    </div>

    <div wire:ignore.self class="modal fade" id="discVoucherModal" tabindex="-1" role="dialog" aria-labelledby="discVoucherModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discVoucherModalTitle">Daftar Diskon Tersedia
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        @foreach ($vouchers as $item)
                        <div class="col-lg-4 col-8 col-sm-8 mb-3">
                            <div class="card border
                            @if ($item->status == 1)
                                border-success
                            @else
                                border-secondary
                            @endif
                            text-center h-100">
                                <div class="card-body">
                                    <p class="fw-bold fs-5">
                                        {{$item->code}}
                                    </p>
                                    <p class="small">
                                        {{$item->description}}
                                    </p>
                                </div>
                                <div class="card-footer border-top-0" style="margin-top: -50px">
                                    @if ($item->status == 1)
                                        <button class="btn btn-block btn-sm btn-outline-success" wire:click="applyVoucher({{$item->id}})">Apply</button>
                                    @else
                                        <button class="btn btn-block btn-sm btn-secondary" disabled>Apply</button>
                                    @endif

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('menu')
    <nav class="navbar fixed-bottom navbar-expand bg-light">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo.png')}}" alt="">
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item me-2">
                <a class=" btn btn-outline-primary" href="{{URL::to('/')}}">
                    <i class="bi bi-house"></i>
                    Home
                </a>
              </li>
              <li class="nav-item">
                <a class=" btn btn-primary me-2" href="{{URL::to('/transaksi')}}">
                    <i class="bi bi-cart4"></i>
                    Transaksi
                </a>
              </li>
              <li class="nav-item">
                <a class=" btn btn-outline-primary" href="{{URL::to('/produk/data-produk')}}">
                    <i class="bi bi-clipboard-data"></i>
                    Produk
                </a>
              </li>
            </ul>
          </div>

          <div class="dropup">
            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-menu d-flex">
                    <div class="user-name text-end me-3">
                        <h6 class="mb-0 text-gray-600">{{Auth::user()->name}}</h6>
                        <p class="mb-0 text-sm text-gray-600">{{Auth::user()->user_roles->role_name}}</p>
                    </div>
                    <div class="user-img d-flex align-items-center">
                        <div class="avatar avatar-md">
                            <img src="{{asset('images/faces/1.jpg')}}">
                        </div>
                    </div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                <li>
                    <h6 class="dropdown-header">Hello, {{Auth::user()->name}}!</h6>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                    <i class="icon-mid bi bi-person me-2"></i>My Profile</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                        Logout</a>
                </li>
            </ul>
        </div>


        </div>
      </nav>

      @include('livewire.transaction._modal')
@endpush

@push('script')
        <script>
            window.addEventListener('message', e => {
                if(e.detail.status == 200){
                    Toastify({
                        text: e.detail.message,
                        duration: 1500,
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
                        duration: 1500,
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
            window.livewire.on('hideModal', () => {
                $('#discVoucherModal').modal('hide');
            });

            window.livewire.on('showResiModal', () => {
                $('#modalResiTransaksi').modal('show');
            });

            $('.money-pay').mask("#.##0", {reverse: true});
        </script>
@endpush
