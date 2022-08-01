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


    <div wire:ignore.self class="modal fade" id="printResiModal" tabindex="-1" role="dialog" aria-labelledby="printResiModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printResiModalTitle">Daftar Diskon Tersedia
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body modal-body-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-12 bg-light">
                            <div class="invoice p-3 mb-3" id="section-to-print">

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
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary print">Print</button>
                </div>
            </div>
        </div>
    </div>
