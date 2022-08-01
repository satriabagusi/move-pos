@section('title', 'Transaksi Baru')
@section('page-title', 'Transaksi Baru')
@section('page-subtitle', 'Transaksi Baru')
@section('transaksi', 'active')


@if ($sectionCond == 0)
    @include('livewire.transaction._product-transaction')
@elseif($sectionCond == 1)
    @include('livewire.transaction._payment')
@endif

@push('menu')
    <nav class="navbar fixed-bottom navbar-expand bg-light">
        <div class="container-fluid p-0">
            <a class="navbar-brand" href="#">
                <img src="{{asset('images/logo.png')}}" alt="">
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item me-2">
                <a class=" btn btn-outline-primary" href="{{URL::to('/')}}">
                    <i class="bi bi-house"></i>
                    Home
                </a>
              </li>
              <li class="nav-item">
                <a class=" btn btn-primary me-2" href="{{URL::to('/transaksi')}}">
                    <i class="bi bi-cart4"></i>
                    Transaksi
                </a>
              </li>
              <li class="nav-item">
                <a class=" btn btn-outline-primary" href="{{URL::to('/produk/data-produk')}}">
                    <i class="bi bi-clipboard-data"></i>
                    Produk
                </a>
              </li>
            </ul>
          </div>

          <div class="dropup">
            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-menu d-flex">
                    <div class="user-name text-end me-3">
                        <h6 class="mb-0 text-gray-600">{{Auth::user()->name}}</h6>
                        <p class="mb-0 text-sm text-gray-600">{{Auth::user()->user_roles->role_name}}</p>
                    </div>
                    <div class="user-img d-flex align-items-center">
                        <div class="avatar avatar-md">
                            <img src="{{asset('images/faces/1.jpg')}}">
                        </div>
                    </div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                <li>
                    <h6 class="dropdown-header">Hello, {{Auth::user()->name}}!</h6>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                    <i class="icon-mid bi bi-person me-2"></i>My Profile</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                        Logout</a>
                </li>
            </ul>
        </div>


        </div>
      </nav>

        @include('livewire.transaction._modal')
@endpush

@push('script')
        <script>


            window.addEventListener('message', e => {
                if(e.detail.status == 200){
                    Toastify({
                        text: e.detail.message,
                        duration: 1500,
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
                        duration: 1500,
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
                $('.total_pay').mask("#.##0,00", {reverse: true});

                window.livewire.on('printResi', () => {
                    var el = $("#section-to-print").clone();
                    console.log(el);
                    $('#printResiModal').modal('show');
                });

                window.livewire.on('hideModal', () => {
                    $('#discVoucherModal').modal('hide');
                });
            })





        </script>
@endpush
