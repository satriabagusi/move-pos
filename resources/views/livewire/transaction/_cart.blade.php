<div class="col-12 col-lg-5 col-md-6 col-xs-12 card shadow mt-1" style="max-height: 800px; height: 800px">

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
        @if ($this->tax > 0)
        <div class="row justify-content-between">
            <div class="col-3 col-lg-4">
                <p>Pajak {{$tax}}%</p>
            </div>
            <div class="col-3 col-lg-4">
                <span class="fw-bold">Rp. {{number_format($totalTransaction*$tax/100, 0, ',', '.')}}</span>
            </div>
        </div>
        @endif
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
                <button wire:click="$set('sectionCond', 1)" class="btn btn-block btn-success">Bayar</button>
            </div>
        </div>
    </div>
</div>
