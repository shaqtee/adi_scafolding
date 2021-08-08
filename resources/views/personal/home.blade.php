@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
<!-- Page Heading -->
<div class="d-sm-flex justify-content-center align-items-center mb-4">
    <div class="col">
        <a href="/checkout" class=" btn btn-sm btn-dark text-white shadow-sm mt-1">Back to Checkout</a>
        <a href="/" class="btn btn-sm btn-primary shadow-sm mt-1">Go Shop</a>
        <a href="{{ url('/pengiriman') }}" class="btn btn-success btn-sm px-2 text-white mt-1">
            <i class="fa fa-wrench" aria-hidden="true"></i>
            &nbsp;&nbsp;Setting Alamat Pengiriman
        </a>
        <a href="#" class="btn btn-danger btn-sm px-2 text-white mt-1">
            <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
            &nbsp;&nbsp;Upgrade
        </a>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 mb-4">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">

                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Utama</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format(auth()->user()->saldo,0,",",".") }}</div>
                    </div>
                    <div class="col-auto text-right">
                        <a href="{{ url('/home/deposit') }}" class="badge badge-primary px-2 text-white">
                            <i class="fa fa-plus-circle"></i>
                            &nbsp;&nbsp;Isi Saldo
                            &nbsp;</a><br>
                        <a href="{{ url('/home/transferbank') }}" class="badge badge-primary px-2 text-white">
                            <i class="fa fa-minus-circle"></i>
                            &nbsp;&nbsp;Tarik Saldo
                            &nbsp;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 mb-4">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Saldo Bonus</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format(auth()->user()->saldo_bonus,0,",",".") }}</div>
                    </div>
                    <div class="col-auto text-right">

                        <a href="{{ url('/home/claim/form') }}" class="badge badge-primary px-2 text-white">
                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                            &nbsp;&nbsp;Claim
                            &nbsp;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 d-none d-xl-block mb-4">
    <div class="col-xl-12 mb-4 position-absolute">
        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
        <div class="card-header">Udah pada tau ?</div>
        <div class="card-body">
            <h5 class="card-title">Fasilitas Upgrade</h5>
            <p class="card-text">Tiket Upgrade memungkinkan anda mendapatkan passive income melalui fitur komisi transaksi dan komisi recruitment.
                <br><br>Jika belum melakukan Upgrade maka hanya mendapatkan bonus transaksi dari produk pascabayar kami, jadi tunggu apalagi?!
            </p>
        </div>
        </div>
    </div>
    </div>

</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-8 mb-4">
        <div class="card border-left-primary shadow py-2">
            <div class="card-body">
                <div class="no-gutters align-items-center">
                    <div class="col mr-2">

                        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center secprod">
                        @foreach($icons as $icon)
                        <div style="width:125px;height:90px;" class="p-2 align-self-center secondary-product m-1 shadow-lg rounded-3 border border-white text-center text-white">
                            <img class="" width="40" src="{{ asset('images/produk/icon/'.$icon['icon']) }}"/>
                            <br><p class="p-0 text-info mt-2" style="font-size: 0.8em;line-height:100%" >{{ $icon['menu_name'] }}</p>
                        </div>
                        @endforeach
                        <div class="mt-2 p-0">{{ $icons->links() }}</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@section('js')
<script>
    $('.secondary-product').hover(function(){
        $(this).toggleClass('border-white border-primary')
    })
</script>
@endsection

@endsection
