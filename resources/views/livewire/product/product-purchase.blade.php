@section('page-title', 'Pembelian Produk')
@section('page-subtitle', 'Pembelian stok barang')
@section('produk', 'active')
@section('pembelian-produk', 'active')

<div>
    <div class="card">
        <div class="card-header">
            Pembelian Produk
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
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th width="">Jumlah</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$loop->iteration + $products->firstItem() - 1}}</td>
                            <td >
                                <span class="fs-4">{{$item->name}}</span>
                            </td>
                            <td>
                                <p class="fs-4">Rp. {{ number_format($item->price, 0, ',' ,'.')}}</p>
                            </td>
                            <td>

                            </td>
                            <td >

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
                <form wire:submit.prevent="saveProduct">
                    <div class="modal-body">
                        <label>Nama Produk: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Nama Produk" class="form-control @error('product_name') is-invalid @enderror" wire:model="product_name">
                            @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Harga Produk: </label>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" placeholder="Harga Produk" class="form-control @error('product_price') is-invalid @enderror sell_price" wire:model="product_price">
                            </div>
                                @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Kuantitas: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Kuantitas" class="form-control @error('kuantitas') is-invalid @enderror" wire:model="kuantitas">
                            @error('kuantitas') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Jumlah: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Jumlah" class="form-control @error('jumlah') is-invalid @enderror" wire:model="jumlah">
                            @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        {{-- @if ($product_name == null || $product_name == null || $category_id == null || $product_price == null || $product_stock == null || $product_description == null) --}}
                            <button type="button" class="btn btn-primary ml-1 disabled" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none "></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        {{-- @else --}}
                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        {{-- @endif --}}
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
                            <label>Nama Produk: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama Produk" class="form-control @error('product_name') is-invalid @enderror" wire:model="product_name">
                                @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Harga Produk: </label>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" placeholder="Harga Produk" class="form-control @error('product_price') is-invalid @enderror sell_price" wire:model="product_price">
                                </div>
                                    @error('product_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Kuantitas: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Kuantitas" class="form-control @error('kuantitas') is-invalid @enderror" wire:model="kuantitas">
                                @error('kuantitas') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Jumlah: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Jumlah" class="form-control @error('jumlah') is-invalid @enderror" wire:model="jumlah">
                                @error('jumlah') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            {{-- @if ($product_name == null || $product_name == null || $category_id == null || $product_price == null || $product_stock == null || $product_description == null) --}}
                                <button type="button" class="btn btn-primary ml-1 disabled" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none "></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            {{-- @else --}}
                                <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            {{-- @endif --}}
                        </div>
                    </form>
            </div>
        </div>
    </div>

</div>
