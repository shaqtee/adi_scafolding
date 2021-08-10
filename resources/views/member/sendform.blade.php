@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
    <h3>Kirim Saldo</h3>
    <div class="row">
        <div class="col-md-6">
            <form class="p-3 bg-white shadow" action="{{ url('/home/send/saldo') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Handphone</label>
                    <div class="input-group mb-3">
                        <input name="phone" type="number" class="form-control phoneNumber" placeholder="Nomor Telepon Penerima" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button data-toggle="modal" data-target="#cekPhone" class="btn btn-outline-success" type="button" onclick="getPhone(this)" id="phoneNumber">Cek Nomor</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nominal Transfer</label>
                    <input name="nominal" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Jumlah yang akan ditransfer.">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <div class="input-group">
                        <input name="new" id="new" type="password" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <button onclick="eye(this)" class="new input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></button>

                        </div>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">Saldo Utama anda saat ini <b>Rp {{ number_format(auth()->user()->saldo,0,",",".") }}</b></small>
                </div>
                @if(session('status'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('berhasil'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('berhasil') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <button type="submit" class="btn btn-primary btn-block">Kirim</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="cekPhone" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Phone</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <p class="resSearchData text-center text-primary"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    @section('js')
        <script>
            function eye(val) {
                window.event.preventDefault()
                console.log()
                var x = document.getElementById(val.classList[0]);
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }

            function getPhone(val){
                let dataPhone = $('.'+val.id).val()
                $.ajax({
                    url:"{{ url('/home/send/searchphone') }}",
                    type:"POST",
                    dataType:"JSON",
                    data:{
                        _token:"{{ csrf_token() }}",
                        phone:dataPhone
                    },
                    success: function (data) {
                        $('.resSearchData').html(data)
                    }
                })
            }
        </script>
    @endsection
@endsection
