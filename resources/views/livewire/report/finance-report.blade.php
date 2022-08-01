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
                            <h6 class="text-muted font-semibold">Penjualan Hari Ini {{date("d-m-Y")}}</h6>
                            <h6 class="font-extrabold mb-0">Rp. {{number_format($daily_sales, 0, "", ".")}}</h6>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="fs-4">Laporan Keuangan Bulanan</span>
                <hr>
                </div>
                <div class="card-body">
                    <div id="monthly-sale"></div>
                </div>
                <div class="card-footer border-top-0">

                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="fs-4">Laporan Keuangan Tahunan</span>
                <hr>
                </div>
                <div class="card-body">
                    <div id="annually-sale"></div>
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
            function randNumberPemasukan(){
                return Math.floor(Math.random() * 1000000);
            };

            function randNumberPengeluaran(){
                return Math.floor(Math.random() * 1000000);
            };

            function formatRupiah(angka, prefix){
                const numb = angka;
                const format = numb.toString().split('').reverse().join('');
                const convert = format.match(/\d{1,3}/g);
                const rupiah = prefix + convert.join('.').split('').reverse().join('');

                return rupiah;
            }

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
                            data: [randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan()],
                        },
                        {
                            name: "Pengeluaran",
                            data: [randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran()],
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
                                return formatRupiah(t, "Rp. ") ;
                            },
                        },
                    },
                    colors: ['#56B6F7', '#F3616D']
                });

            var monthlySaleChart = new ApexCharts(document.querySelector('#monthly-sale'), {
                    series: [
                        {
                            name: "Pemasukan",
                            data: [randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan()],
                        },
                        {
                            name: "Pengeluaran",
                            data: [randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran()],
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
                            "Minggu 1",
                            "Minggu 2",
                            "Minggu 3",
                            "Minggu 4"
                        ],
                    },
                    yaxis: { title: { text: "Rp (thousands)" } },
                    fill: { opacity: 1 },
                    tooltip: {
                        y: {
                            formatter: function (t) {
                                return formatRupiah(t, "Rp. ") ;
                            },
                        },
                    },
                    colors: ['#56B6F7', '#F3616D']
                });

            var annuallySaleChart = new ApexCharts(document.querySelector('#annually-sale'), {
                    series: [
                        {
                            name: "Pemasukan",
                            data: [randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan(), randNumberPemasukan()
                            ],
                        },
                        {
                            name: "Pengeluaran",
                            data: [randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran(), randNumberPengeluaran()
                            ],
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
                            "Januari",
                            "Februari",
                            "Maret",
                            "April",
                            "Mei",
                            "Juni",
                            "Juli",
                            "Agustus",
                            "September",
                            "November",
                            "Desember",
                        ],
                    },
                    yaxis: { title: { text: "Rp (thousands)" } },
                    fill: { opacity: 1 },
                    tooltip: {
                        y: {
                            formatter: function (t) {
                                return formatRupiah(t, "Rp. ") ;
                            },
                        },
                    },
                    colors: ['#56B6F7', '#F3616D']
                });

                dailySaleChart.render();
                monthlySaleChart.render();
                annuallySaleChart.render();


        </script>
@endpush
