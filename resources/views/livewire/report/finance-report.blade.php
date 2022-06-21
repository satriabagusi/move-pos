@section('page-title', 'Laporan')
@section('page-subtitle', 'Laporan Keuangan')
@section('laporan', 'active')
@section('laporan-keuangan', 'active')


<div>
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <i class="iconly-boldWallet"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Penjualan (Hari)</h6>
                            <h6 class="font-extrabold mb-0">112.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon green">
                                <i class="iconly-boldWallet"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Penjualan (Bulan)</h6>
                            <h6 class="font-extrabold mb-0">112.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                                <i class="iconly-boldWallet"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pengeluaran (Hari)</h6>
                            <h6 class="font-extrabold mb-0">112.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon red">
                                <i class="iconly-boldWallet"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Pengeluaran (Bulan)</h6>
                            <h6 class="font-extrabold mb-0">112.000</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="fs-4">Laporan Keuangan Harian</span>
                <hr>
                </div>
                <div class="card-body">
                    <div id="daily-sale"></div>
                </div>
                <div class="card-footer border-top-0">

                </div>
            </div>
        </div>
    </div>

</div>


@push('script')
    <script src="{{asset('js/extensions/apexcharts.js')}}"></script>

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
                $('#shop_phone').mask('000-0000-0000');
            })

            var dailySaleChart = new ApexCharts(document.querySelector('#daily-sale'), {
                    series: [
                        {
                            name: "Pemasukan",
                            data: [275000, 145250, 187500, 48900, 67450, 425000, 125600],
                        },
                        {
                            name: "Pengeluaran",
                            data: [76000, 85000, 101000, 98000, 87000, 105000, 91000],
                        },
                    ],
                    chart: { type: "bar", height: 350 },
                    plotOptions: {
                        bar: {
                            horizontal: !1,
                            columnWidth: "55%",
                            endingShape: "rounded",
                        },
                    },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: [
                            "Senin",
                            "Selasa",
                            "Rabu",
                            "Kamis",
                            "Jum'at",
                            "Sabtu",
                            "Minggu",
                        ],
                    },
                    yaxis: { title: { text: "Rp (thousands)" } },
                    fill: { opacity: 1 },
                    tooltip: {
                        y: {
                            formatter: function (t) {
                                return "Rp. " + t ;
                            },
                        },
                    },
                    colors: ['#56B6F7', '#F3616D']
                });

                dailySaleChart.render();


        </script>
@endpush
