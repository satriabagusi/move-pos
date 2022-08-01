<div>
    <div class="row justify-content-between container-fluid">
        <div class="col-12 col-lg-7 col-md-6 col-xs-12 p-2">
            <div class="row">
                <div class="col-12">
                    <div class="form-group position-relative has-icon-right">
                        <input wire:model="search" type="text" class="form-control" placeholder="Cari nama barang/scan barcode">
                        <div class="form-control-icon">
                            @if ($search)
                            <span wire:ignore>
                                <i class="bi bi-x-circle text-danger" wire:click="$set('search', '')"></i>
                            </span>
                            @else
                                <i class="bi bi-upc-scan"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row scroll rounded">
                @forelse ($products as $item)
                    <div class="col-lg-3 col-6 col-md-6 col-sm-6">
                        <div class="card mb-3 mx-auto shadow h-80" wire:click="addToCart({{$item->id}})">
                            <div class="card-content mx-0 px-0">
                                <img class="card-img-top img-fluid" src="{{asset('images/illustrations/product.png')}}" alt="{{$item->name}}" />
                                <div class="card-body">
                                    <h6 class="fs-6 card-title">{{$item->name}}</h6>
                                    <p class="card-text ">
                                        {{$item->description}}
                                    </p>
                                    <p class="text-muted">Stock : {{$item->stock}}</p>

                                    <span class="text-success fw-bold">
                                        Rp. {{number_format($item->price, 0, ',', '.')}},-
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <img src="{{asset('images/illustrations/empty.svg')}}" class="img-fluid mx-auto mt-5" alt="" width="150px">
                    <h1 class="display-5 text-center text-white">Belum ada data Produk !</h1>
                @endforelse
            </div>
        </div>
        @include('livewire.transaction._cart')
    </div>


</div>
