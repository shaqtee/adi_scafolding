@php
    $roleNavigator = (app('\App\Http\Controllers\WelcomeController'))->searchArr();
@endphp
<div class="row">
    <div class="col">
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#1F1F1F;">
            <img width="150" src="{{ asset('images/brand/sudah1.png') }}" alt="">
            <button class="navbar-toggler border border-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">BERANDA<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mytagparent">
                    <a class="nav-link mytag" href="#">PROMOSI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">ACARA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">KONTAK</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-1">
                    <a class="nav-link" href="#" class="text-white-10">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                </li>
                <li class="nav-item mr-1">
                    <a class="nav-link" href="{{url('/wishlist')}}" style="color:white;">
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        <span class="myfitur">&nbsp; Daftar Keinginan</span>&nbsp;<span class="badge badge-warning countWishlist"></span>
                    </a>
                </li>
                <li class="nav-item">
                    @if (Route::has('login'))
                        @auth
                            @if(in_array(5, $roleNavigator))
                                <a class="nav-link" href="{{ url('/home') }}" style="color:white;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="myfitur">&nbsp; Akun Saya</span>
                                </a>
                            @elseif(in_array(2, $roleNavigator))
                                <a class="nav-link" href="{{ url('/admin') }}" style="color:white;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="myfitur">&nbsp; Akun Saya</span>
                                </a>
                            @else
                                <a class="nav-link" href="{{ url('/member') }}" style="color:white;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="myfitur">&nbsp; Akun Saya</span>
                                </a>
                            @endif
                    @else
                        <a class="nav-link" href="{{ url('/login') }}" style="color:white;">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="myfitur">&nbsp; Akun Saya</span>
                        </a>
                        @endauth
                    @endif

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}" style="color:white;">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="myfitur">&nbsp; Keranjang</span>&nbsp;<span class="badge badge-warning countCart"></span>
                    </a>
                </li>
            </ul>
            </div>
        </nav>
    </div>
</div>
