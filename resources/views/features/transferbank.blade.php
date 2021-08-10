@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
    <h3>Transfer Bank</h3>
    <div class="row">
        <div class="col-md-6 col-12">
            <form action="{{ url('/home/transferbank/store') }}" method="POST">
                @csrf
                <div class="d-flex card p-3">
                    <div class="col">
                        <label class="mt-3"><b>Bank Tujuan :</b></label>
                    </div>
                    <div class="col text-center">
                        <select id="bankswifts" name="bankswifts" class="form-control">
                            <option value="">--Select Bank--</option>
                        </select>
                    </div>
                    <div class="col mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">No.Rekening</span>
                            </div>
                            <input name="rek" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Nomor Rekening Tujuan">
                        </div>
                    </div>
                    <div class="col mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">a.n</span>
                            </div>
                            <input name="nama" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Nama Pemilik Rekening Tujuan">
                        </div>
                    </div>
                    <div class="d-none alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <p id="noData"></p><a href="{{ url('home/profile') }}">go to profile</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col mt-3">
                        <button class="btn btn-outline-success btn-block" onclick="dataRekening(this)">Existing Data</button>
                    </div>
                    <div class="col mt-3">
                        <div class="input-group input-group-sm">
                            <label><b>Jumlah</b></label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">Rp.</span>
                            </div>
                            <input name="nominal" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Jumlah Transfer">

                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <span style="font-size: 0.8em">Minimum Transfer Bank Rp 50.000 dan maksimum Transfer Bank Rp 10.000.000 Biaya admin Rp. 3.500/Transfer Bank langsung terpotong dari saldo.
                        </div>
                    </div>

                    <div class="col">
                        <div class="input-group input-group-sm mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">Password</span>
                            </div>
                            <input name="password" type="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Password Anda">
                        </div>
                    </div>
                    <div class="col">
                        <span style="font-size: 0.8em">Ubah password anda di <a href="{{ url('/home/profile') }}">profile</a></span>
                        @if(session('status'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if(session()->has('berhasil'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            {{ session()->get('berhasil') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <button class="btn btn-primary btn-block mt-3">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    @section('js')
    <script>
        /* BankSwifts */
        $('#bankswifts').select2({
            ajax:{
                url:'/api/bankswifts',
                type: 'POST',
                dataType: 'JSON',
                delay: 150,
                data: function(data){
                    return {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        search: $.trim(data.term)
                    }
                },
                processResults: function(response){
                    console.log(response)
                    return {
                        results: response
                    }
                },
                cache:true
            }
        })
        /* endBankSwifts */

        /* UseDataRekening */
        function dataRekening(val){
            window.event.preventDefault()
            $.ajax({
                url:"{{ url('/home/transferbank/datarekening') }}",
                type:"POST",
                dataType:"JSON",
                data:{
                    _token:"{{ csrf_token() }}",
                },
                success: function (data) {
                    console.log(data)
                    if(data == false){
                        $('#noData').parent('div').removeClass('d-none').addClass('d-block')
                        $('#noData').text('Anda belum mengisi data bank.')
                    }else{
                        $('select[name="bankswifts"] option').val(data.bank)
                        $('#select2-bankswifts-container').html(data.swift.name)
                        $('input[name="rek"]').val(data.rek)
                        $('input[name="nama"]').val(data.nama)
                    }
                }
            })
        }
        /* endUseDataRekening */
    </script>
    @endsection
@endsection
