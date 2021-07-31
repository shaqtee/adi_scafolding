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
                <h2 class="text-center">Alamat Pengiriman</h2>
            </div>
            <div class="col-md-3 align-self-center p-1">
                <a href="{{ url('cart') }}" class="badge badge-warning text-dark">Back To Cart</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                <form class="" action="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Nama</label>
                            <input type="text" class="form-control" id="guest_name" name="guest_name">
                        </div>
                        <div class="form-group col-md-6 align-self-end text-right">
                            <a href="" class="btn btn-outline-success btn-block">Klik Pakai Alamat Akun</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-6">
                            <label for="inputEmail4">Telepon</label>
                            <input type="email" class="form-control">
                        </div>
                        <div class="form-group col-md-6 col-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="guest_email" name="guest_email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-6">
                            <label for="inputEmail4">Alamat</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="form-group col-md-6 col-6">
                            <label for="inputEmail4">Kode Pos</label>
                            <input type="email" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <select class="form-control">
                                <option>Kota / Kabupaten</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <select class="form-control">
                                <option>Propinsi</option>
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
                        <div class="input-group col-md-12">
                            <a href="#" class="btn btn-outline-success btn-block" href="">Simpan</a>
                        </div>
                    </div>
                </form>

            </div>

            
            <div class="col-md-6 mb-4">
                
                <hr class="dropdown-divider my-4 bg-warning mydivider">

                <form action="" method="" id="donation_form">
                    <div class="card border-success bg-gradient-dark">
                        <div class="card-header">
                            Konfirmasi Pesanan
                        </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="input-group input-group-sm mb-3 col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">No. Order</span>
                                        </div>
                                        <input type="text" class="form-control text-danger text-center" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ uniqid() }}" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    @for($i=0;$i<3;$i++)
                                    <div class="col-md-12">
                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Kacamata &nbsp;&nbsp;&nbsp;x 12</span>
                                            </div>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Rp 25.000 / Unit</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>

                                <div class="row">
                                    
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input class="" name="gridRadios" type="radio" aria-label="Radio button for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Text input with radio button" value="JNE Courier" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input class="" name="gridRadios" type="radio" aria-label="Radio button for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control" aria-label="Text input with radio button" value="POS Indonesia" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input class="" name="gridRadios" type="radio" aria-label="Radio button for following text input">
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
                                            <label class="input-group-text" for="inputGroupSelect01">Services Option</label>
                                        </div>
                                        <select class="custom-select" id="guest_type" name="guest_type">
                                            <option value="medis_kesehatan">Medis & Kesehatan</option>
                                            <option value="kemanusiaan">Kemanusiaan</option>
                                            <option value="bencana_alam">Bencana Alam</option>
                                            <option value="rumah_ibadah">Rumah Ibadah</option>
                                            <option value="beasiswa_pendidikan">Beasiswa & Pendidikan</option>
                                            <option value="sarana_infrastruktur">Sarana & Infrastruktur</option>
                                        </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="p-2 alert alert-dark border-success" role="alert">
                                            <b><u class="text-dark">Details</u></b>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex card bg-dark">
                                            <div class="px-2">
                                                Subtotal
                                                <span class="float-right">Rp 50.000</span>
                                            </div>
                                            <div class="px-2">
                                                Pengiriman
                                                <span class="float-right">Rp 50.000</span>
                                            </div>
                                            <div class="px-2">
                                                Total
                                                <input class="float-right text-right bg-dark p-0 text-warning col-4" name="amount" id="amount" type="text" data-amount="50000" value="{{ 'Rp '. number_format(50000,0,",",".") }}" disabled>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-block text-white">Buat Pesanan & Lanjutkan Pembayaran</button>
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
    
@endsection

@section('js')
<script src="{{
    !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
    data-client-key="{{ config('services.midtrans.clientKey')
}}"></script>
<script>
    
    $("#donation_form").on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url:"{{ url('/api/donation') }}",
            type:"POST",
            dataType:"JSON",
            data: {
                _token:"{{ csrf_token() }}",
                guest_name: $('#guest_name').val(),
                guest_email: $('#guest_email').val(),
                guest_type: $('#guest_type').val(),
                amount: $('#amount').attr('data-amount'),
                note: $('#note').val()
            },
            success: function (data, status){
                console.log(data, status);
                snap.pay(data.snap_token, {
                    // Optional
                    onSuccess: function (result) {
                        location.reload();
                    },
                    // Optional
                    onPending: function (result) {
                        location.reload();
                    },
                    // Optional
                    onError: function (result) {
                        location.reload();
                    }
                });
                return false;
            }
        });

    })
</script>
@endsection