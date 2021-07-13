@extends('layouts.public')

@section('css')
<link href="{{ asset('packages/sbadmin2/css/sb-admin-2.css') }}" rel="stylesheet">
@endsection

@section('public_content')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                <div class="container-fluid bg-info">
                    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <img class="navbar-brand" src="{{ asset('images/brand/sudah2.png') }}" width="150" alt="">
                        <div class="collapse navbar-collapse" id="navbarColor01">

                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Beranda <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Dokumentasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Kontak</a>
                                </li>
                            </ul>

                            <div class="badge badge-warning mr-5 d-inline" style="font-size:0.8em;">

                                    <a href="">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        Wishlist (1)
                                    </a>
                                    <span>&nbsp; | &nbsp;</span>
                                    <a href="">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                        Cart (1)
                                    </a>

                            </div>

                            @if (Route::has('login'))
                                @auth
                                    @if(auth()->user()->roles()->get()[0]->name == 'administrator')
                                        <div class="text-center">
                                            <a href="{{ url('/admin') }}" class="nav-link">
                                                <span class="btn primary">
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
                                    <div class="text-center">
                                        <a href="{{ route('login') }}" class="nav-link">
                                            <span class="btn btn-primary">
                                                <i class="fas fa-sign-in-alt"></i>
                                                &nbsp;Masuk
                                            </span>
                                        </a>
                                    </div>

                                    @if (Route::has('register'))
                                        <div class="text-center">
                                            <a href="{{ route('register') }}">
                                                <span class="btn btn-primary">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                    &nbsp;Daftar
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                @endauth
                            @endif

                        </div>
                    </nav>
                </div>
                <!-- End of Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row mt-3">

                        <!-- Left Column -->
                        <div class="col-xl-3 col-lg-3">

                            <!-- Search -->
                            <div class="card shadow">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                            <!-- Card Body Sortir -->
                            <div class="card shadow mt-2">
                                <div class="card-body sortirBody">
                                    <form action="" method="">
                                        <h4>Sort By :</h4>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios1">
                                                Baru
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Unggulan
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Obral
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Terendah - Tertinggi
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Tertinggi - Terendah
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                    </form>

                                    <hr>

                                    <form action="" method="">
                                        <h4>Kategori :</h4>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios1">
                                                Bahan Kue
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Barang Bekas
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Digital
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Fashion
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Kesehatan
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Sembako
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                        <div class="form-check row">
                                            <label class="form-check-label col-10" for="exampleRadios2">
                                                Snack
                                            </label>
                                            <input class="form-check-input col-2" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        </div>
                                    </form>

                                    <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-success"></i> Sort By
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-info"></i> Categories
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Product Area Right Column -->
                        <div class="col-xl-9 col-lg-9">
                            <div class="card shadow mb-4">

                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Product Lists</h6>

                                    <div class="form-row sortirOption">
                                        <form class="form-inline col" action="">
                                            <div class="form-group">
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Sort By :</option>
                                                    <option>Baru</option>
                                                    <option>Unggulan</option>
                                                    <option>Obral</option>
                                                    <option>Low-High</option>
                                                    <option><High-Low></High-Low></option>
                                                </select>
                                            </div>
                                        </form>
                                        <form class="form-inline col" action="">
                                            <div class="form-group">
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Categories :</option>
                                                    <option>Bahan Kue</option>
                                                    <option>Barang Bekas</option>
                                                    <option>Digital</option>
                                                    <option>Fashion</option>
                                                    <option>Kesehatan</option>
                                                    <option>Sembako</option>
                                                    <option>Snack</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body justify-content-around row">
                                    @for($i=0; $i<8; $i++ )
                                    <div class="col-sm-3 card text-center mt-4 mx-1">
                                        <img src="{{ asset('images/produk/bunder.png') }}" class="card-img-top p-3">
                                        <hr>
                                        <div class="card-body">
                                            <h5 class="card-title"><b>Card title</b></h5>
                                            <p class="card-text text-primary">ٌRp100.000,-</p>
                                            <p class="card-text">Some quick example text to build on.</p>
                                            <a href="#" class="btn btn-primary btn-sm">Bungkus</a>
                                        </div>
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
            </div>
        </div>
    </div>
    <!-- End if Logout Modal-->

@endsection

@section('js')
<script>

</script>
@endsection
