@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
    <h3>Deposit</h3>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="d-flex card p-3">
                <form id="deposit_form" method="" action="">
                    <div class="col">
                        <div class="col">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">code</span>
                                </div>
                                <input type="text" name="deposit" class="form-control col-4" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value="{{ 'dep-'.uniqid() }}">
                            </div>
                        </div>
                    <div class="col mt-3">
                        <div class="input-group input-group-sm">
                            <label><b>Nominal</b></label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-gradient-dark text-white" id="inputGroup-sizing-sm">Rp.</span>
                            </div>
                            <input type="text" name="amount" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Masukkan Nominal Deposit">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                    </div>
                    </div>
                    </div>
                </form>
            </div>
        <div class="col-md-6">

        </div>
    </div>


    @section('js')
    <script src="{{
        !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('services.midtrans.clientKey')
    }}"></script>

    <script>

            $("#deposit_form").on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url:"{{ url('/api/member/deposit') }}",
                type:"POST",
                dataType:"JSON",
                data: {
                    _token:"{{ csrf_token() }}",
                    deposit:$('input[name="deposit"]').val(),
                    user_id:@php echo json_encode(auth()->user()->id); @endphp,
                    guest_name:@php echo json_encode(auth()->user()->name); @endphp,
                    guest_email:@php echo json_encode(auth()->user()->email); @endphp,
                    amount:$('input[name="amount"]').val(),
                    note:"midtrans_check"
                },
                success: function (data, status){
                    console.log(data);
                    snap.pay(data.snap_token, {
                        // Optional
                        onSuccess: function (result) {
                            location.reload();
                        },
                        // Optional
                        onPending: function (result) {
                            location.reload();
                        },
                        // Optional
                        onError: function (result) {
                            location.reload();
                        }
                    });
                    return false;
                }
            });

        })
    </script>
    @endsection
@endsection
