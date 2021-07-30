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
                    <a class="nav-link" href="{{ url('/') }}">BELANJA <span class="sr-only">(current)</span></a>
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
                    <a class="nav-link" href="{{ route('login') }}" style="color:white;">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="myfitur">&nbsp; Akun Saya</span>
                    </a>
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