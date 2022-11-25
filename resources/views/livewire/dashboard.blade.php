@section('page-title', 'Home Co')
@section('page-subtitle', 'Daftar Kategori Produk')
@section('home', 'active')


<div>

    {{-- @foreach ($product_stock_warn as $item)
    <div class="alert alert-light-warning alert-dismissible show fade">
        {{"Produk ".$item->name." stocknya dibawah 20 ! Harap segera Restock produk kembali"}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endforeach --}}

    <div class="row">

        <div class="col-3">
            <div class="card">
                <div class="card-header font-bold">
                    Produk Terjual
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile" style="min-height: 182.7px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header font-bold">
                    Produk Paling Laku
                </div>
                <div class="card-body">
                    <div wire:target="products">
                        <table class="table table-hover table-responsive" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th wire:ignore width="30%">Nama Produk</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($most_sale_product as $item)
                                <tr>
                                    <td>
                                        {{$loop->iteration + $most_sale_product->firstItem() - 1}}
                                    </td>
                                    <td >
                                        <span >{{$item->name}}</span>
                                    </td>
                                    <td>
                                        <span >Rp. {{ number_format($item->price, 0,0,".") }}</span>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="float-end">
                            {{$most_sale_product->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
</div>



</div>


@push('script')
<script src="{{asset('js/extensions/apexcharts.js')}}"></script>

    @foreach ($product_stock_warn as $item)
        <script>
            Toastify({
                text: '{{$item->name." stock menipis. Harap segera Restock produk kembali"}}',
                duration: 5000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#fffdd8",
                    color: "black",
                    "border-radius": "5px",
                    "font-size": "12px",
                }
            }).showToast();
        </script>
    @endforeach
    <script>

        window.addEventListener('message', e => {
                if(e.detail.status == 200){
                    Toastify({
                        text: e.detail.message,
                        duration: 3000,
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
                        duration: 3000,
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

        $(document).ready(function(){
            $('#shop_phone').mask('+62 000 0000 0000');
            $('#tax').mask('###', {reverse: true});
        })

        var charDoughnut = new ApexCharts(document.querySelector('#chart-visitors-profile'), {
            series: [{{$product_sale}}, {{$product_total}}],
            labels: ["Total Produk Terjual", "Total Stock Produk"],
            colors: ["#157347", "#bb2d3b"],
            chart: {
                type: "donut",
                width: "100%",
                height: "350px",
            },
            legend: {
                position: "bottom",
            },
            plotOptions: {
                pie: {
                donut: {
                    size: "30%",
                },
                },
            },
        })

        charDoughnut.render()
    </script>

    @if (session()->has('message'))
        <script>
            Toastify({
                text: "{{session('message')}}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#00b09b",
                }
            }).showToast();
        </script>
    @endif
@endpush
