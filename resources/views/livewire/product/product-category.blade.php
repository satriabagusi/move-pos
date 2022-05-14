@section('page-title', 'Kategori Produk')
@section('page-subtitle', 'Daftar Kategori Produk')
@section('produk', 'active')
@section('kategori-produk', 'active')


<div>
    <div class="card">
        <div class="card-header">
            Kategori Produk
        </div>
        <div class="card-body">
            @if (count($categories) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else
            <div wire:target="categories">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="30%">Nama Kategori</th>
                            <th width="40%">Deskripsi</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                            <td>{{$loop->iteration + $categories->firstItem() - 1}}</td>
                            <td >
                                {{$item->name}}
                            </td>
                            <td >{{$item->description}}</td>
                            <td>
                                <button type="button" class="btn btn-sm icon icon-left btn-primary"  data-bs-toggle="modal" data-bs-target="#editForm" wire:click="editCategory({{$item->id}})" wire:ignore>
                                    <i data-feather="edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm icon icon-left btn-danger" wire:click="deleteWindow({{$item->id}})" wire:ignore>
                                    <i data-feather="edit"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="float-end">
                    {{$categories->links()}}
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button type="button" class="float-end btn btn-sm icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#addCategory" wire:ignore>
                <i data-feather="plus-circle"></i> Tambah Kategori
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
                <form wire:submit.prevent="updateCategory">
                    <div class="modal-body">
                        <input type="hidden" wire:model="edit_category_id">
                        <label>Nama Kategori: </label>
                        <div class="form-group">
                            <input type="text" placeholder="Nama Kategori" class="form-control @error('edit_category_name') is-invalid @enderror" wire:model="edit_category_name">
                            @error('edit_category_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Deskripsi: </label>
                        <div class="form-group">
                            <textarea class="form-control @error('edit_category_description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" wire:model="edit_category_description"></textarea>
                            @error('edit_category_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        @if ($errors->any() || $edit_category_name == null || $edit_category_description == null)
                            <button type="button" class="btn btn-primary ml-1 disabled" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
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
                    <h4 class="modal-title" id="myModalLabel33">Tambah Kategori Produk</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:ignore>
                        <i data-feather="x"></i>
                    </button>
                </div>
                    <form wire:submit.prevent="saveCategory">
                        <div class="modal-body">
                            <label>Nama Kategori: </label>
                            <div class="form-group">
                                <input type="text" placeholder="Nama Kategori" class="form-control @error('category_name') is-invalid @enderror" wire:model="category_name">
                                @error('category_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Deskripsi: </label>
                            <div class="form-group">
                                <textarea class="form-control @error('category_description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" wire:model="category_description"></textarea>
                                @error('category_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            @if ($category_name == null || $category_description == null)
                                <button type="button" class="btn btn-primary ml-1 disabled" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
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
                        window.livewire.emit('deleteCategory', e.detail.id);
                    }
            });
        });
        </script>
@endpush
