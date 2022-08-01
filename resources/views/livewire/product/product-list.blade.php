@section('page-title', 'Data Produk')
@section('page-subtitle', 'Data Produk yang sudah terdaftar')
@section('produk', 'active')
@section('data-produk', 'active')


<div>
    <div class="card">
        <div class="card-header">
            Data Produk
        </div>
        <div class="card-body">
            @if (count($products) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else
            <div wire:target="products">
                <table class="table table-hover table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th wire:ignore width="30%">Nama Produk</th>
                            <th width="">Kategori Produk</th>
                            <th>Harga</th>
                            <th width="">Deskripsi</th>
                            <th>Stock</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$loop->iteration + $products->firstItem() - 1}}</td>
                            <td >
                                <span class="fs-4">{{$item->name}}</span>
                                <p style="font-size: 13px" class="small text-muted">{{$item->product_code}}</p>
                            </td>
                            <td>
                                {{$item->categories->name}}
                            </td>
                            <td>
                                <p class="fs-4">Rp. {{ number_format($item->price, 0, ',' ,'.')}}</p>
                            </td>
                            <td >{{$item->description}}</td>
                            <td>{{$item->stock}}</td>
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
                    {{$products->links()}}
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button type="button" class="float-end btn btn-sm icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#addCategory" wire:ignore>
                <i data-feather="plus-circle"></i> Tambah Produk
            </button>
        </div>
    </div>


    <div wire:ignore.self class="modal fade text-left" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Produk</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:ignore>
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form wire:submit.prevent="updateProduct">
                    <div class="modal-body">
                        <input type="hidden" wire:model="edit_product_id">
                        <label>Kode Produk: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Kode Produk" class="form-control @error('edit_product_code') is-invalid @enderror" wire:model="edit_product_code">
                            @error('edit_product_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Nama Produk: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Nama Produk" class="form-control @error('edit_product_name') is-invalid @enderror" wire:model="edit_product_name">
                            @error('edit_product_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Kategori Produk: </label>
                            <div wire:ignore class="form-group">
                                    <select class="choices form-select @error('category_id') is-invalid @enderror" wire:model="category_id">
                                        @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        <label>Harga Produk: </label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" placeholder="Harga Jual Produk" class="form-control @error('edit_product_price') is-invalid @enderror sell_price" wire:model="edit_product_price">
                            </div>
                                @error('edit_product_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        <label>Stok Awal Produk: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Stok Awal Produk" class="form-control @error('edit_product_stock') is-invalid @enderror stock_product" wire:model="edit_product_stock" readonly>
                            @error('edit_product_stock') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Deskripsi Produk: </label>
                        <div class="form-group">
                            <textarea class="form-control @error('edit_product_description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" wire:model="edit_product_description"></textarea>
                            @error('edit_product_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        @if ($edit_product_code == null || $edit_product_name == null || $edit_category_id == null || $edit_product_price == null || $edit_product_stock == null || $edit_product_description == null)
                            <button type="button" class="btn btn-primary ml-1 disabled" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none "></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>

                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade text-left" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Data Produk</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:ignore>
                        <i data-feather="x"></i>
                    </button>
                </div>
                    <form wire:submit.prevent="saveProduct">
                        <div class="modal-body">
                            <label>Kode Produk: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Kode Produk" class="form-control @error('product_code') is-invalid @enderror" wire:model="product_code">
                                @error('product_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Nama Produk: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama Produk" class="form-control @error('product_name') is-invalid @enderror" wire:model="product_name">
                                @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Kategori Produk: </label>
                                <div wire:ignore class="form-group">
                                        <select class="choices form-select @error('category_id') is-invalid @enderror" wire:model="category_id">
                                            @foreach ($categories as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            <label>Harga Produk: </label>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" placeholder="Harga Jual Produk" class="form-control @error('product_price') is-invalid @enderror sell_price" wire:model="product_price">
                                </div>
                                    @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            <label>Stok Awal Produk: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Stok Awal Produk" class="form-control @error('product_stock') is-invalid @enderror stock_product" wire:model="product_stock">
                                @error('product_stock') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Deskripsi Produk: </label>
                            <div class="form-group">
                                <textarea class="form-control @error('product_description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" wire:model="product_description"></textarea>
                                @error('product_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            @if ($product_code == null || $product_name == null || $category_id == null || $product_price == null || $product_stock == null || $product_description == null)
                                <button type="button" class="btn btn-primary ml-1 disabled" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none "></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            @endif
                        </div>
                    </form>
            </div>
        </div>
    </div>

</div>


@push('script')
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

            window.addEventListener('swal:confirm', function(e){
                Swal.fire(e.detail)
                .then((result) => {
                    if(result.isConfirmed) {
                        window.livewire.emit('deleteProduct', e.detail.id);
                    }
            });
        });

        $(document).ready(function(){
            $('.sell_price').mask("#.##0", {reverse: true})
            $('.stock_product').mask("#.##0", {reverse: true})
        })
        </script>
@endpush
