@section('page-title', 'Pembelian Produk')
@section('page-subtitle', 'Pembelian stok barang')
@section('produk', 'active')
@section('pembelian-produk', 'active')

<div>
    {{-- @dd($product_purchases) --}}
    <div class="card">
        <div class="card-header">
            Catat Pembelian Produk
        </div>
        <div class="card-body">
            <form class="form form-horizontal" wire:submit.prevent="saveProductPurchase">
                <div class="form-body">
                    <div class="row">
                    <div class="col-md-4">
                        <label>Nama Produk</label>
                    </div>
                    <div class="col-md-8 form-group" wire:ignore>
                        <select class="select2 form-control form-select @error('product_id') is-invalid @enderror" wire:model="product_id">
                            <option selected hidden>-- Pilih Produk --</option>
                            @foreach ($products as $item)
                                <option value="{{$item->id}}">{{$item->name . " ( Sisa stock : $item->stock | Harga Jual Rp. ".number_format($item->price, 0, ".", ".").")"}}</option>
                            @endforeach
                        </select>
                        @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    <div class="col-md-4">
                        <label>Jumlah Pembelian</label>
                    </div>
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="Jumlah Pembelian Produk" aria-label="Jumlah Pembelian Produk" wire:model="quantity">
                            <span class="input-group-text" id="basic-addon1">pcs </span>
                        </div>
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Harga Satuan Barang</label>
                    </div>
                    <div class="form-group col-md-8">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                            <input type="text" class="form-control price @error('price') is-invalid @enderror" placeholder="Harga Satuan Produk" aria-label="Harga Satuan Produk" wire:model="price">
                        </div>
                        @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    {{-- <div class="col-md-4">
                        <label>Upload Bukti Pembelian</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input
                        type="file"
                        class="form-control"
                        name="purchase_invoice" />
                    </div> --}}
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button
                        type="submit"
                        class="btn btn-primary me-1 mb-1"
                        >
                        Submit
                        </button>
                    </div>
                    </div>
                </div>
                </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            History Pembelian Produk
        </div>
        <div class="card-body">
            {{-- @dd($product_purchases) --}}
            @if (count($product_purchases) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else
            <div wire:target="product_purchases">
                <table class="table table-hover table-responsive" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th wire:ignore>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th width="">Qty Pembelian</th>
                            <th width="">Total Pembelian</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_purchases as $item)
                        <tr>
                            <td>{{$loop->iteration + $product_purchases->firstItem() - 1}}</td>
                            <td >
                                <span class="fs-4">{{$item->products->name}}</span>
                                <h6 class="text-muted fw-normal">{{$item->products->product_code}}</h6>
                            </td>
                            <td>
                                <p>Rp. {{ number_format($item->price, 0, ',' ,'.')}}</p>
                            </td>
                            <td >
                                <p>{{$item->quantity}} pcs</p>
                            </td>
                            <td>
                                <p>Rp. {{ number_format($item->total, 0, ',' ,'.')}}</p>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm icon icon-left btn-primary"  data-bs-toggle="modal" data-bs-target="#editForm" wire:click="editProduct({{$item->id}})" wire:ignore>
                                    <span wire:ignore>
                                        <i data-feather="edit"></i> Edit
                                    </span>
                                </button>
                                <button type="button" class="btn btn-sm icon icon-left btn-danger" wire:click="deleteWindow({{$item->id}})" wire:ignore>
                                    <span wire:ignore>
                                        <i data-feather="edit"></i> Hapus
                                    </span>
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="float-end">
                    {{$product_purchases->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>


</div>

@push('script')
    <script>
        $(document).ready(function(){
            $('.price').mask("#.##0", {reverse: true});
            $('.select2').select2();

        })

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
        window.addEventListener('swal:confirm', function(e){
                Swal.fire(e.detail)
                .then((result) => {
                    if(result.isConfirmed) {
                        window.livewire.emit('deleteProductPurchase', e.detail.id);
                    }
            });
        });

        $(document).on('change', '.select2', function (e) {
            @this.set('product_id', e.target.value);
        });
    </script>
@endpush
