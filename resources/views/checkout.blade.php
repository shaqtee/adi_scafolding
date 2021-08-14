@extends('layouts.public')
@section('css')
<style>
    *{
        margin:0;
        padding:0;
        font-family:'Lato', sans-serif;
        color:white;
    }

    a{
        color:#3ab0ff;
    }
    a:hover{
        color:#3adeff;
    }
    .myrow{
        border: 2px solid red;
    }
    .mycol{
        border: 2px solid blue;
    }

    .myimg{
        position: relative;
    }
    .mytext{
        position: absolute;
        top:0%;
        font-size:10vw;
        font-family:Impact, 'Haettenschweiler', 'Arial Narrow Bold', sans-serif;
    }

    @media (min-width:992px){
        .mytagparent{
            position: relative;;
        }
        .mytag::after{
            content:'H O T';
            font-size: 60%;
            text-align: center;
            position: absolute;
            background-color:#ffed4a;
            border-radius:10px ;
            padding: 0 10px;
            bottom: 31px;
            right:5px;
            font-weight:bold;
            color:black;
        }
        .mytag::before{
            position: absolute;
            content: '';
            width: 0px;
            border-top:4px solid #ffed4a;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            top:5px;
            left: 56%;
            transform:rotate(120deg)
        }
        .myfitur{
            display:none;
        }
    }

    @media(min-width:767.98px){
        .mydivider{
            display:none;
        }
    }

    @media(max-width:576px){
        .costummercareAndSocial{
            margin:auto;
        }
    }
    .formPengiriman{
        display:block;
        margin-bottom: 10px
    }
    #grupFormPengiriman{
        display:none;
    }

    .vendor{
        display:none;
    }
</style>
@endsection

@section('public_content')

<!-- Topbar -->
@include('layouts.public.topbarshop')
<!-- End Topbar -->

<div class="container mt-3">

    <!-- Navbar -->
    @include('layouts.public.navbarshop')
    <!-- End Navbar -->

    <!-- Start Here -->

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3">
                <h2 class="text-center">Pengiriman Ke</h2>
            </div>
            <div class="col-md-3 align-self-center p-1">
                <a href="#" onclick="window.history.back();" class="badge badge-warning text-dark p-2 px-3">&nbsp;Back&nbsp;</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <form class="" action="" method="" autocomplete="on">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nama</label>
                            <input type="text" class="form-control" id="guest_name" name="guest_name">
                        </div>
                        <div class="form-group col-md-6 align-self-end text-right">
                            <a href="#" name="getAddress" class="btn btn-outline-success btn-block" onclick="getAddress(this)">Klik Pakai Alamat Akun</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-6">
                            <label for="phone">Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="form-group col-md-6 col-6">
                            <label for="guest_email">Email</label>
                            <input type="email" class="form-control" id="guest_email" name="guest_email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-6">
                            <label for="alamat">Alamat</label>
                            <input type="text" name="alamat" class="form-control" id="alamat">
                        </div>
                        <div class="form-group col-md-6 col-6">
                            <label for="kodepos">Kode Pos</label>
                            <input type="text" name="kodepos" class="form-control" id="kodepos">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select class="form-control bg-dark text-white" name="province_origin">
                                <option class="text-dark" value="">--Provinsi--</option>
                                @foreach($province as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control bg-dark text-white" name="kota_origin">
                                <option>--Kota/Kabupaten--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-group col-md-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Catatan</span>
                            </div>
                            <textarea name="note" id="note" class="form-control" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    <div class="form-row mt-3">
                        <div class="input-group col-md-12 justify-content-center">
                            <a class="btn btn-outline-success btn-block" onclick="simpanAlamat()" href="">Simpan</a>
                            <p class="bg-danger text-white px-2 simpanAlamatResponse mt-2"></p>
                        </div>
                    </div>
                </form>

            </div>


            <div class="col-md-6 mb-4">

                <hr class="dropdown-divider my-4 bg-warning mydivider">

                <form action="" method="" id="payment_form">
                    <div class="card border-success bg-gradient-dark">
                        <div class="card-header">
                            Konfirmasi Pesanan
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="input-group input-group-sm mb-3 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-dark text-white" id="inputGroup-sizing-sm">No. Order</span>
                                        </div>
                                        <input name="invoice" type="text" class="p-0 form-control text-danger text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ 'INV-'.uniqid() }}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach($produk as $p)
                                    <div class="col-md-12">
                                        <div class="d-flex flex-wrap mb-3">
                                            <span class="mb-1 mr-1 input-group-text bg-primary text-white checkCartSession">{{ $loop->iteration }}. {{ $p[0]['nama_produk'] }} &nbsp;&nbsp;&nbsp;{{ $p[0]['berat'] }} kg x {{ $p[1]['qty'] }} unit</span>
                                            @if($p[0]['disc'] != 0 || NULL)
                                            <span class="mb-1 mr-1 input-group-text bg-dark text-white">Price : Rp{{ number_format($p[0]['price_before_disc'],0,",",".") }} / Unit</span>
                                            <span class="mb-1 mr-1 input-group-text bg-dark text-white">Disc{{ number_format($p[0]['disc'],0) }}% : Rp {{ number_format(($p[0]['disc']/100)*$p[0]['price_before_disc'],0,",",".") }}/Unit</span>
                                            @endif
                                            <span class="mb-1 mr-1 input-group-text bg-dark text-white">Rp{{ number_format($p[0]['harga'],0,",",".") }} / Unit</span>
                                            <input type="text" class="px-2 form-control text-center getSubPricing" aria-label="Amount (to the nearest dollar)" data-total="{{ $p[0]['harga']*$p[1]['qty'] }}" data-weight="{{ $p[0]['berat']*$p[1]['qty'] }}" value="Rp{{ number_format(($p[0]['harga']*$p[1]['qty']),0,",",".") }} | {{ $p[0]['berat']*$p[1]['qty'] }}kg">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="row">

                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input data-kurir="jne" class="" name="gridRadios" type="radio" aria-label="Radio button for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Text input with radio button" data-kurir="jne" value="JNE Courier" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input data-kurir="pos" class="" name="gridRadios" type="radio" aria-label="Radio button for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Text input with radio button" value="POS Indonesia" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input data-kurir="tiki" class="" name="gridRadios" type="radio" aria-label="Radio button for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Text input with radio button" value="CV TIKI" disabled>
                                            </div>
                                        </div>

                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                            <label class="input-group-text bg-dark text-white" for="inputGroupSelect01">Option</label>
                                        </div>
                                        <select class="custom-select bg-dark text-white" id="guest_type" name="guest_type">
                                            <option value="">--Select Service--</option>
                                        </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="p-2 alert alert-dark border-success" role="alert">
                                            <b class="text-dark door">Dikirim dari : <br>Jl.Permata Sukodono Raya C2 No.24 Sidoarjo, Jawa Timur - Indonesia.</b>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex card bg-dark">
                                            <div class="px-2">
                                                Subtotal
                                                <span id="resultSubPricing" class="float-right subtotal" data-subtotal="0">Rp 0</span>
                                            </div>
                                            <div class="px-2">
                                                Pengiriman
                                                <span class="float-right priceOngkir" data-priceongkir="0">Rp 0</span>
                                            </div>
                                            <div class="px-2">
                                                Total
                                                <input class="float-right text-right bg-dark p-0 text-warning col-8 amount" name="amount" id="amount" type="text" data-amount="50000" value="" disabled>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="showButtonPayment d-none btn btn-success btn-block text-white">Buat Pesanan & Lanjutkan Pembayaran</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="dropdown-divider mb-4 bg-warning mydivider">
        </div>
    </div>

    <!-- Finish Here -->
</div>

<div class="container-fluid">
    <div class="row" style="background-color:#111111">
        <div class="col">
            <nav class="navbar navbar-expand-lg navbar-dark p-0 py-1" style="background-color:#111111">
                <p class="text-white mx-auto my-auto py-3">Alfabet Digital Shop developed by Sigma Intramedia.</p>
            </nav>
        </div>
    </div>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- End of Scroll to Top Button-->

    {{-- parseData --}}
    @php
        foreach ($produk as $prod) {
            $arr['item'][] = ($prod[0]['nama_produk']);
            $arr['unit_qty'][] = $prod[1]['qty'];
            $arr['unit_weight'][] = $prod[0]['berat'];
            $arr['unit_price'][] = $prod[0]['harga'];

            $arr['unit_disc'][] = $prod[0]['disc'];
            $arr['unit_disc_price'][] = ($prod[0]['disc']/100)*$prod[0]['price_before_disc'];
            $arr['unit_price_before_disc'][] = $prod[0]['price_before_disc'];
        }
        $item = implode("|", $arr['item']);
        $unit_qty = implode("|", $arr['unit_qty']);
        $unit_weight = implode("|", $arr['unit_weight']);
        $unit_price = implode("|", $arr['unit_price']);

        $unit_disc = implode("|", $arr['unit_disc']);
        $unit_disc_price = implode("|", $arr['unit_disc_price']);
        $unit_price_before_disc = implode("|", $arr['unit_price_before_disc']);
    @endphp
    {{-- endParseData --}}
@endsection

@section('js')
<script src="{{
    !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('services.midtrans.clientKey')
}}"></script>
<script>



    $("#payment_form").on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url:"{{ url('/payment') }}",
            type:"POST",
            dataType:"JSON",
            data: {
                _token:"{{ csrf_token() }}",
                item: @php echo json_encode($item); @endphp,
                unit_qty: @php echo json_encode($unit_qty); @endphp,
                unit_weight: @php echo json_encode($unit_weight); @endphp,
                unit_price: @php echo json_encode($unit_price); @endphp,
                unit_disc: @php echo json_encode($unit_disc); @endphp,
                unit_disc_price: @php echo json_encode($unit_disc_price); @endphp,
                unit_price_before_disc: @php echo json_encode($unit_price_before_disc); @endphp,
                phone: $('input[name="phone"]').val(),
                alamat: $('input[name="alamat"]').val(),
                kodepos: $('input[name="kodepos"]').val(),
                propinsi: $('select[name="province_origin"] option').filter(':selected').text(),
                kota: $('select[name="kota_origin"] option').filter(':selected').val(),
                invoice: $('input[name="invoice"]').val(),
                courier: $('input[type="radio"][name="gridRadios"]:checked').attr('data-kurir'),
                dbSubtotal: $('.subtotal').attr('data-subtotal'),
                dbOngkir: $('.priceOngkir').attr('data-priceongkir'),
                door: $('.door').text(),
                user_id: @php echo json_encode(auth()->user()->id); @endphp,
                guest_name: $('#guest_name').val(),
                guest_email: $('#guest_email').val(),
                guest_type: $('#guest_type').val(),
                amount: $('#amount').attr('data-amount'),
                note: $('#note').val()
            },
            success: function (data){

                if(data === false){
                    $('.simpanAlamatResponse').text('Saldo anda tidak Mencukupi untuk transaksi ini.')
                    alert('Saldo anda tidak Mencukupi untuk transaksi ini.')
                }else if( data === 200){
                    location.replace("{{ url('/home/history/mainprod') }}")
                }
                return false;
            }
        });

    })

    $('select[name="province_origin"]').on('change', function() {
            let provinceId = $(this).val();

            if(provinceId){
                jQuery.ajax({
                    url:'/api/'+provinceId+'/province/citiesid',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                        $('select[name="kota_origin"]').empty();

                        $.each(data, function(key, value){

                            $('select[name="kota_origin"]').append(`<option value="${key}">${value}</option>`);

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

    function getAddress(e){

        $.ajax({
            url:"{{ url('/checkout/getaddress') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}"
            },
            success: function(data){

                $('#guest_name').val(data.user.name);
                $('#phone').val(data.user.phone);
                $('#guest_email').val(data.user.email);
                $('#alamat').val(data.alamat);
                $('#kodepos').val(data.kode_pos);
                $('select[name="province_origin"] option:selected').text(data.propinsi);
                $('select[name="kota_origin"] option:selected').text(data.kota);
                $('select[name="kota_origin"] option:selected').attr('value', data.code);
            }
        })
    }

    function simpanAlamat(){
        this.event.preventDefault()

        let arrAlamat = [
            $('#guest_name').val(),
            $('input[name="phone"]').val(),
            $('#guest_email').val(),
            $('input[name="alamat"]').val(),
            $('input[name="kodepos"]').val(),
            $('select[name="province_origin"] option').filter(':selected').text(),
            $('select[name="kota_origin"] option').filter(':selected').val()
        ];

        if($('.checkCartSession').text().split(' ')[4] === "Cart"){
            alert('Anda belum memasukkan produk ke dalam keranjang..')
        }else if(arrAlamat[0] === ""){
            alert('nama belum diisi')
        }else if(arrAlamat[1] === ""){
            alert('telepon belum diisi')
        }else if(arrAlamat[2] === ""){
            alert('email belum diisi')
        }else if(arrAlamat[3] === ""){
            alert('alamat belum diisi')
        }else if(arrAlamat[4] === ""){
            alert('kodepos belum diisi')
        }else if(arrAlamat[5] === "--Provinsi--"){
            alert('propinsi belum diseleksi')
        }else if(arrAlamat[6] === "--Kota/Kabupaten--"){
            alert('kota belum diseleksi')
        }else{
            $('.showButtonPayment').removeClass('d-none').addClass('d-block')
        }
        $('.simpanAlamatResponse').text('Pastikan produk & alamat pengiriman telah terisi dengan benar.')
    }

    $('input[type=radio][name="gridRadios"]').on('click', function(){
        let dataKurir = [$('input[type=radio][name="gridRadios"]:checked').attr('data-kurir')],
            kotaTujuan = $('select[name="kota_origin"] option').filter(':selected').val(),
            kotaAsal = 409;

        $.ajax({
            url:"{{ route('checkoutStore') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                courier:dataKurir,
                city_origin:kotaAsal,
                city_destination:kotaTujuan
            },
            success: function(data){
                $('select[name="guest_type"]').empty();

                data.result[0][0].costs.forEach(function(item,index,arr){

                    $('select[name="guest_type"]').append(`<option value="${item.service}-${item.cost[0].value}-${item.cost[0].etd}">${item.service} : ${formatter.format(item.cost[0].value)} | Est.day : ${item.cost[0].etd}</option>`);
                })
            }
        })
    })

    $('select[name="guest_type"]').on('click', function(){
        let dataOngkir = $('select[name="guest_type"] option').filter(':selected').val(),
            priceOngkir = dataOngkir.split('-')[1];
        $('.priceOngkir').attr('data-priceongkir', priceOngkir * resultSubWeight);
        $('.priceOngkir').text(formatter.format(priceOngkir * resultSubWeight));


        dataSubtotal = parseInt($('.subtotal').attr('data-subtotal')),
        dataPriceOngkir = parseInt($('.priceOngkir').attr('data-priceongkir')),
        dataFinalTotal = dataSubtotal + dataPriceOngkir;

        $('.amount').val(formatter.format(dataFinalTotal));
        $('.amount').attr('data-amount',dataFinalTotal);

    })

    /* --- Subtotal --- */
    let arrSubPricing = []

    $('.getSubPricing').each(function(){
        arrSubPricing.push($(this).data('total'));
    });

    let resultSubPricing = arrSubPricing.reduce(function(a,c){
        return a+c;
    })

    $('#resultSubPricing').text(formatter.format(resultSubPricing))
    $('#resultSubPricing').attr('data-subtotal',resultSubPricing)
    /* --- End Subtotal --- */

    let dataSubtotal = parseInt($('.subtotal').attr('data-subtotal')),
        dataPriceOngkir = parseInt($('.priceOngkir').attr('data-priceongkir')),
        dataFinalTotal = dataSubtotal + dataPriceOngkir;

    $('.amount').val(formatter.format(dataFinalTotal));
    $('.amount').attr('data-amount',dataFinalTotal);


    /* --- SubWeight --- */

    let arrSubWeight = []

    $('.getSubPricing').each(function(){
        arrSubWeight.push($(this).data('weight'));
    });

    let resultSubWeight = arrSubWeight.reduce(function(a,c){
        return a+c;
    })

    /* --- End SubWeight --- */
</script>
@endsection
