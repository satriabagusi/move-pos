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
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                    </tr>
                </thead>
            <tbody>
                @forelse ($this->cart as $item => $it)
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
                        @if ($this->tax == 0)
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
