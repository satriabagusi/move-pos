@section('page-title', 'Transaksi Baru')
@section('page-subtitle', 'Transaksi Baru')
@section('transaksi', 'active')


<div>

    <div class="row">
        <div class="col-12 col-md-7 col-xs-12 py-2">
            <div class="row scroll">
                @forelse ($products as $item)
                    <div class="col-lg-3 col-6 col-md-6 col-sm-6 mb-3">
                        <div class="card shadow h-100" wire:click="addToCart({{$item->id}})">
                            <div class=" ribbon ribbon-end">
                                <div class="ribbon-label bg-warning text-black">
                                    <span class="fw-bold">
                                        Rp. {{number_format($item->price, 0, ',', '.')}}
                                    </span>
                                </div>

                            </div>
                            <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{asset('images/illustrations/product.png')}}" alt="{{$item->name}}" />
                                <div class="card-body">
                                    <h5 class="fs-6 card-title">{{$item->name}}</h5>
                                    <p class="card-text ">
                                        {{$item->description}}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <img src="{{asset('images/illustrations/empty.svg')}}" class="img-fluid mx-auto" alt="" width="150px">
                    <h1 class="display-5 text-center">Belum ada data Produk !</h1>
                @endforelse
            </div>
        </div>
        <div class="col-12 col-md-5 col-xs-12 card shadow mt-1" style="max-height: 800px">
            <div class="card-header">
                <div class="divider">
                    {{-- <div class="fw-bold divider-text">Keranjang</div> --}}
                </div>
                <div class="row">
                    <div class="col-2">
                        No.
                    </div>
                    <div class="col-3">
                        Produk
                    </div>
                    <div class="col-3">
                        Qty
                    </div>
                    <div class="col-3">
                        Total
                    </div>
                    <div class="col-1">
                    </div>
                </div>
                <hr>
            </div>
            <div class="card-body scroll">
            <div class="row ">
                @foreach ($cart as $item)
                <div class="row mb-2">
                    <div class="col-2">
                        <p class="fw-bold">{{$loop->iteration}}.</p>
                    </div>
                    <div class="col-3">
                        <span>{{$item['name']}}</span>
                        <br>
                        <span class="text-muted" style="font-size: 14px">Rp. {{number_format($item['price'], 0, ',' , '.')}}</span>
                    </div>
                    <div class="col-3">
                        <div class=" input-group input-group-sm">
                            <button wire:click="decreaseItem({{$item['id']}}, {{$item['quantity']}})" class="btn btn-outline-danger" type="button">-</button>
                            <input type="text" class="form-control text-center bg-light" placeholder="Quantity" value="{{$item['quantity']}}" width="50px" readonly>
                            <button wire:click="increaseItem({{$item['id']}}, {{$item['quantity']}})" class="btn btn-outline-primary" type="button">+</button>
                        </div>
                    </div>
                    <div class="col-3">
                        <p>Rp. {{number_format($item['price']*$item['quantity'], 0, ',', '.')}}</p>
                    </div>
                    <div class="col-1">
                        <button wire:click="deleteItem({{$item['id']}})" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-4">
                        <p>Total :</p>
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
                    <div class="col-3 col-lg-5">
                        <div class=" input-group input-group-sm">
                            <input type="text" class="form-control text-center" placeholder="Kupon">
                            <button class="btn btn-outline-primary" type="button">Apply</button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-3 col-lg-4">
                        Subtotal :
                    </div>
                    <div class="col-3 col-lg-4">
                        <span class="fw-bold">Rp. {{number_format(($totalTransaction*$tax/100)+($totalTransaction), 0, ',', '.')}}</span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 mb-sm-2">
                        <button class="btn btn-block btn-secondary">Daftar Kupon</button>
                    </div>
                    <div class="col-12 mb-sm-2">
                        <button wire:click="checkoutCart" class="btn btn-block btn-success">Checkout</button>
                    </div>
                </div>
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
        </script>
@endpush
