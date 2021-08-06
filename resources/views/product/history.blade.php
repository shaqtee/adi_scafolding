@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
    <h3>Riwayat Transaksi Produk</h3>
    <div class="row">
        <div class="col-md-12 col-12">
            <table class="table table-dark">
                <thead>
                    <tr class="text-primary">
                    <th scope="col">#</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Item</th>
                    <th scope="col">Berat Total</th>
                    <th scope="col">ُEkspedisi</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Dest</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Ongkir</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataPayment as $dp)
                    <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $dp['invoice'] }}</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>{{ $dp['subtotal'] }}</td>
                    <td>{{ $dp['ongkir'] }}</td>
                    <td>{{ number_format($dp['amount'],0,",",".") }}</td>
                    @if($dp['status'] === "process")
                    <td class="text-warning">{{ $dp['status'] }}</td>
                    @elseif($dp['status'] === "done")
                    <td class="text-success">{{ $dp['status'] }}</td>
                    @elseif($dp['status'] === "expired")
                    <td class="text-danger">{{ $dp['status'] }}</td>
                    @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
