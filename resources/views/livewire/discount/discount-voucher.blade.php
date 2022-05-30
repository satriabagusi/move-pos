@section('page-title', 'Data Voucher Diskon')
@section('page-subtitle', 'Daftar Voucher Diskon')
@section('diskon', 'active')


<div>
    <div class="card">
        <div class="card-header">
            Voucher Diskon
        </div>
        <div class="card-body">
            @if (count($coupons) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else
            <div wire:target="categories">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="20%">Kode Diskon</th>
                            <th width="30%">Deskripsi</th>
                            <th width="20%">Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $item)
                        <tr>
                            <td>{{$loop->iteration + $coupons->firstItem() - 1}}</td>
                            <td >
                                {{$item->code}}
                            </td>
                            <td >{{$item->description}}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="fw-bold text-success"> Aktif </span>
                                @elseif($item->status == 0)
                                    <span class="fw-bold text-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm icon icon-left btn-primary"  data-bs-toggle="modal" data-bs-target="#editForm" wire:click="editVoucher({{$item->id}})" wire:ignore>
                                    <i data-feather="edit"></i> Edit
                                </button>
                                <button type="button" class="btn btn-sm icon icon-left btn-danger" wire:click="deleteWindow({{$item->id}})" wire:ignore>
                                    <i data-feather="trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="float-end">
                    {{$coupons->links()}}
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button type="button" class="float-end btn btn-sm icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#addVoucher" wire:ignore>
                <i data-feather="plus-circle"></i> Tambah Voucher
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
                <form wire:submit.prevent="updateVoucher">
                    <div class="modal-body">
                        <label>Kode Voucher: </label>
                        <div class="input-group">
                            <input type="text" placeholder="Kode Voucher, ex. AGUS17" class="form-control @error('edit_code') is-invalid @enderror" wire:model="edit_code" maxlength="10">
                            <button class="btn btn-primary" type="button" wire:click="generateCode">Generate Code</button>
                            @error('edit_code') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <label>Jenis Diskon: </label>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="potonganHarga" wire:model="edit_type" value="1">
                                    <label class="form-check-label" for="potonganHarga">
                                        Potongan Harga
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="persentaseDiskon" wire:model="edit_type" value="2">
                                    <label class="form-check-label" for="persentaseDiskon">
                                        Persentase
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label>Jumlah Diskon: </label>
                        <div class="form-group">
                            <div class="input-group input-group">
                                @if ($type == 1)
                                    <span class="input-group-text" id="inputGroup-sizing">Rp</span>
                                @endif
                                <input type="text" class="percentage form-control @error('edit_percentage') is-invalid @enderror" wire:model="edit_percentage"
                                @if ($type == 1)
                                    maxlength="10"
                                @elseif($type == 2)
                                    max="100"
                                    maxlength="3"
                                @endif
                                >
                                @if ($type == 2)
                                    <span class="input-group-text" id="inputGroup-sizing">%</span>
                                @endif
                            </div>
                        </div>
                        <label>Deskripsi Diskon: </label>
                        <div class="form-group">
                            <textarea class="form-control @error('edit_description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" wire:model="edit_description"></textarea>
                            @error('edit_description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-check form-switch">
                            <label>Aktif? </label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="edit_status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                        @if ($edit_code == null || $edit_percentage == null || $edit_description == null)
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

    <div wire:ignore.self class="modal fade text-left" id="addVoucher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Voucer Diskon</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" wire:ignore>
                        <i data-feather="x"></i>
                    </button>
                </div>
                    <form wire:submit.prevent="saveVoucher">
                        <div class="modal-body">
                            <label>Kode Voucher: </label>
                            <div class="input-group">
                                <input type="text" placeholder="Kode Voucher, ex. AGUS17" class="form-control @error('code') is-invalid @enderror" wire:model="code" maxlength="10">
                                <button class="btn btn-primary" type="button" wire:click="generateCode">Generate Code</button>
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <label>Jenis Diskon: </label>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="potonganHarga" wire:model="type" value="1">
                                        <label class="form-check-label" for="potonganHarga">
                                            Potongan Harga
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="persentaseDiskon" wire:model="type" value="2">
                                        <label class="form-check-label" for="persentaseDiskon">
                                            Persentase
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <label>Jumlah Diskon: </label>
                            <div class="form-group">
                                <div class="input-group input-group">
                                    @if ($type == 1)
                                        <span class="input-group-text" id="inputGroup-sizing">Rp</span>
                                    @endif
                                    <input type="text" class="percentage form-control @error('percentage') is-invalid @enderror" wire:model="percentage"
                                    @if ($type == 1)
                                        maxlength="10"
                                    @elseif($type == 2)
                                        max="100"
                                        maxlength="3"
                                    @endif
                                    >
                                    @if ($type == 2)
                                        <span class="input-group-text" id="inputGroup-sizing">%</span>
                                    @endif
                                </div>
                            </div>
                            <label>Deskripsi Diskon: </label>
                            <div class="form-group">
                                <textarea class="form-control @error('description') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" wire:model="description"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-check form-switch">
                                <label>Aktif? </label>
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" wire:model="status">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary"
                                data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            @if ($code == null || $percentage == null || $description == null)
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
                        window.livewire.emit('deleteVoucher', e.detail.id);
                    }
            });
        });
        $(document).ready(function(){
            $('.percentage').mask("#.##0", {reverse: true})
        })
        </script>
@endpush
