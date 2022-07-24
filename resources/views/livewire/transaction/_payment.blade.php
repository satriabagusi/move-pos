<div class="col-12 col-lg-4 col-md-6 col-xs-12 card shadow mt-1" style="max-height: 800px; height: 800px">

    <div class="card-body scroll">
        <h4 class="mt-1">Pembayaran</h4>
        <div class="row py-5 border-top border-bottom">
            <div class="text-center">
                <p class="fw-bold">Jumlah yang harus dibayarkan :</p>
                <h2>{{"Rp. ".number_format($subTotal, 0, ",", ".")}}</h2>
            </div>
            <div class="form-group mt-4">
                <label for="">Uang yang dibayarkan :</label>
                <input type="text" name="" id="total_pay" class="text-center form-control form-control-lg" autofocus wire:model='total_pay'>
            </div>
            <div class="d-flex justify-content-around">
                <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '20.000')">20.000</button>
                <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '50.000')">50.000</button>
                <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '100.000')">100.000</button>
                <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '200.000')">200.000</button>
                <button class="btn btn-sm btn-outline-primary" wire:click="$set('total_pay', '500.000')">500.000</button>
            </div>
            <div class="form-group text-center mt-4">
                <button class="btn btn-outline-primary btn-lg" wire:click="$set('sectionCond', 0)">Kembali</button>
                <button class="btn btn-success btn-lg">Bayar</button>
            </div>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
