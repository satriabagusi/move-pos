@section('page-title', 'Data Pegawai')
@section('pegawai', 'active')
@section('data-pegawai', 'active')

<div>
    <div class="card">
        <div class="card-header">
            Data Pegawai
        </div>
        <div class="card-body">
            @if (count($employees) == 0)
                <img class="img-fluid mx-auto d-block mt-2" src="{{asset('images/illustrations/empty.svg')}}" alt="No Data" width="400px">
                <h4 class="text-center mt-4">Belum ada data</h4>
            @else
            <div wire:target="products">
                <table class="table table-hover table-responsive" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th wire:ignore width="30%">Nama Pegawai</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $item)
                        <tr>
                            <td>{{$loop->iteration + $employees->firstItem() - 1}}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email == null ? '-' : $item->email }}</td>
                            <td>
                                <button type="button" class="btn btn-sm icon icon-left btn-primary"  data-bs-toggle="modal" data-bs-target="#editForm" wire:click="editProduct({{$item->id}})" wire:ignore>
                                    <span wire:ignore>
                                        <i data-feather="repeat"></i> Reset Password
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
                    {{$employees->links()}}
                </div>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('/pegawai/akun-pegawai')}}" class="float-end btn btn-sm icon icon-left btn-success">
                <i data-feather="plus-circle"></i> Tambah Pegawai
            </a>
        </div>
    </div>
</div>
