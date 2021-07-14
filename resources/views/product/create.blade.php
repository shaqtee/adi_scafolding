@extends('layouts.blankadmin')
@section('css')
<style>
    .myRow{
        border:2px solid red;
    }
    .myCol{
        border:2px solid blue;
    }
</style>
@endsection
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <a href="{{ route('admin') }}" class="btn btn-outline-primary btn-sm" style="font-size:0.8em;">
        <i class="fa fa-arrow-left fa-sm" aria-hidden="true"></i> Back
        </a>
        
    </h1>
</div>


<div class="d-flex justify-content-center">
    <div class="card shadow-sm">
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            <div class="d-flex justify-content-center">
            <p class='text-center pt-2 font-weight-bold  h5'>Create Product<p>
            </div>
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nama Produk</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>

            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Harga</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>

            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Deskripsi</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>

            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Tag</span>
                </div>
                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>
            <div class="d-flex flew-row justify-content-center flex-grow-1">
                <img class="py-1" src="https://place-hold.it/200x200/">
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <button class="btn btn-primary btn-block rounded-0">Submit</button>
        </form>
    </div>
</div>


@endsection
