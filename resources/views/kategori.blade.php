@extends('layouts/public')

@section('css')
<style>
    *{
    }
    .mynav{
            background-color:rgb(17,17,17);
        }
    .myfooter{
            background-color:rgb(17,17,17);
    }
    .myRow{
        border:2px solid red;
    }
    .myCol{
        border:2px solid blue;
    }
    .displayProduk{
        width:100%;
        transition: 0.3s;
    }
    .displayProduk:hover {
        transform:scale(1.1);
    }



    /* Scrollbar */
    ::-webkit-scrollbar{
        width:15px;
    }
    ::-webkit-scrollbar-track{
        box-shadow: 0 0 5px rgb(0, 0, 0);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb{
        background: rgb(202, 14, 155);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover{
        background: #000000;
    }

    .arrowP{
        position: relative;
    }

    @media(min-width:0){
        #cart {
            display:none;
        }
        .loginregister {
            display:none;
        }
    }

    @media (min-width:0){
        /* horizontal scroll */
        .wrapperku{
            height:370px;
            width:1290px;
            border: 1px solid #ddd;

            background: #2193b0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6dd5ed, #2193b0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6dd5ed, #2193b0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            display:flex;
            overflow-x:scroll;
            scrollbar-width:none;
        }
        .barang{
            min-width:130px;
            height:320px;
            line-height:20px;
            text-align:center;
            background-color:rgb(255, 255, 255);
            margin-right: 3px;
            margin-top: 15px;
            border-radius:5px;
        }
        .itemSatu{
            margin-left:5px;
        }
        .iklan{
            margin-top:150px;
        }
        .iklanThumbnail{
            width:96%;
            transition:0.5s;
        }
        .iklanThumbnail:hover{
            transform: scale(1.2);
        }
        .loopBgKategori{
            background: #E0EAFC;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #CFDEF3, #E0EAFC);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #CFDEF3, #E0EAFC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    }
</style>

@section('public_content')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-dark">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                <div class="container-fluid bg-dark">
                    <div class="row mynav">
                        <div class="col">

                            <nav class="navbar navbar-expand-lg navbar-dark mynav">
                                <button class="navbar-toggler border border-primary" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <img class="navbar-brand" src="{{ asset('images/brand/sudah1.png') }}" width="100" alt="">
                                <div class="collapse navbar-collapse" id="navbarColor01">

                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{ url('/') }}">Beranda <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Dokumentasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('video') }}">Video</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Kontak</a>
                                        </li>
                                        <li class="nav-item d-lg-none">
                                            <a class="nav-link" href="{{ url('/cart') }}">
                                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                                &nbsp;Keranjang Belanja</a>
                                        </li>
                                        <li class="nav-item d-lg-none">
                                            <a class="nav-link" href="#">
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                                &nbsp;Daftar Keinginan</a>
                                        </li>
                                        <li class="nav-item d-lg-none memberauth d-block">
                                            @if (Route::has('login'))
                                                @auth
                                                    @if(auth()->user()->roles()->get()[0]->name == 'administrator')
                                                            <a href="{{ url('/admin') }}" class="nav-link">
                                                                <span class="btn btn-primary">
                                                                    <i class="fas fa-home"></i>
                                                                    &nbsp;Home
                                                                </span>
                                                            </a>
                                                    @elseif(auth()->user()->roles()->get()[0]->name == 'user')
                                                            <a href="{{ url('/member') }}" class="nav-link">
                                                                <span class="btn btn-primary">
                                                                    <i class="fas fa-home"></i>
                                                                    &nbsp;Home
                                                                </span>
                                                            </a>
                                                    @else
                                                            <a href="{{ url('/home') }}" class="nav-link">
                                                                <span class="btn btn-primary">
                                                                    <i class="fas fa-home"></i>
                                                                    &nbsp;Home
                                                                </span>
                                                            </a>
                                                    @endif
                                            @else
                                                    <a href="{{ route('login') }}" class="nav-link active">
                                                            <i class="fas fa-sign-in-alt"></i>
                                                            &nbsp;Masuk
                                                    </a>

                                                    @if (Route::has('register'))

                                                        <a href="{{ route('register') }}" class="nav-link active">
                                                                <i class="fas fa-sign-in-alt"></i>
                                                                &nbsp;Daftar
                                                        </a>

                                                    @endif
                                                @endauth
                                            @endif
                                        </li>
                                    </ul>

                                    <div class="mr-5 d-lg-block" style="font-size:0.8em;" id="cart">

                                            <a href="">
                                                <i class="fa fa-heart" aria-hidden="true"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a href="{{ url('/cart') }}">
                                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                            </a>

                                    </div>

                                    <div class="d-none d-lg-block">
                                        @if (Route::has('login'))
                                            @auth
                                                @if(auth()->user()->roles()->get()[0]->name == 'administrator')
                                                    <div class="text-center">
                                                        <a href="{{ url('/admin') }}" class="nav-link">
                                                            <span class="btn btn-primary">
                                                                <i class="fas fa-home"></i>
                                                                &nbsp;Home
                                                            </span>
                                                        </a>
                                                    </div>
                                                @elseif(auth()->user()->roles()->get()[0]->name == 'user')
                                                    <div class="text-center">
                                                        <a href="{{ url('/member') }}" class="nav-link">
                                                            <span class="btn btn-primary">
                                                                <i class="fas fa-home"></i>
                                                                &nbsp;Home
                                                            </span>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="text-center">
                                                        <a href="{{ url('/home') }}" class="nav-link">
                                                            <span class="btn btn-primary">
                                                                <i class="fas fa-home"></i>
                                                                &nbsp;Home
                                                            </span>
                                                        </a>
                                                    </div>
                                                @endif
                                        @else
                                                <div class="row">
                                                    <div class="col-lg-4 loginregister d-lg-block">
                                                        <a href="{{ route('login') }}" class="btn btn-primary">
                                                                &nbsp;Masuk
                                                        </a>
                                                    </div>

                                                    @if (Route::has('register'))
                                                        <div class="col-lg-4 loginregister d-lg-block">
                                                            <a href="{{ route('register') }}" class="btn btn-primary ml-2">
                                                                    &nbsp;Daftar
                                                            </a>
                                                        </div>
                                                </div>
                                                    @endif
                                            @endauth
                                        @endif
                                    </div>

                                </div>
                            </nav>

                        </div>
                    </div>
                </div>
                <!-- End of Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid bg-dark">

                    <!-- Content Row -->
                    <div class="row-12 mt-3">

                        <!-- Topbar Search -->
                        <form class="container col-sm-4 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                                    <h6 class="m-0 font-weight-bold text-white">Kategori : {{ $kategori }}</h6>

                                    <div class="dropdown no-arrow">

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

                                    <div class="d-flex flex-row flex-wrap justify-content-center py-3">
                                    @foreach($products as $product)
                                    <div class="card m-1" style="width: 18rem;">
                                        <img src="{{ $product['foto'] }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product['nama_produk'] }}</h5>
                                            <p class="card-text">{{ $product['deskripsi'] }}</p>
                                            <a href="#" class="btn btn-primary">Order</a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="mt-4">{{ $products->links() }}</div>
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
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->

    <!-- Modal Kategori -->
<div class="modal fade" id="modalKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Kategori :</h5>
            </div>
            <div class="modal-body">

                @foreach($listKategori as $lk)
                <a href="" class="badge badge-success">{{ $lk['kategori'] }}</a>
                @endforeach
                {{--<a href="">Barang Bekas</a> ,
                <a href="">Bahan Kue</a> ,
                <a href="">Produk Digital</a> ,
                <a href="">Fashion</a> ,
                <a href="">Kesehatan</a> ,
                <a href="">Sembako</a> ,
                <a href="">Snack</a>--}}
            </div>
        </div>
    </div>
</div>
<!-- End Modal Kategori -->

<!-- Modal Tag -->
<div class="modal fade" id="modalTag">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Tag :</h5>
            </div>
            <div class="modal-body">
                <a href="" class="badge badge-success">Furniture</a>
                <a href="" class="badge badge-success">Tas</a>
                <a href="" class="badge badge-success">Peralatan</a>
                <a href="" class="badge badge-success">Aksesoris</a>
                <a href="" class="badge badge-success">Sweater</a>
                <a href="" class="badge badge-success">Sepatu</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tag -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- End of Scroll to Top Button-->

@endsection
@section('js')
    <script>

    </script>
@endsection
