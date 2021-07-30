@extends('layouts.public')
@section('css')
<style>
    *{
        margin:0;
        padding:0;
        font-family:'Lato', sans-serif;
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

    <div class="row mt-3 text-white">
        <div class="col">
            <br><span><a class="" href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; Keranjang</span>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead class="">
                        <tr class="bg-info text-white shadow-md">
                        <th scope="col">#</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produk as $i => $p)
                        <tr class="{{ 'listKeranjang'.$i }}">
                            <th class="align-middle" scope="row"><a href="#" class="{{ 'produkKeranjang'.$i }}" data-key="{{ $i }}">X</a></th>
                            <td class="align-middle" scope="row"><img src="{{ $p[0]['foto'] }}" alt="" width="100"></td>
                            <td class="align-middle" scope="row"><a href="@if($produk[0][0]['foto'] != "https://place-hold.it/100x100"){{ url('/single/'.$p[0]['id']) }}@else # @endif">{{ $p[0]['nama_produk'] }}</a></td>
                            <td class="align-middle" scope="row">Rp {{ number_format($p[0]['harga'],0,",",".") }}</td>
                            <td class="align-middle" scope="row" width="200"><input type="number" class="col-sm-4 p-0 bg-dark text-center text-white mx-auto inputUpdateQty" value="{{ $p[1]['qty'] }}" data-id="{{ $p[1]['id'] }}"></td>
                            <td class="align-middle getSubTotal" scope="row" data-total="{{ $p[0]['harga'] * $p[1]['qty'] }}">Rp {{ number_format(($p[0]['harga'] * $p[1]['qty']),0,",",".") }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">

                    @if($produk[0][0]['foto'] != "https://place-hold.it/100x100")
                    <a class="btn col-sm-2 col-12 btn-dark text-white-50 border border-info my-3" id="btnUpdateKeranjang">Perbaharui Keranjang</a>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
    <hr class="divider" style="background-color:#111111">
        <div class="container">
        <div class="row row-cols-2 py-2" >
            <div class="input-group mb-3 col-md-4 col-12 my-3 p-0">
                <div class="input-group-append">
                    <button class="input-group-text bg-dark border border-info text-white-50" id="basic-addon2">Terapkan Kupon</button>
                </div>
                <input type="text" class="form-control border border-info" placeholder="User's Coupon" aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
        </div>
        </div>
    <hr class="divider" style="background-color:#111111">

    <div class="d-flex flex-row my-4">
        <h3 class="text-white ml-auto col-md-6">Total Keranjang Belanja</h3>
    </div>
    <div class="d-flex flex-row justify-content-end align-items-stretch">
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);">Subtotal</p>
        <p class="p-2 pl-3 text-warning col-md-3" style="background-color:rgb(26,26,26);" id="resultSubtotal"></p>
    </div>
    <div class="d-flex flex-row justify-content-end m-0 p-0">
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:#1a1a1a;">Pengiriman</p>
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);" id="commitPengiriman">
            @if(!session()->get('ongkir'))
            Anda belum memasukkan informasi pengiriman.
            @else
            <span class="text-warning estimasiOngkir">-</span><br>
            Ongkos: <span class="text-warning kurirPrice">Rp {{ number_format($searchForOngkir['price'],0,",",".") }}</span>&nbsp;/kg&nbsp;&nbsp;<br>
            Berat Total: <input type="number" class="col-2 m-0 p-0 text-center trialQty" value='1'> &nbsp;kg<br>
            Kota Asal : <span class="text-warning">{{ $dataOngkir['origin']['title'] }}</span> {{ ',' }}<br>
            Kota Tujuan: <span class="text-warning">{{ $dataOngkir['destination']['title'] }}</span>{{','}}<br>
            Est(day)): <span class="text-warning">{{ $searchForOngkir['etd'] }}</span>,<br>
            Kurir: <span class="text-warning">{{ strtoupper($searchForOngkir['kurir']) }}&nbsp;-&nbsp;{{ $searchForOngkir['service'] }}</span> {{'.'}}
            @endif
        </p>
    </div>

    <div class="d-flex flex-row justify-content-end m-0 p-0">
    <a href="#" id="linkHitungBiayaPengiriman" style="background-color:rgb(26,26,26);" class="col-md-3 col-7">Cek Ongkir</a>
    </div>

    <div class="d-none" id="konfirmasi">
    <form action="" method="" class="ml-auto d-flex flex-column justify-content-end m-0 p-0 text-white col-md-3 col-7 ml-auto" style="background-color:#1a1a1a;">

    </form>
    </div>

    <div class="d-flex justify-content-end m-0 p-0">
        <div class="col-md-6 m-0 p-0" style="background-color:rgb(26,26,26);">
            <div class="card-body m-2 p-2">
                <form action="{{ route('store') }}" method="POST" id="grupFormPengiriman">
                    @csrf
                    <div class="form-row">
                        <div class="col m-0 p-0">
                            <h5 class="text-warning">Pilih Expedisi:</h5>
                            @foreach($couriers as $key => $value)
                            <div class="form-check form-check-inline getKurir">
                                <input class="form-check-input" type="checkbox" id="courier-{{ $key }}" name="courier[]" value="{{ $value->code }}">
                                <label class="form-check-label text-white" for="courier-{{ $key }}">{{ $value->title }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-row mt-4">
                        <div class="col m-0 p-0">
                            <h5 class="text-warning">Asal Pengirim:</h5>
                            <div class="form-group">
                                <label class="text-white" for="">Provinsi</label>
                                <select name="province_origin" id="" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach($province as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-white" for="">Kota/Kabupaten</label>
                                <select name="city_origin" id="" class="form-control">
                                    <option value="">-</option>
                                </select>
                            </div>

                            <h5 class="text-warning">Tujuan Pengirim:</h5>
                            <div class="form-group d-flex flex-column">
                                <label class="text-white" for="">Kota/Kabupaten</label>
                                <select name="city_destination" id="city_destination" class="form-control">
                                    <option value="#">-</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col m-0 p-0">
                            <a href="" class="btn btn-primary submitConfirm">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row justify-content-end">
        <p class="p-2 pl-3 text-white col-md-3" style="background-color:rgb(26,26,26);">Total</p>
        <p class="p-2 pl-3 text-warning col-md-3 finalTotal" style="background-color:rgb(26,26,26);">-</p>
    </div>
    <div class="d-flex flex-row justify-content-end m-0 p-0 mb-5">
        <button class="btn btn-dark p-2 pl-3 text-white col-md-3 border border-info">Lanjutkan ke Checkout</button>
    </div>
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

@endsection

@section('js')
<script>

    $('#linkHitungBiayaPengiriman').on('click',function(e){
        e.preventDefault();
        $('#grupFormPengiriman').toggle(500);
        $('#commitPengiriman').toggle(500);
        $('.vendor').toggle(500);
    })

    

    /* Klik Ongkir */
    function getOngkir(radioOngkir){
        let kurirCode = radioOngkir.name.split('-')[1],
            kurirCodePackage = radioOngkir.name.split('-')[2];
        $.ajax({
            url:"{{ url('selectongkir') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                kc:kurirCode,
                kcp:kurirCodePackage
            },
            success: function(data){
                location.reload();

            }
        })
    }

    /* Get Ongkir */
    $('.submitConfirm').on('click', function(e){
        e.preventDefault();

        $('#grupFormPengiriman').fadeToggle(500)
        let kotaAsal = $('select[name="city_origin"] option').filter(':selected').val(),
            kotaTujuan = $('select[name="city_destination"] option').filter(':selected').val(),
            kurir = [];

        $('input[name="courier[]"]:checked').each(function(){
            kurir.push($(this).val())
        })

        $.ajax({
            url:"{{ route('store') }}",
            type:"POST",
            dataType:"JSON",
            async:false,
            data: {
                _token:"{{ csrf_token() }}",
                courier:kurir,
                city_origin:kotaAsal,
                city_destination:kotaTujuan
            },
            success: function(data){
                for(let i = 0; i< data.result.length; i++){
                    data.result[i].forEach(function(item, index, arr){
                        let codeKurir = item.code;
                        arr.forEach(function(item,index,arr){
                            arr[0].costs.forEach(function(item,index,arr){
                                $('#konfirmasi form').append(
                                    `<div class="form-check vendor">
                                        <input class="form-check-input" type="radio" name="radio-${codeKurir+'-'+item.service+'-'+index}" value="${item.cost[0].value}" onclick="getOngkir(this)">
                                        <label class="form-check-label">
                                            ${codeKurir.toUpperCase()} - ${item.service} - ${formatter.format(item.cost[0].value)} - DAY:${item.cost[0].etd}
                                        </label>
                                    </div>`
                                )
                            })
                        })
                    })
                }
                $('#konfirmasi').toggleClass('d-none d-block');
                $('.vendor').toggle(500);
            }
        })
    })

    /* Button X */
    $('tbody tr th a').on('click', function(e){
        let namaKelas = e.target.className.toString(),
            key = $(this).attr('data-key');
        $('.' + namaKelas).parents()[1].remove();
        $.ajax({
            url:"{{ url('/cartdisaction') }}",
            type:"POST",
            dataType:"JSON",
            data: {
                _token:"{{ csrf_token() }}",
                key:key
            },
            success: function(data){

                location.reload();
            }
        })
    })

    /* Subtotal */
    let arrSubtotal = []

    $('.getSubTotal').each(function(){
        arrSubtotal.push($(this).data('total'));
    });

    let resultSubtotal = formatter.format(arrSubtotal.reduce(function(a,c){
        return a+c;
    }))

    $('#resultSubtotal').text(resultSubtotal)
    /* End Subtotal */

    /* Perbaharui Keranjang */
    $('.inputUpdateQty').on('keyup',function(e){
        let updateHarga = $(this).val();
        $('#btnUpdateKeranjang').removeClass('btn-dark').addClass('btn-primary')
    });

    $('#btnUpdateKeranjang').on('click', function(e){
        e.preventDefault();
        let arrUpdate = []
        $('.inputUpdateQty').each(function(){
            arrUpdate.push({"id":$(this).data('id'),"qty":$(this).val()})
        });
        $.ajax({
            url:"{{ url('/cartupdateaction') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                au:arrUpdate
            },
            success: function(data){

                location.reload();
            }
        })
    });

    /* ---------------KALKULASI--------------------- */

    /* Hitung Ongkir */
    let trialQty = parseInt(($('.trialQty')).val()),
        kurirPrice = parseInt($('.kurirPrice').html()
        .split(' ')[1]
        .split('.')
        .join('')),
        intOngkir = kurirPrice * trialQty,
        resultOngkir = formatter.format(intOngkir);
    $('.estimasiOngkir').html(resultOngkir);

    /* Button Input QTY */
    $('.trialQty').on('keyup', function(){
        let trialQty = parseInt($(this).val()),
            kurirPrice = parseInt($('.kurirPrice').html()
                .split(' ')[1]
                .split('.')
                .join('')),
            resultOngkir = formatter.format(kurirPrice * trialQty);
        $('.estimasiOngkir').html(resultOngkir);
        $('.estimasiOngkir').attr('data-ongkir',kurirPrice * trialQty);
        $('#resultSubtotal').attr('data-subtotal',intSubtotal);
        dataIntSubtotal = parseInt($('#resultSubtotal').attr('data-subtotal'));
        dataIntEstimasiOngkir = parseInt($('.estimasiOngkir').attr('data-ongkir'));
        dataFinaltotal = dataIntSubtotal + dataIntEstimasiOngkir;
        $('.finalTotal').html(formatter.format(dataFinaltotal));
    })

    /* Final Total */
    let intSubtotal = parseInt($('#resultSubtotal').html().split(';')[1].split('.').join('')),
        intTotal = intSubtotal+intOngkir;
        finalTotal = formatter.format(intTotal);
    $('.finalTotal').html(finalTotal);

</script>
@endsection

