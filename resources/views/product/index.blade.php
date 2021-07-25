@extends('layouts.blankadmin')

@section('css')
@endsection

@section('content')

<button class="btn btn-primary" data-toggle="modal" data-target="#modalKategori">Kategori</button>
<button class="btn btn-primary" data-toggle="modal" data-target="#modalTag">Tag</button>

<!-- Modal Kategori -->
<div class="modal fade" id="modalKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Kategori :</h5>
            </div>
            <div class="modal-body">
                <a href="">Barang Bekas</a> ,
                <a href="">Bahan Kue</a> ,
                <a href="">Produk Digital</a> ,
                <a href="">Fashion</a> ,
                <a href="">Kesehatan</a> ,
                <a href="">Sembako</a> ,
                <a href="">Snack</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Kategori -->

<!-- Modal Tag -->
<div class="modal fade" id="modalTag">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Tag :</h5>
            </div>
            <div class="modal-body">
                <a href="">Furniture</a> ,
                <a href="">Tas</a> ,
                <a href="">Peralatan</a> ,
                <a href="">Aksesoris</a> ,
                <a href="">Sweater</a> ,
                <a href="">Sepatu</a>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tag -->
@endsection
