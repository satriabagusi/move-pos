@section('page-title', 'Data Pegawai')
@section('pegawai', 'active')
@section('data-pegawai', 'active')

<div>
    <div class="card">
        <div class="card-header">
            Data Pegawai
        </div>
        <div class="card-body">
            {{-- @if (count($products) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else --}}
            <div wire:target="products">
                <table class="table table-hover table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th wire:ignore width="30%">Nama Pegawai</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($products as $item)
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
                        @endforeach --}}

                    </tbody>
                </table>
                {{-- <div class="float-end">
                    {{$products->links()}}
                </div> --}}
            </div>
            {{-- @endif --}}
        </div>
        <div class="card-footer">
            <button type="button" class="float-end btn btn-sm icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#addCategory" wire:ignore>
                <i data-feather="plus-circle"></i> Tambah Pegawai
            </button>
        </div>
    </div>
</div>
