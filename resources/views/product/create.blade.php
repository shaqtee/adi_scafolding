@extends('admin.index')

@section('css')
<link href="{{ asset('packages/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
.myrow{
    border: 2px solid red;
}
.mycol{
    border: 2px solid blue;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2 col-lg-2 mt-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProduk">Create</button>
        </div>

        <div class="col-md-10 col-lg-10  mt-2 input-group">
            <input class="form-control text-danger" placeholder="Check error...." value="{{ $errors->any() ? 'Cek kembali inputan anda, data belum berhasil ditambahkan.' : session('status')}}" disabled>
        </div>

    </div>

    <div class="row mt-3" id="table">
        <div class="col-md">
            <div class="table-responsive-xl">
            <table class="table table-hover table-dark justify-content-center">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Action</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
                </thead>
                <tbody id="dataproduk" class="dataproduk">
                    @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product['nama_produk'] }}</td>
                        <td>Rp {{ number_format($product['harga'],0,",",".") }}</td>
                        <td>{{ mb_substr($product['deskripsi'],0,10) }}...</td>
                        <td>{{ $product['kategori']}}</td>
                        <td>...{{ mb_substr($product['foto'],12,12) }}</td>
                        <td>
                            <a href="{{ url('/product/'. $product['id'] .'/edit') }}" class="badge badge-warning text-danger text-decoration-none modalUbah" data-toggle="modal" data-target="#modalUpdateProduct" data-id="{{ $product['id'] }}">Edit</a>
                            <a href="#" class="badge badge-danger text-warning text-decoration-none modalHapus" data-id="{{ $product['id'] }}" data-toggle="modal" data-target="#modalDeleteProduct">Delete</a>
                        </td>
                        <td>{{ $product['created_at'] }}</td>
                        <td>{{ $product['updated_at'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    {{ $products->links() }}

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="row row-cols-2 align-items-center mb-1 p-0">
                <div class="col">
                    <span>
                        <b>Tags Module</b>
                    <a href="" class="badge badge-primary" data-toggle="modal" data-target="#createTags">Create</a>
                    </span>
                </div>
            </div>
            <div id="alertAttach" class="d-none shadow alert alert-warning alert-dismissible fade show" role="alert">
                <span class="responseAttach"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
            <table class="table table-sm table-dark">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Tag Name</th>
                    <th scope="col">Action</th>
                    <th scope="col">Product</th>
                    <th scope="col">Tagging</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag['id'] }}</th>
                        <td>{{ $tag['name'] }}</td>
                        <td>
                            <a href="" class="badge badge-primary updateTag" onclick="updateTag(this)" data-id="{{ $tag['id'] }}" data-toggle="modal" data-target="#createTags">edit</a>
                            <a href="{{ url('/product/tag/' . $tag['id'] . '/delete') }}" class="badge badge-danger">delete</a>

                        </td>
                        <td>
                            <select name="prodId">
                                <option value="">--Select Product--</option>
                                @foreach($prodToAttach as $prod)
                                <option class="id_{{ $tag['id'] }}" value="{{ $prod['id'] }}">{{ $prod['id'] }}-{{ $prod['nama_produk'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a href="" onclick="attachTag(this)" data-id="{{ $tag['id'] }}" class="badge badge-primary">attach</a>
                            <a href="" onclick="detachTag(this)" data-id="{{ $tag['id'] }}" class="badge badge-success">detach</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="row row-cols-2 align-items-center mb-1 p-0">
                <div class="col">
                    <span>
                        <b>Photo Plus Module</b>
                    <a href="" class="badge badge-primary" data-toggle="modal" data-target="#createPhoto">Upload</a>
                    </span>
                </div>
            </div>
            <div id="alertAttach" class="d-none shadow alert alert-warning alert-dismissible fade show" role="alert">
                <span class="responseAttach"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="table-responsive">
            <table class="table table-sm table-dark">
                <thead class="text-center">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Product</th>
                    <th scope="col">Nama Foto</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($photos as $photo)
                    <tr>
                        <th scope="row">{{ $photo['id'] }}</th>
                        <td>
                            @php
                                $productPhoto = (App\Models\Product::where('id', $photo['fileable_id'])->first())->toArray();
                            @endphp
                            {{ $productPhoto['nama_produk'] }}
                        </td>
                        <td>{{ $photo['name'] }}</td>
                        <td>
                            <a href="" class="badge badge-primary updateTag" onclick="updatePhoto(this)" data-foto="{{ $photo['name'] }}" data-fotoid="{{ $photo['id'] }}" data-produk="{{ $productPhoto['id'] }}" data-toggle="modal" data-target="#createPhoto">edit</a>
                            <a href="" data-fotoid="{{ $photo['id'] }}" data-produk="{{ $productPhoto['id'] }}" onclick="detachPhoto(this)" class="badge badge-danger">delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>

{{-- Products --}}

<!-- Modal Tambah Produk-->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content justify-content-center py-3 bg-dark">

            <div class="d-flex justify-content-center">
                <div class="card shadow-sm col-11">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center">
                        <p class='text-center pt-2 font-weight-bold  h5'>Create Product<p>
                        </div>


                        <!-- nama produk -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Nama Produk</span>
                            </div>
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('nama_produk') }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- berat -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Berat</span>
                            </div>
                            <input type="number" name="berat" class="form-control @error('berat') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('berat') }}" required>
                        </div>

                        <!-- price before disc -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Price Before Disc.</span>
                            </div>
                            <input type="number" name="price_before_disc" class="form-control @error('price_before_disc') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('price_before_disc') }}" required>
                        </div>
                        <!-- discount -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Discount</span>
                            </div>
                            <input type="number" name="disc" class="form-control @error('disc') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('disc') }}" required>
                        </div>

                        <!-- link foto jika ada (optional) -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">photolink</span>
                            </div>
                            <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('link') }}" required>
                        </div>

                        <!-- deskripsi -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"  id="inputGroup-sizing-sm">Deskripsi</span>
                            </div>
                            <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('deskripsi') }}" required>
                            @error('deskripsi')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- kategori -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Kategori</span>
                            </div>
                            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('kategori') }}" required>
                            @error('kategori')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('foto')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex flew-row justify-content-center flex-grow-1">
                            <img class="py-1" src="https://place-hold.it/200x200/" id="previewFoto">
                        </div>

                        <!-- foto -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" onchange="readURL(this)" aria-describedby="inputGroupFileAddon01" value="old('foto')">
                                <label class="custom-file-label text-center"  id="namafile">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-0">Submit</button>
                        @csrf
                    </form>
                    <div class="modal-footer align-self-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Tambah Produk-->

<!-- Modal Update Produk-->
<div class="modal fade" id="modalUpdateProduct" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content justify-content-center py-3 bg-dark">

            <div class="d-flex justify-content-center">
                <div class="card shadow-sm col-11">
                    <form action="#" method="POST" enctype="multipart/form-data" class="updateform">
                        @method('put')
                        <div class="d-flex justify-content-center">
                        <p class='text-center pt-2 font-weight-bold  h5'>Update Product<p>
                        </div>


                        <!-- nama produk -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Nama Produk</span>
                            </div>
                            <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('nama_produk') }}" required>
                            @error('nama_produk')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- berat -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Berat</span>
                            </div>
                            <input type="number" name="berat" class="form-control @error('berat') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('berat') }}" required>
                        </div>

                        <!-- price before disc -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Price Before Disc.</span>
                            </div>
                            <input type="number" name="price_before_disc" class="form-control @error('price_before_disc') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('price_before_disc') }}" required>
                        </div>
                        <!-- disc -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Discount</span>
                            </div>
                            <input type="number" name="disc" class="form-control @error('disc') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('disc') }}" required>
                        </div>

                        <!-- link -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Photolink</span>
                            </div>
                            <input type="text" name="link" class="form-control @error('link') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('link') }}" required>

                        </div>

                        <!-- deskripsi -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text"  id="inputGroup-sizing-sm">Deskripsi</span>
                            </div>
                            <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('deskripsi') }}" required>
                            @error('deskripsi')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- kategori -->
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Kategori</span>
                            </div>
                            <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"  aria-describedby="basic-addon3" value="{{ old('kategori') }}" required>
                            @error('kategori')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('foto')
                                <div class="invalid-feedback ml-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex flew-row justify-content-center flex-grow-1">
                            <img class="py-1 foto" src="https://place-hold.it/200x200/" width=200 id="previewFoto">
                        </div>

                        <!-- foto -->
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" onchange="readUpdate(this)" aria-describedby="inputGroupFileAddon01" value="old('foto')">
                                <label class="custom-file-label text-center namafile" id="namafile">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded-0">Submit</button>
                        @csrf
                    </form>
                    <div class="modal-footer align-self-center">
                        <button type="button" class="btn btn-secondary buttonCloseUpdate" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Modal Update Produk-->

<!-- Modal Hapus Produk -->
<div class="modal fade" tabindex="-1" id="modalDeleteProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Hapus? Pastikan kembali data ini data yang akan dihapus.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <form action="" method="post" class="hapusData">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Hapus Produk -->

{{-- Tags --}}

<!-- Modal Create Tags -->
<div class="modal fade" id="createTags" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title modalLabel" id="exampleModalLabel">Products | Create Tag</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form name="update" action="{{ url('/product/tag/create') }}" method="POST">
            @csrf
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Tag</label>
            <input type="text" class="form-control" name="name" id="recipient-name">
            </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary createTag">Create</button>
        </form>
        </div>
    </div>
    </div>
</div>
<!-- endModalCreateTags -->

<!-- ModalCreatePhotos -->
<div class="modal fade" id="createPhoto" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title photoLabel" id="staticBackdropLabel">Upload Photo Plus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
            <form name="photoForm" action="{{ url('/product/photo/create') }}" method="POST">
            @csrf
            <div class="modal-body">
                <select name="produkId">
                    <option value="">--Select Product--</option>
                    @foreach($prodToAttach as $prod)
                    <option class="id_{{ $tag['id'] }}" value="{{ $prod['id'] }}">{{ $prod['id'] }}-{{ $prod['nama_produk'] }}</option>
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Photo from <a href="https://unsplash.com" target="_blank">unsplash.com</a> (Jika tidak ada photo)</label>
                    <input type="text" class="form-control" name="nama_foto" id="recipient-name" value="https://source.unsplash.com/_/600x600">
                </div>
                <label for="recipient-name" class="col-form-label">Photo from your Files.</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" name="nama_file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <span class="text-danger"><b>Note:</b> 1 Produk berisi 3 Photo Plus</span>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary closePhoto" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary updateButton">Upload</button>
            </form>
        </div>
    </div>
    </div>
</div>
<!-- endModalCreatePhotos -->

@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{ asset('packages/sbadmin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('packages/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previewFoto')
                .attr('src', e.target.result)
                .width(150);
                let imagetitle = input.files[0].name.substring(0,12);
                $('#namafile').html(`<i class="text-center mr-5">${imagetitle}....</i>`)
            };
            reader.readAsDataURL(input.files[0]);
        };
    }

    $('.modalHapus').on('click', function(){
        let idHapus = $(this).attr('data-id');
        $('.hapusData').attr('action', `{{ url('product/${idHapus}') }}`)
    })

    $('.searchTable').keyup(function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ url('/product/searchproducts') }}",
            dataType:'JSON',
            type: 'POST',
            data: {
                _token:"{{ csrf_token() }}",
                'keyword':$('input[name="searchTable"]').val()
            },
            success:function(response){
                $(".dataproduk").empty();
                let i = 1;
                $.each(response, function(index, prod){
                    $(".dataproduk").append(
                        `<tr>
                            <th scope="row">${i}</th>
                            <td>${prod.nama_produk}</td>
                            <td>${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(prod.harga).replace(/\D00(?=\D*$)/, '')}</td>
                            <td>${prod.deskripsi.substr(0,10)}...</td>
                            <td>${prod.kategori}</td>
                            <td>...${prod.foto.substr(12,12)}</td>
                            <td>
                                <a href="{{ url('/product/${prod.id}/edit') }}" class="badge badge-warning text-danger text-decoration-none modalUbah" data-toggle="modal" data-target="#modalUpdateProduct" data-id="${prod.id}">Edit</a>
                                <a href="#" class="badge badge-danger text-warning text-decoration-none modalHapus" data-id="${prod.id}" data-toggle="modal" data-target="#modalDeleteProduct">Delete</a>
                            </td>
                            <td>${prod.created_at}</td>
                            <td>${prod.updated_at}</td>
                        </tr>`
                        );
                    i++
                })
                /* Update Saat live search : karena event hoisting menyebabkan fungsi ini kudu diulang disini. */
                $('.modalUbah').on('click',function(){

                    let idUpdate = $(this).data('id')
                    $.ajax({
                        url: `{{ url('/product/tampil') }}`,
                        type: 'POST',
                        dataType: 'JSON',
                        data:{
                            _token:"{{ csrf_token() }}",
                            'id':idUpdate
                        },
                        success: function(response){
                            let cekFile = $("input[type=file]").val()

                            $(".updateform").attr('action', `/product/${response.id}`)
                            $("input[name=nama_produk]").val(`${response.nama_produk}`)
                            $("input[name=harga]").val(`${response.harga}`)
                            $("input[name=berat]").val(`${response.berat}`)
                            $("input[name=disc]").val(`${response.disc}`)
                            $("input[name=link]").val(`${response.foto}`)
                            $("input[name=price_before_disc]").val(`${response.price_before_disc}`)
                            $("input[name=deskripsi]").val(`${response.deskripsi}`)
                            $("input[name=kategori]").val(`${response.kategori}`)
                            $(".foto").attr("src", response.foto.length >= 22 ? 'https://place-hold.it/200x200/' : `{{ asset('images/produk/${response.foto}') }}`)
                            $(".namafile").html(response.foto)
                        }
                    })
                })

                /* Delete Saat Live Search */
                $('.modalHapus').on('click', function(){
                    let idHapus = $(this).attr('data-id');
                    $('.hapusData').attr('action', `{{ url('product/${idHapus}') }}`)
                })
            }
        });
    });

    $('.modalUbah').on('click',function(){

        let idUpdate = $(this).data('id')
        $.ajax({
            url: `{{ url('/product/tampil') }}`,
            type: 'POST',
            dataType: 'JSON',
            data:{
                _token:"{{ csrf_token() }}",
                'id':idUpdate
            },
            success: function(response){
                let cekFile = $("input[type=file]").val()

                $(".updateform").attr('action', `/product/${response.id}`)
                $("input[name=nama_produk]").val(`${response.nama_produk}`)
                $("input[name=harga]").val(`${response.harga}`)
                $("input[name=berat]").val(`${response.berat}`)
                $("input[name=disc]").val(`${response.disc}`)
                $("input[name=link]").val(`${response.foto}`)
                $("input[name=price_before_disc]").val(`${response.price_before_disc}`)
                $("input[name=deskripsi]").val(`${response.deskripsi}`)
                $("input[name=kategori]").val(`${response.kategori}`)
                $(".foto").attr("src", response.foto.length >= 22 ? 'https://place-hold.it/200x200/' : `{{ asset('images/produk/${response.foto}') }}`)
                $(".namafile").html(response.foto)
            }
        })
    })

    function readUpdate(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.foto')
                .attr('src', e.target.result)
                .width(150);
                let imagetitle = input.files[0].name.substring(0,12);
                $('.namafile').html(`<i class="text-center mr-5">${imagetitle}....</i>`)
            };
            reader.readAsDataURL(input.files[0]);
        };
    }

    $("#inputSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    function updateTag(val){
        $('.modalLabel').html('Products | Update Tag')
        $('.createTag').html('Update')


        $.ajax({
            url:"{{ url('/product/tag/show') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                id:$(val).data('id')
            },
            success:function(data){

                $('input[name="name"]').val(data.name)
                $('form[name="update"]').attr('action', `{{ url('/product/tag/update/${data.id}') }}`)
            }
        })
    }

    function attachTag(val){
        window.event.preventDefault()
        let tagId = $(val).data('id'),
            prodId = $(`select[name="prodId"] option.id_${tagId}`).filter(':selected').val();

        $.ajax({
            url:"{{ url('/product/tag/attach') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                tagid:tagId,
                prodid:prodId
            },
            success:function(data){

                $('#alertAttach').removeClass('d-none').addClass('d-block')
                $('.responseAttach').html(data)
            }
        })
    }

    function detachTag(val){
        window.event.preventDefault()
        let tagId = $(val).data('id'),
            prodId = $(`select[name="prodId"] option.id_${tagId}`).filter(':selected').val();

        $.ajax({
            url:"{{ url('/product/tag/detach') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                tagid:tagId,
                prodid:prodId
            },
            success:function(data){

                $('#alertAttach').removeClass('d-none').addClass('d-block')
                $('.responseAttach').html(data)
            }
        })
    }

    $('.buttonCloseUpdate').on('click', function(){
        location.reload()
    })

    function updatePhoto(val){
        let dataFoto = $(val).data('foto'),
            photoId = $(val).data('fotoid'),
            produkId = $(val).data('produk');

        $('.photoLabel').html('Update Photo Plus')
        $('.updateButton').html('Update')
        $('input[name="nama_foto"]').val(dataFoto)
        $('select[name="produkId"]').val(produkId)
        $('form[name="photoForm"]').attr('action', `{{ url('/product/photo/update/${photoId}') }}`)

        $('.closePhoto').on('click', function(){
            location.reload();
        })
    }

    function detachPhoto(val){
        window.event.preventDefault()
        let fotoId = $(val).data('fotoid'),
            produkId = $(val).data('produk');

        $.ajax({
            url:"{{ url('/product/photo/delete') }}",
            type:"POST",
            dataType:"JSON",
            data:{
                _token:"{{ csrf_token() }}",
                fotoId:fotoId,
                produkId:produkId
            },
            success: function(data){
                console.log(data)
                location.reload();
            }
        })
    }
</script>
@endsection
