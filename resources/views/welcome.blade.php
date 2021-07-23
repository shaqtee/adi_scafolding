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
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : Barang Bekas</span>
                                    <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="{{ url('/single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : Bahan Kue</span>
                                    <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="{{ url('single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="{{ url('single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                    <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                        <span class="">Kategori : Produk Digital</span>
                                        <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="{{ url('single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="{{ url('single') }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : Fashion</span>
                                    <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : Kesehatan</span>
                                    <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : Sembako</span>
                                    <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
                                    </div>
                                </div>

                                <div class="container-fluid loopBgKategori">
                                <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                                    <span class="">Kategori : Snack</span>
                                    <a href="" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
                                </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center rounded">
                                    <div class="wrapperku">
                                        <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">
                                        <div class="barang shadow itemSatu">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @for($i=0;$i<9;$i++)
                                        <div class="barang shadow">
                                            <img src="{{ asset('images/produk/tayo.jpg') }}" class="iklanThumbnail" alt="">
                                            <hr class="bg-black">
                                            <div class="mt-2">Rak Sepatu Sandal 5 Susun Portable</div>
                                            <div class="mt-1"><b>Rp 500.000</b></div>
                                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                                            <a href="#" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                                        </div>
                                        @endfor
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
