@section('page-title', 'Laporan')
@section('page-subtitle', 'Laporan Produk')
@section('laporan', 'active')
@section('laporan-produk', 'active')

<div>
    <div class="card">
        <div class="card-header">
            Laporan Produk Keluar
        </div>
        <div class="card-body">
            @if (count($product_out) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else
            <div wire:target="products">
                <table class="table table-hover table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th wire:ignore width="30%">Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Yang Menjual</th>
                            <th>Tanggal Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_out as $po)
                            @foreach ($po->order_details as $item)
                            <tr>
                                <td>
                                {{$loop->iteration}}
                                </td>
                                <td >
                                    <span >{{$item->products->name}}</span>
                                </td>
                                <td >
                                    <span >{{$item->quantity}}</span>
                                </td>
                                <td >
                                    <span >{{$po->users->name}}</span>
                                </td>
                                <td>
                                    <span >{{ date_format($item->created_at, "d-M-Y")}}</span>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach

                    </tbody>
                </table>
                <div class="float-end">
                    {{$product_out->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>


</div>

