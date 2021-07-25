@extends('layouts.public')

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
@endsection

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
                                            <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
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

                        <!-- Product Area Right Column -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">

                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #141E30;  /* fallback for old browsers */
                                background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
                                background: linear-gradient(to right, #243B55, #141E30); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                                ">
                                    <h6 class="m-0 font-weight-bold text-white">Our Products</h6>

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

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : {{ $prodAds['kategori'] }}</span>
                                    <a href="{{ url('kategori/'.$prodAds['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : {{ $prodAds2['kategori'] }}</span>
                                    <a href="{{ url('kategori/'.$prodAds2['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds2['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds2['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds2['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products2 as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                    <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                        <span class="">Kategori : {{ $prodAds3['kategori'] }}</span>
                                        <a href="{{ url('kategori/'.$prodAds3['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds3['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds3['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds3['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products3 as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : {{ $prodAds4['kategori'] }}</span>
                                    <a href="{{ url('kategori/'.$prodAds4['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds4['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds4['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds4['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products4 as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : {{ $prodAds5['kategori'] }}</span>
                                    <a href="{{ url('kategori/'.$prodAds5['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds5['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds5['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds5['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products5 as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : {{ $prodAds6['kategori'] }}</span>
                                    <a href="{{ url('kategori/'.$prodAds6['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds6['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds6['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds6['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products6 as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : {{ $prodAds7['kategori'] }}</span>
                                    <a href="{{ url('kategori/'.$prodAds7['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/aplikasi.png') }}" height="75" class="iklan rounded-circle shadow-lg px-2" alt="">
                                        <div class="barang shadow itemSatu d-flex flex-column">
                                            <div>
                                                <img src="{{ $prodAds7['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prodAds7['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prodAds7['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>

                                        @foreach($products7 as $prod)
                                        <div class="barang shadow d-flex flex-column">
                                            <div>
                                                <img src="{{ $prod['foto'] }}" class="iklanThumbnail" alt="">
                                                <hr class="bg-black">
                                                <div class="mt-2">{{ $prod['nama_produk'] }}</div>
                                            </div>
                                            <div class="mt-auto p-0 m-0 mb-3">
                                                <div class="mt-1"><b>Rp {{ number_format($prod['harga'],0,",",".") }}</b></div>
                                                <div class="mt-1"><span class="badge badge-warning inline-block">0%</span><div style="font-size:0.7rem"><del>Rp 0</del></div></div>
                                                <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md">Order</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                        </div>

                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer myfooter">
                <div class="container">
                    <div class="copyright text-center">
                    <span class="text-white">Copyright &copy; Alfabet Digital 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

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
