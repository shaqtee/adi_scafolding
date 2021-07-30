@extends('layouts.public')

@section('css')
    <style>

    </style>
@endsection

@section('public_content')

@include('layouts.public.top')

    <!-- Begin Page Content -->
    <div class="container-fluid bg-dark">

        <!-- Content Row -->
        <div class="row-12">

            <!-- Topbar Search -->
            <form class="container col-sm-4 navbar-search py-3">
                <div class="input-group">
                    <input id="inputSearch" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Product Area Right Column -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">


                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #141E30;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #243B55, #141E30); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    ">
                        <h6 class="m-0 font-weight-bold text-white">{{ $showCase }} : {{ $key }}</h6>

                        <div class="dropdown no-arrow">
                            <a href="{{ url('/') }}" class="badge badge-warning">Back</a>
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <button class="dropdown-item" data-toggle="modal" data-target="#modalKategori">Kategori</button>
                                <button class="dropdown-item" data-toggle="modal" data-target="#modalTag">Tag</button>
                                <div class="dropdown-divider"></div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card Header - Dropdown -->

                    <!-- Start Here -->
                    <div class="container-fluid loopBgKategori">

                        <div class="d-flex flex-row flex-wrap justify-content-center py-3 produkLoop">
                            @foreach($products as $product)
                            <div class="card m-1 shadow" style="width: 18rem;">
                                <img src="{{ $product['foto'] }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product['nama_produk'] }}</h5>
                                    <p class="card-text">{{ $product['deskripsi'] }}</p>
                                    <p><b>Rp {{ number_format($product['harga'],0,",",".") }}</b></p>
                                    <a href="#" class="btn btn-primary">Order</a>
                                </div>
                            </div>
                            @endforeach
                        {{--<div class="mt-4">{{ $products->links() }}</div>--}}
                        </div>
                    </div>
                    <!-- End Start Here -->

                </div>
            </div>
            <!-- End Product Area Right Column -->

        </div>
        <!-- End Content Row -->

    </div>
    <!-- End Begin Page Content -->

@include('layouts.public.bottom')

@endsection

@section('js')
    <script>
        $("#inputSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".produkLoop div").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endsection
