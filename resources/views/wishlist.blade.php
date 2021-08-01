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
                    <h6 class="m-0 font-weight-bold text-white">WishList</h6>

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

                <!-- KONTEN INTI -->
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col-lg-12">
                        <table class="table table-dark table-responsive-sm">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Stock Status</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($wishlist as $i => $wl)
                                <tr>

                                <th class="align-middle" scope="row"><a href="" class="{{'wishlist'.$i}}" data-id={{ $wl->id }}>x</a></th>
                                <td class="align-middle"> <img src="{{ $wl->foto }}" width="100"></td>
                                <td class="align-middle"><a href="{{ url('/single/'.$wl->id) }}">{{ $wl->nama_produk }}</a></td>
                                <td class="align-middle">Rp {{ number_format($wl->harga,0,",",".") }}</td>
                                <td class="align-middle">{{ $wl->status }}</td>
                                <td class="align-middle"><a href="#" class="badge badge-warning addToCart" data-id={{ $wl->id }} onclick="addToCart(this)">add to cart</a></td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

                <!-- END KONTEN INTI -->

            </div>
        </div>
    </div>
</div>
<!-- End Begin Page Content -->

@include('layouts.public.bottom')

@endsection

@section('js')
    <script>
        /* Button X */
        $('tbody tr th a').on('click', function(e){
            e.preventDefault();
            let namaKelas = e.target.className.toString();
            console.log(namaKelas);
            $.ajax({
                url:"{{ url('/wishlistdisaction') }}",
                type:"POST",
                dataType:"JSON",
                data:{
                    _token:"{{ csrf_token() }}",
                    id:$('.' + namaKelas).attr('data-id')
                },
                success: function(data){
                    console.log(data);
                    $('.' + namaKelas).parents()[1].remove();
                    location.reload();
                }
            })
        })

        /* Add To Cart */


        function addToCart(data){
            let id = data.dataset.id;

            console.log(id);
            $.ajax({
                url:"wishlist/addtocart",
                type:"POST",
                dataType:"JSON",
                data:{
                    _token:"{{ csrf_token() }}",
                    id:id
                },
                success: function(data){
                    location.reload();
                }
            })
        }
    </script>
@endsection
