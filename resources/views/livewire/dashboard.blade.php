<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
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
