@section('page-title', 'Home Co')
@section('page-subtitle', 'Daftar Kategori Produk')
@section('home', 'active')
@section('kategori-produk', 'active')

<div>
    <div class="card">
        <div class="card-header">
            Kategori Produk fsf
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer">
            <p>Oke</p>
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

        $(document).ready(function(){
            $('#shop_phone').mask('+62 000 0000 0000');
            $('#tax').mask('###', {reverse: true});
        })
    </script>

    @if (session()->has('message'))
        <script>
            Toastify({
                text: "{{session('message')}}",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                style: {
                    background: "#00b09b",
                }
            }).showToast();
        </script>
    @endif
@endpush
