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
        <div class="row-12 mt-3">

            <!-- Product Area Right Column -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">

                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: #141E30;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #243B55, #141E30); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    ">
                        <h6 class="m-0 font-weight-bold text-white">Products</h6>

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
                            <a href="{{ url('showcase/'.$prodAds['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="container-fluid loopBgKategori">
                        <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                            <span class="">Kategori : {{ $prodAds2['kategori'] }}</span>
                            <a href="{{ url('showcase/'.$prodAds2['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds2['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="container-fluid loopBgKategori">
                        <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                            <span class="">Kategori : {{ $prodAds3['kategori'] }}</span>
                            <a href="{{ url('showcase/'.$prodAds3['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds3['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="container-fluid loopBgKategori">
                        <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                            <span class="">Kategori : {{ $prodAds4['kategori'] }}</span>
                            <a href="{{ url('showcase/'.$prodAds4['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds4['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="container-fluid loopBgKategori">
                        <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                            <span class="">Kategori : {{ $prodAds5['kategori'] }}</span>
                            <a href="{{ url('showcase/'.$prodAds5['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds5['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="container-fluid loopBgKategori">
                        <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                            <span class="">Kategori : {{ $prodAds6['kategori'] }}</span>
                            <a href="{{ url('showcase/'.$prodAds6['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds6['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="container-fluid loopBgKategori">
                        <div class="d-flex h4 justify-content-start mt-5" style="font-size:1.1rem;">
                            <span class="">Kategori : {{ $prodAds7['kategori'] }}</span>
                            <a href="{{ url('showcase/'.$prodAds7['kategori']) }}" class="ml-auto align-self-end" style="font-size:.9rem;">Lihat Semua</a>
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
                                    <a href="{{ url('/single/'.$prodAds7['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
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
                                    <a href="{{ url('/single/'.$prod['id']) }}" class="btn btn-dark text-white btn-md">Order</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Begin Page Content -->

@include('layouts.public.bottom')

@endsection

@section('js')
    <script>

    </script>
@endsection
