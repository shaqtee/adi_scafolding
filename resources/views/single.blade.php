@extends('layouts/public')
@section('css')
<style>
    *{
        margin:0;
        padding:0;
        font-family:'Lato', sans-serif;
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

    @media(max-width:576px){
        .costummercareAndSocial{
            margin:auto;
        }
    }

    @media (min-width:0){
        /* horizontal scroll */
        .wrapperku{
            height:370px;
            width:1290px;
            border: 1px solid #aaa;

            background: #0f0c29;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #24243e, #302b63, #0f0c29); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

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
            margin-top: 25px;
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

    #zoom-img {
        width: 338px;
        height: 338px;
        background-position: center;
        background-size: cover;
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

    <!-- Page Address -->
    <div class="row mt-3 text-white">
        <div class="col">
            <br><span><a class="" href="{{ url('/') }}">Beranda</a> &nbsp;/&nbsp; <a href="#">Kategori</a> &nbsp;/&nbsp;Product</span>
        </div>
        <div class="col-md-6 col-12 text-right">
            <br><a class="btn btn-dark borden border-primary" href="{{ url('/') }}" id="countCart">Lanjut Belanja</a>
            <a class="btn btn-dark borden border-primary" href="{{ url('/cart') }}" id="countCart">Lihat Keranjang - <span class="countCart"></span></a>
        </div>
    </div>
    <!-- End Page Address -->

    <!-- Main Content -->
    <div class="row mt-5 justify-content-center text-center text-white">

        <div class="col-md-2 col-4 text-right align-self-center">
            @if($fotoOptional === 'https://place-hold.it/100x100')
                @for($i=0;$i<3;$i++)
                <img class="mt-3 {{ 'fotoPlus'.$i }}" onclick="switchFoto(this)" src="{{ $fotoOptional }}" width="100" alt="">
                @endfor
            @else
                @foreach($fotoOptional as $i => $fo)
                <img class="mt-3 {{ 'fotoPlus'.$i }}" onclick="switchFoto(this)" src="{{ $fo->name }}" width="100" alt="">
                @endforeach
            @endif
        </div>
        <div class="col-md-5 col-8 text-left align-self-center">
            <div class="mt-3 border border-primary" id="zoom-img" style="width:27vmax;background:url('{{ $key->foto }}');"></div>
            {{--<img class="mt-3 border border-primary" style="width:27vmax;" src="{{ asset('images/produk/tayo.jpg') }}" alt="">--}}
        </div>

        <div class="col-md-5 mt-4 align-self-start text-center">
            <hr style="background-color:#aaa;">
            <h1 class="mt-3">{{ $key->nama_produk }}</h1>
            <h4>Rp {{ number_format($key->harga,0,",",".") }}</h4>
            <hr style="background-color:#aaa;">
            <h5>{{ $key->deskripsi }}</h5>
            <br>
            <div class="container row mx-auto justify-content-center">
                <button class="text-white minus" style="width:30px;height:30px;border:1px solid #aaa;background-color:transparent;">-</button>
                <input class="jumlahBarang mx-2 p-0 text-white text-center border border-primary" style="background-color:transparent;height:30px;width:50px;" type="text" value="0">
                <button class="text-white plus" style="width:30px;height:30px;border:1px solid #aaa;background-color:transparent;">+</button>
                <button class="btn btn-success btn-sm ml-4 align-self-center" id="cartSingle">Tambah ke keranjang</button>
                <a href="" class="text-white align-self-center ml-3" id="wishlist" data-id="{{ $key->id }}">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </a>
            </div>
            <hr class="mt-4" style="background-color:#aaa;">
        </div>
    </div>
    <div class="row mt-5 text-center">
        <div class="col">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <a href="#"class="tombolInformasiTambahan btn btn-secondary btn-sm active">INFORMASI TAMBAHAN</a>
                <a href="#"class="tombolUlasan btn btn-secondary btn-sm">ULASAN</a>
            </div>
        </div>
    </div>
    <div class="row mt-3 text-center text-white informasiTambahan">
        <div class="col">
            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti quas dicta labore! Deserunt distinctio ex dolor, a debitis quas aliquam.</h6>
        </div>
    </div>
    <div class="row mt-3 text-white ulasanDefault">
        <div class="col cobaUlasan">
            <h4>Ulasan :</h4>

            @php
                $ulasan = app('App\Models\Ulasan')->where('product_id', $key->id)->get();
            @endphp

            @if($ulasan->count() > 0)
                @foreach($ulasan as $u)
                    <span class="text-warning">
                        @for($i=0;$i<$u['rating'];$i++)
                            <i class="fa fa-star" aria-hidden="true"></i>
                        @endfor
                    </span>
                    <p class="text-white-50">Kata <span class="text-info"><b>{{ $u['name'] }}</b></span>&nbsp;&nbsp; "{{ $u['ulasan'] }}"</p>
                @endforeach
            @endif

            @php
                $userUlasanId = auth()->user()->id ?? '0';
                $cekIdUlasan = app('App\Models\Ulasan')
                    ->where('user_id', $userUlasanId)
                    ->where('product_id',$key->id)
                    ->first()['user_id'] ?? '';
            @endphp

            @if($cekIdUlasan !== $userUlasanId)
                <p class="text-white-50">Rating Anda *&nbsp;&nbsp;&nbsp;
                    <span class="bintang">
                        @for($i=0;$i<5;$i++)
                        <a href="" class="" id="star{{ $i }}" data-rating="{{ $i+1 }}">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </a>
                        @endfor
                    </span>
                    <span id="nilai"></span>
                </p>
                <div class="form-group">
                    <label class="text-white-50" for="exampleFormControlTextarea1">Ulasan Anda *</label>
                    <textarea class="form-control text-white-50" id="kontenUlasan" rows="3" style="background-color:#3d413f"></textarea>
                </div>
                <button class="btn btn-success kirimUlasan">Kirim</button>
            @endif

        </div>
    </div>
    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            <div class="col-6 border border-secondary p-3">
                <span class="text-white-50">KATEGORI : <a href="{{ url('/showcase/'.$key->kategori) }}">{{ strtoupper($key->kategori) }}</a></span>
            </div>
            <div class="col-6 border border-secondary p-3">
                <span class="text-white-50">TAGS :
                        @if($tagProduk !== "-")
                        @foreach($tagProduk as $tp)
                        <a href="{{ url('/showcase/'.$tp['name']) }}">{{ strtoupper($tp['name']) }}</a>&nbsp;|&nbsp;
                        @endforeach
                        @endif
                </span>
            </div>
        </div>

        <h4 class="text-white mt-3">Produk Terkait</h4>
        <div class="d-flex justify-content-center align-items-center rounded mt-4">
            <div class="wrapperku">
                <img src="{{ asset('images/brand/sudah1.png') }}" height="25" class="iklan px-2" alt="">

                @if($productSortedByTags === false)
                    @foreach($productSortedByCategory as $psc)
                    <div class="barang shadow d-flex flex-column">
                        <div>
                            <img src="{{ $psc['foto'] }}" width="120" height="120" class="iklanThumbnail" alt="">
                            <hr class="bg-black">
                            <div class="mt-2">{{ $psc['nama_produk'] }}</div>
                        </div>
                        <div class="mt-auto p-0 m-0 mb-3">
                            <div class="mt-1"><b>Rp {{ number_format($psc['harga'],0,",",".") }}</b></div>
                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                            <a href="{{ url('/single'.$psc['id']) }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    @foreach($productSortedByTags as $pst)
                    <div class="barang shadow d-flex flex-column">
                        <div>
                            <img src="{{ $pst['foto'] }}" width="125" height="125" class="iklanThumbnail" alt="">
                            <hr class="bg-black">
                            <div class="mt-2">{{ $pst['nama_produk'] }}</div>
                        </div>
                        <div class="mt-auto p-0 m-0 mb-3">
                            <div class="mt-1"><b>Rp {{ number_format($pst['harga'],0,",",".") }}</b></div>
                            <div class="mt-1"><span class="badge badge-warning inline-block">50%</span><div style="font-size:0.7rem"><del>Rp 1.000.000</del></div></div>
                            <a href="{{ url('/single'.$pst['id']) }}" class="btn btn-dark text-white btn-md mt-2">Detail</a>
                        </div>
                    </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <!-- End Main Content -->

</div>



<!-- Footer -->
<div class="container-fluid mt-5">
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
<script>

    /* Swap Foto onclick */
    function switchFoto(req){
        let fotoKlik = req.src;
        let str = $('#zoom-img').attr('style');
        let patt = /https:\/\/.+\/\d{3}x\d{3}/gm;
        let fotoSwap = str.match(patt)[0];

        let strReplace = str.replace(patt,req.src)
        let fotoReplace = $('#zoom-img').attr('style',strReplace);
        req.src = fotoSwap;
    }

    /* Tombol Plus Minus */
    $('.minus').on('click', function(e){
        let click = 1;
        let jumlahBarang = parseInt($('.jumlahBarang').val()) - click;
        $('.jumlahBarang').val(jumlahBarang);
    })
    $('.plus').on('click', function(e){
        let click = 1;
        let jumlahBarang = parseInt($('.jumlahBarang').val()) + click;
        $('.jumlahBarang').val(jumlahBarang);
    });
    /* End Tombol Plus Minus */

    /* Ulasan Dan Informasi Tambahan */
    $('.ulasanDefault').css('display', 'none');
    $('.tombolUlasan').on('click',function(e){
        e.preventDefault();
        $('.informasiTambahan').css('display', 'none');
        $('.ulasanDefault').toggle(500);
    });
    $('.tombolInformasiTambahan').on('click',function(e){
        e.preventDefault();
        $('.ulasanDefault').css('display', 'none');
        $('.informasiTambahan').toggle(500);
    });
    /* End Ulasan dan Informasi Tambahan */

    /* 5 Stars */
    let rating = ' &nbsp;&nbspBelum Ada Penilaian';
    $('span#nilai').html(rating);

    $('.bintang a').on('click', function(e){
        e.preventDefault();
        $(this).siblings().removeClass("text-warning");
        $('#'+e.currentTarget.id).prevAll().toggleClass('text-warning');

        if ($('#'+e.currentTarget.id).attr('class') !== "text-warning"){
            $('#'+e.currentTarget.id).toggleClass('text-warning');
        };

        parseRating = parseInt($('#'+e.currentTarget.id).attr('data-rating'))
        rating = parseInt($('#'+e.currentTarget.id).attr('data-rating'))
        switch(rating){
            case 1:
                rating = 'Buruk Sekali';
                break;
            case 2:
                rating = 'Lumayan';
                break;
            case 3:
                rating = 'Bagus';
                break;
            case 4:
                rating = 'Lebih Bagus';
                break;
            case 5:
                rating = 'Istimewa';
                break;
        }
        $('span#nilai').html('&nbsp;&nbsp'+rating);
    });
    /* End 5 Stars */

    /* button kirim ulasan */

    $('.kirimUlasan').on('click', function(){
        let kontenUlasan = $('#kontenUlasan').val()
        $.ajax({
            url:"{{ url('/single/ulasan') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                ulasan:kontenUlasan,
                rating:parseRating,
                product:@php echo json_encode($key->id); @endphp
            },
            success: function(data){
                console.log(data)
                /*location.reload()*/
            }
        })
        console.log(kontenUlasan,parseRating)
    })

    /* end button kirim ulasan */

    /* Wishlist Cek Session */

    let cekprod = @php echo json_encode($key->id) @endphp || "";
    if(cekses.includes(cekprod.toString())){
        let cekClass = $('#wishlist').attr('class').split(' ')[0];
        if(cekClass == 'text-white'){
            $('#wishlist').toggleClass('text-white text-danger');
        }
    }

    /* Wishlist */
    $('#wishlist').on('click', function(e){
        e.preventDefault();
        $(this).toggleClass('text-white text-danger');
        let boolTrigger = $(this).attr('class').split(' ').pop();
        if(boolTrigger == 'text-white'){
            ajaxTrigger = true;
        }else{
            ajaxTrigger = false;
        }

        $.ajax({
            url:"{{ url('/wishlistaction') }}",
            type: "POST",
            dataType:"JSON",
            data: {
                _token:"{{ csrf_token() }}",
                at:ajaxTrigger,
                id:$('#wishlist').attr('data-id'),
                cs:cekses,
                cp:cekprod
            },
            success: function (data){
                $('.countWishlist').html(data.length);
            }
        });
    })
    /* End Wishlist */



    /* Add To Cart */
    $('#cartSingle').on('click', function(){
        let qtyBarang = $('.jumlahBarang').val(),
            id = $('#wishlist').attr('data-id');

        $.ajax({
            url:"{{ url('/cartaction') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                qb:qtyBarang,
                id:id,
                qty:"qty",
                mark:'id'
            },
            success: function(data) {

                $('.countCart').html(data.length);
            }
        })
    });

    /* Zoom FX */
    var addZoom = function (target) {
    // (A) FETCH CONTAINER + IMAGE
    var container = document.getElementById(target),
        imgsrc = container.currentStyle || window.getComputedStyle(container, false),
        imgsrc = imgsrc.backgroundImage.slice(4, -1).replace(/"/g, ""),
        img = new Image();

    // (B) LOAD IMAGE + ATTACH ZOOM
    img.src = imgsrc;
    img.onload = function () {
        var imgWidth = img.naturalWidth,
            imgHeight = img.naturalHeight,
            ratio = imgHeight / imgWidth,
            percentage = ratio * 100 + '%';

        // (C) ZOOM ON MOUSE MOVE
        container.onmousemove = function (e) {
        var boxWidth = container.clientWidth,
            rect = e.target.getBoundingClientRect(),
            xPos = e.clientX - rect.left,
            yPos = e.clientY - rect.top,
            xPercent = xPos / (boxWidth / 100) + "%",
            yPercent = yPos / ((boxWidth * ratio) / 100) + "%";

        Object.assign(container.style, {
            backgroundPosition: xPercent + ' ' + yPercent,
            backgroundSize: imgWidth + 'px'
        });
        };

        // (D) RESET ON MOUSE LEAVE
        container.onmouseleave = function (e) {
        Object.assign(container.style, {
            backgroundPosition: 'center',
            backgroundSize: 'cover'
        });
        };
    }
    };

    window.addEventListener("load", function(){
    addZoom("zoom-img");
    });
    /* End Zoom FX */
</script>
@endsection
