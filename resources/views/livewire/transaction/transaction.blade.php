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
                    <div class="col-lg-4 col-6 col-md-6 col-sm-6">
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
        <div class="col-12 col-md-6 col-xs-12 card shadow mt-1" style="max-height: 800px; height: 800px">

            <div class="card-body scroll">
            <h4 class="mt-1">Rincian Pesanan</h4>
            <div class="row p-0 border-top border-bottom">
                <div class="col-5">
                    <span class="fw-bold">Produk</span>
                </div>
                <div class="col-3">
                    <span class="fw-bold">Quantity</span>
                </div>
                <div class="col-4">
                    <span class="fw-bold">Subtotal</span>
                </div>

            </div>
            <div class="row ">
                @foreach ($cart as $item)
                <div class="row p-0 mb-2 border-bottom">
                    <div class="col-5">
                        <div class="row">
                            <div class="col-auto">
                                <span>{{$item['name']}}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <span class="text-muted" style="font-size: 14px">@Rp. {{number_format($item['price'], 0, ',' , '.')}}</span>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-group-sm">
                                    <button wire:click="decreaseItem({{$item['id']}}, {{$item['quantity']}})" class="btn btn-outline-danger btn-sm " type="button">-</button>
                                    <input type="text" class="form-control form-control-sm text-center" placeholder="Quantity" value="{{$item['quantity']}}" readonly>
                                    <button wire:click="increaseItem({{$item['id']}}, {{$item['quantity']}})" class="btn btn-outline-primary btn-sm " type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row mt-3 justify-content-end">
                            <div class="col-9">
                                <span class="fs-6" style="font-size: 14px">Rp. {{number_format($item['price']*$item['quantity'], 0, ',' , '.')}}</span>
                            </div>
                            <div class="col-3">
                                <a class="link-danger" wire:click="deleteItem({{$item['id']}})" href=""><i class="bi bi-x-circle"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-4">
                        <p>Subtotal :</p>
                    </div>
                    <div class="col-3 col-lg-4 ">
                        <span class="fw-bold text-success">Rp. {{number_format($totalTransaction, 0, ',', '.')}}</span>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-4">
                        <p>Pajak {{$tax}}%</p>
                    </div>
                    <div class="col-3 col-lg-4">
                        <span class="fw-bold">Rp. {{number_format($totalTransaction*$tax/100, 0, ',', '.')}}</span>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-4">
                        <p>Kupon :</p>
                    </div>
                    <div class="col-3 col-lg-4">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control text-center" placeholder="Kupon" wire:model="voucherCode"
                            @if ($voucherCode)
                                readonly
                            @endif
                            data-bs-toggle="modal"
                            data-bs-target="#discVoucherModal"
                            >
                            <button wire:ignore class="btn btn-danger" type="button" wire:click="$set('voucherCode', '')">X</button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mb-2">
                    <div class="col-3 col-lg-4">
                        Diskon :
                    </div>
                    <div class="col-3 col-lg-4">
                        <span class="fw-bold">-{{number_format($discount, 0, ',', '.')}}</span>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-4 fw-bold">
                        Total :
                    </div>
                    <div class="col-3 col-lg-4">
                        <span class="fw-bold">Rp. {{number_format($subTotal, 0, ',', '.')}}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 mb-sm-2">
                        <button wire:click="checkoutCart" class="btn btn-block btn-success">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
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
                <a class=" btn btn-primary" href="{{URL::to('/transaksi')}}">
                    <i class="bi bi-cart4"></i>
                    Transaksi
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
        </script>
@endpush
