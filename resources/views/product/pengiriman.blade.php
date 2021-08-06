@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
<div class="container-fluid mt-1">
    <div class="row">
        <div class="col">
            <button class="shadow-sm btn btn-warning btn-sm" onclick="window.history.back()">
                &nbsp;<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Back&nbsp;&nbsp;
            </button>
        </div>
    </div>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-4 shadow-sm align-items-center py-2 bg-white border border-primary">
            <h5 class="py-2 text-center">Setting Alamat Pengiriman :</h5>
            <p class="py-2 text-center">{{ session('status') }}</p>
            <form action="{{ url('pengiriman/store') }}" method="POST">
                @csrf
                <div class="input-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing">Alamat</span>
                    </div>
                    <input name="alamat" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Kode POS</span>
                    </div>
                    <input name="kode_pos" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                </div>
                <div class="px-3 row row-cols-1">
                    <label class="text-dark" for="">Provinsi</label>
                    <select name="province_origin" id="" class="form-control">
                        <option value="">--Provinsi--</option>
                        @foreach($province as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <label class="text-dark mt-2" for="">Kota/Kabupaten</label>
                    <select name="city_origin" id="" class="form-control">
                        <option value="">-</option>
                    </select>
                </div>
                <button class="btn btn-primary btn-block mt-3">Submit</button>
            </form>
        </div>
        <div class="col-md-4 shadow-sm py-2 bg-primary">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h5 class="py-2 text-white">Alamat Pengiriman Anda:</h5>
                <div class="input-group input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing">Alamat</span>
                    </div>
                    <input value="{{ $address['alamat'] }}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" disabled>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Kode POS</span>
                    </div>
                    <input value="{{ $address['kode_pos'] }}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" disabled>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Kota / Kabupaten</span>
                    </div>
                    <input value="{{ $address['kota'] }}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" disabled>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Propinsi</span>
                    </div>
                    <input value="{{ $address['propinsi'] }}" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" disabled>
                </div>

                <h6 class="text-white">Last Updated : </h6>
                <h5 class="text-warning">{{ date('d-m-Y', strtotime($address['updated_at'])) }}</h5>
            </div>
        </div>
    </div>
</div>

@section('js')

    <!-- Ongkir -->
    <script>
        $('select[name="province_origin"]').on('change', function() {
            let provinceId = $(this).val();

            if(provinceId){
                jQuery.ajax({
                    url:'/api/province/'+provinceId+'/cities',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){

                        $('select[name="city_origin"]').empty();

                        $.each(data, function(key, value){
                            $('select[name="city_origin"]').append(`<option value="${key}">${value}</option`);

                        });

                    }
                })
            }else{
                $('select[name="city_origin"]').empty();
            }



        })

        $('#city_destination').select2({
            ajax:{
                url:'/api/cities',
                type: 'post',
                dataType: 'JSON',
                delay: 150,
                data: function(data){
                    return {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        search: $.trim(data.term)
                    }
                },
                processResults: function(response){

                    return {
                        results: response
                    }
                },
                cache:true
            }
        })
    </script>
    <!-- End Ongkir -->

@endsection

@endsection
