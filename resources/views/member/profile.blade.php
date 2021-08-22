@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')

    <h2>Profile</h2>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center border-left-primary shadow p-1">
                <div class="py-2">
                    @if(auth()->user()->image === NULL)
                    <img class="rounded-circle" width="100" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    @else
                    <img class="rounded-circle shadow" src="{{ asset('/images/member/profile/'.auth()->user()->image) }}" width="100" alt="">
                    @endif
                </div>
                <div>
                    <label class="p-0"><b>{{ auth()->user()->name }}</b><br>
                        <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;
                        <span style="font-size:0.8em;line-height:-0.5px;" class="p-0">Rp {{ number_format(auth()->user()->saldo,0,",",".") }}</span>
                    </label>
                </div>
                <div>
                    <div class="form-group row row-cols-3 justify-content-between" style="font-size:0.7em">
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>Email</b></label>
                        </div>
                        <div class="col col-8">
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>Phone</b></label>
                        </div>
                        <div class="col col-8">
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>City</b></label>
                        </div>
                        <div class="col col-8">
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ auth()->user()->city }}">
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>Reg.</b></label>
                        </div>
                        <div class="col col-8">
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ auth()->user()->created_at }}">
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>Last Login</b></label>
                        </div>
                        <div class="col col-8">
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ auth()->user()->last_login }}">
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>Bank</b></label>
                        </div>
                        <div class="col col-8">
                            @if(empty($bank))
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="-">
                            @else
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ $bank['name'] }}">
                            @endif
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>AN.</b></label>
                        </div>
                        <div class="col col-8">
                            @if(empty($bank))
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="-">
                            @else
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->banks['nama'] }}">
                            @endif
                        </div>
                        <div class="col col-4">
                            <label for="staticEmail" class="col col-form-label">
                                <b>No. Rek</b></label>
                        </div>
                        <div class="col col-8">
                            @if(empty($bank))
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="-">
                            @else
                            <input type="text" style="font-size:1em" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->banks['rek'] }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-left-primary pb-3">
                        <div class="card-header ">
                            <h6 class="mt-3"><b>Setting Alamat Bank</b></h6>
                        </div>
                        <form action="{{ url('/home/profile/bank') }}" method="POST">
                            @csrf
                            <div class="px-3 my-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Atas Nama</span>
                                    </div>
                                    <input name="nama" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                <div class="mt-3">
                                    <select id="bankswifts" name="bankswifts" class="form-control" required>
                                        <option value="">--Select Bank--</option>
                                    </select>
                                </div>
                                <div class="input-group input-group-sm mt-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">No Rekening</span>
                                    </div>
                                    <input name="rek" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                                </div>
                                @error('rek')
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @enderror

                                @if(session('status'))
                                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <button class="mt-3 btn btn-primary btn-sm btn-block">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card border-left-primary">
                        <div class="card-header">
                            <h6 class="mt-3"><b>Ubah Kata Sandi</b></h6>
                        </div>
                        <form action="{{ url('/home/profile/password') }}" method="POST">
                            @csrf
                            <div class="px-3 my-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Lama</span>
                                    </div>
                                    <input name="old" id="old" type="password" class="form-control" aria-label="Amount (to the nearest dollar)">

                                    <div class="input-group-append">
                                        <button onclick="eye(this)" class="old input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <hr>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Baru</span>
                                    </div>
                                    <input name="new" id="new" type="password" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <button onclick="eye(this)" class="new input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">Ulangi</span>
                                    </div>
                                    <input name="new_confirmation" id="renew" type="password" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <button onclick="eye(this)" class="renew input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                @error('new')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @enderror

                                @if(session()->has('password'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session()->get('password') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                @endif
                                <button class="mt-3 btn btn-primary btn-sm btn-block">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
<!-- BankSwifts -->
<script>
    $('#bankswifts').select2({
        ajax:{
            url:'/api/bankswifts',
            type: 'POST',
            dataType: 'JSON',
            delay: 150,
            data: function(data){
                return {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: $.trim(data.term)
                }
            },
            processResults: function(response){
                console.log(response)
                return {
                    results: response
                }
            },
            cache:true
        }
    })

    function eye(val) {
        window.event.preventDefault()
        console.log()
        var x = document.getElementById(val.classList[0]);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<!-- endBankSwifts -->
@endsection

@endsection
