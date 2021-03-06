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
                                        <a class="nav-link" href="{{ url('/cart') }}" style="color:white;">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span class="myfitur">&nbsp; Keranjang</span>&nbsp;<span class="badge badge-warning countCart"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item d-lg-none">
                                        <a class="nav-link" href="{{url('/wishlist')}}" style="color:white;">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                            <span class="myfitur">&nbsp; Daftar Keinginan</span>&nbsp;<span class="badge badge-warning countWishlist"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item d-lg-none memberauth d-block">
                                        @if (Route::has('login'))
                                            @auth
                                                @if(in_array(5, $roleNavigator))
                                                        <a href="{{ url('/home') }}" class="nav-link">
                                                            <span class="btn btn-primary">
                                                                <i class="fas fa-home"></i>
                                                                &nbsp;Home
                                                            </span>
                                                        </a>
                                                @elseif(in_array(2, $roleNavigator))
                                                        <a href="{{ url('/admin') }}" class="nav-link">
                                                            <span class="btn btn-primary">
                                                                <i class="fas fa-home"></i>
                                                                &nbsp;Home
                                                            </span>
                                                        </a>
                                                @else
                                                        <a href="{{ url('/member') }}" class="nav-link">
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

                                        <a href="{{ url('/wishlist') }}">
                                            <i class="fa fa-heart" aria-hidden="true"></i>&nbsp;<span class="badge badge-warning countWishlist"></span>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="{{ url('/cart') }}">
                                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>&nbsp;<span class="badge badge-warning countCart"></span>
                                        </a>

                                </div>

                                <div class="d-none d-lg-block">
                                    @if (Route::has('login'))
                                        @auth
                                            @if(in_array(5, $roleNavigator))
                                                <div class="text-center">
                                                    <a href="{{ url('/home') }}" class="nav-link">
                                                        <span class="btn btn-primary">
                                                            <i class="fas fa-home"></i>
                                                            &nbsp;Home
                                                        </span>
                                                    </a>
                                                </div>
                                            @elseif(in_array(2, $roleNavigator))
                                                <div class="text-center">
                                                    <a href="{{ url('/admin') }}" class="nav-link">
                                                        <span class="btn btn-primary">
                                                            <i class="fas fa-home"></i>
                                                            &nbsp;Home
                                                        </span>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <a href="{{ url('/member') }}" class="nav-link">
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
                                                    <a href="{{ url('login') }}" class="btn btn-primary">
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
