@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
<div class="d-flex align-items-center">
<h3>Claim Bonus</h3>
<span>&nbsp;&nbsp;switch</span>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body p-2">
                <form action="{{ url('home/claim/store') }}" method="POST">
                    @csrf
                    <b>Swithing</b> : Memindahkan Saldo Bonus ke Saldo Utama.<br>
                    <div class="mt-3" for="basic-url">Nominal Switching</div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Rp.</span>
                        </div>
                        <input name="claim" type="number" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Masukkan Nominal Switching">
                    </div>
                    <div class="mt-3" for="basic-url">Kata Sandi</div>
                        <input name="password" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Masukkan Kata Sandi">

                    <br>
                    @if(session('status'))
                    <div class="alert alert-dark alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="justify-content-end text-right" style="font-size:0.9em;">
                    <a href="" class=""for=""><b>Saldo Utama Anda Saat Ini.</b></a>
                    </div>
                    <div class="justify-content-end text-right" style="font-size:0.8em;">
                    <b>Rp{{ number_format($dataUser,0,",",".") }}</b>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block mt-3"> Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>




    @section('js')
    @endsection
@endsection
