@extends('layouts.blankadmin')

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

    <div class="col-md-4 col-lg-4 mt-2 input-group">
        <input class="form-control text-danger" placeholder="Check error...." value="{{ $errors->any() ? 'Cek kembali inputan anda, data belum berhasil ditambahkan.' : session('status')}}" disabled>
    </div>
    <!-- Left Column -->
    <div class="col-md-4 col-lg-4 ml-auto mt-2">
        <!-- Search -->
        <div class="card shadow">
            <div class="input-group">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name=searchTable id="searchTable">
            </div>
        </div>
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
            <tbody id="dataproduk">
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
</div>

<div class="modal fade" id="modalTambahProduk" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content justify-content-center py-3 bg-dark">
<!-- Modal Tambah Produk-->
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
                <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('nama_produk') }}" required>
                @error('nama_produk')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- harga -->
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Harga</span>
                </div>
                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- deskripsi -->
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"  id="inputGroup-sizing-sm">Deskripsi</span>
                </div>
                <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('deskripsi') }}" required>
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
                <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('kategori') }}" required>
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
                    <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" onchange="readURL(this)" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" value="old('foto')" required>
                    <label class="custom-file-label text-center" for="inputGroupFile01" id="namafile">Choose file</label>
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
<!-- End Modal Tambah Produk-->
</div>
</div>
</div>

<div class="modal fade" id="modalUpdateProduct" tabindex="-1" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content justify-content-center py-3 bg-dark">
<!-- Modal Update Produk-->
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
                <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('nama_produk') }}" required>
                @error('nama_produk')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- harga -->
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Harga</span>
                </div>
                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="invalid-feedback ml-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- deskripsi -->
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text"  id="inputGroup-sizing-sm">Deskripsi</span>
                </div>
                <input type="text" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('deskripsi') }}" required>
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
                <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror" id="basic-url" aria-describedby="basic-addon3" value="{{ old('kategori') }}" required>
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
                    <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" onchange="readUpdate(this)" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" value="old('foto')">
                    <label class="custom-file-label text-center namafile" for="inputGroupFile01" id="namafile">Choose file</label>
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
<!-- End Modal Update Produk-->
</div>
</div>
</div>


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
        console.log($(this).attr('data-id'))
        let idHapus = $(this).attr('data-id');
        $('.hapusData').attr('action', `{{ url('product/${idHapus}') }}`)
    })

    $('#searchTable').keyup(function(e){
        e.preventDefault();
        $.ajax({
            url: "{{ url('/product/searchproducts') }}",
            dataType:'JSON',
            type: 'POST',
            data: {
                _token:"{{ csrf_token() }}",
                'keyword':$('#searchTable').val()
            },
            success:function(response){

                $("#dataproduk").empty();
                let i = 1;
                $.each(response, function(index, prod){
                    $("#dataproduk").append(
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
                            console.log(response)
                            let cekFile = $("input[type=file]").val()
                            console.log(cekFile.length)
                            $(".updateform").attr('action', `/product/${response.id}`)
                            $("input[name=nama_produk]").val(`${response.nama_produk}`)
                            $("input[name=harga]").val(`${response.harga}`)
                            $("input[name=deskripsi]").val(`${response.deskripsi}`)
                            $("input[name=kategori]").val(`${response.kategori}`)
                            $(".foto").attr("src", response.foto.length >= 22 ? 'https://place-hold.it/200x200/' : `{{ asset('images/produk/${response.foto}') }}`)
                            $(".namafile").html(response.foto)
                        }
                    })
                })

                /* Delete Saat Live Search */
                $('.modalHapus').on('click', function(){
                    console.log($(this).attr('data-id'))
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
                console.log(response.foto.length)
                $(".updateform").attr('action', `/product/${response.id}`)
                $("input[name=nama_produk]").val(`${response.nama_produk}`)
                $("input[name=harga]").val(`${response.harga}`)
                $("input[name=deskripsi]").val(`${response.deskripsi}`)
                $("input[name=kategori]").val(`${response.kategori}`)
                $(".foto").attr("src", response.foto.length >= 22 ? 'https://place-hold.it/200x200/' : `{{ asset('images/produk/${response.foto}') }}`)
                $(".namafile").html(response.foto)
            }
        })
    })

    function readUpdate(input) {
        console.log(input.files)
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
</script>
@endsection
