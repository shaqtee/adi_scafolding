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
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Nomor Rekening Tujuan">
                    </div>
                </div>
                <div class="col mt-3">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">a.n</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Nama Pemilik Rekening Tujuan">
                    </div>
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
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Jumlah Transfer">

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
                            <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">PIN</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan PIN Anda">
                    </div>
                </div>
                <div class="col">
                    <span style="font-size: 0.8em">Lihat PIN anda di <a href="#">profile</a></span>
                    <button class="btn btn-primary btn-block mt-3">Submit</button>
                </div>
            </div>
        </div>
    </div>


    @section('js')
        <!-- BankSwifts -->
    <script>
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
    </script>
    <!-- endBankSwifts -->
    @endsection
@endsection
