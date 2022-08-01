<div class="row p-2 bg-white mt-5 mx-3">
    <div class="col-6 bg-light">
        <div class="invoice p-3 mb-3">

            <div class="row">
                <div class="col-12">
                    <h4 class="text-center">{{$appSetting->shop_name}}</h4>
                </div>
                <div class="col-12">
                    <p class="text-center">{{$appSetting->shop_address}}</p>
                </div>
                <div class="col-12">
                    <p class="text-center">{{$appSetting->shop_phone ? $appSetting->shop_phone : ""}}</p>
                </div>
            </div>

            <div class="row justify-content-between pt-2" style="border-top-style: dashed">
                <div class="col-sm-auto">
                    <p>Invoice : <span class="fw-bold">{{$this->invoice_no}}</span></p>
                </div>
                <div class="col-sm-auto">
                    <p>Kasir : {{Auth::user()->name}}</p>
                </div>
            </div>


            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                    <tbody>
                        @forelse ($this->cart_resi as $item => $it)
                            <tr>
                                <td>{{$it['name']}}</td>
                                <td>{{number_format($it['price'], 0, ",", ".")}}</td>
                                <td>{{$it['quantity']}}</td>
                                <td>{{number_format(($it['quantity']*$it['price']), 0, ",", ".")}}</td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                    </table>
                </div>

            </div>

            <div class="row justify-content-between">

                <div class="col-4">
                </div>

                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal : </th>
                                    <td>{{"Rp. ".number_format($totalTransaction, 0, ',', '.')}}</td>
                                </tr>
                                @if ($this->tax > 0)
                                <tr>
                                    <th>Pajak ({{$tax}}%)</th>
                                    <td>{{"Rp. ".number_format($totalTransaction*$tax/100, 0, ',', '.')}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Total:</th>
                                    <td>{{"Rp. ".number_format($subTotal, 0, ',', '.')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            </div>
    </div>
    <div class="col-6">
        <div class="card-body scroll">
            <h4 class="mt-1 text-center">Pembayaran</h4>
            <div class="row py-5 border-top">
                <div class="text-center">
                    <p class="fw-bold">Jumlah yang harus dibayarkan :</p>
                    <h2>{{"Rp. ".number_format($subTotal, 0, ",", ".")}}</h2>
                </div>
                <div class="form-group">
                    <label for="">Uang yang dibayarkan :</label>
                    <div class="input-group mb-3 mt-4">
                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                        <input type="text" id="total_pay" class="text-center form-control form-control-lg total_pay" autofocus wire:ignore.self wire:model='total_pay'>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    <button class="btn btn-sm btn-outline-primary">20.000</button>
                    <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '50.000')">50.000</button>
                    <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '100.000')">100.000</button>
                    <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '200.000')">200.000</button>
                    <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '500.000')">500.000</button>
                </div>
                <div class="form-group text-center mt-4">
                    <button class="btn btn-outline-primary btn-lg" wire:click="$set('sectionCond', 0)">Kembali</button>
                    <button class="btn btn-success btn-lg " wire:click="checkoutCart">Bayar</button>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <h5>Kembali :</h5>
            <h3>Rp. {{number_format($pay_change, 0, ",", ".")}}</h3>
        </div>
    </div>
</div>
