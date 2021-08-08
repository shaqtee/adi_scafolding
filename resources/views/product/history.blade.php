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
            @if(session('status'))
                <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
            <table class="table table-dark table-sm">
                <thead>
                    <tr class="text-primary">
                    <th scope="col">#</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Tgl.</th>
                    <th scope="col">Weight</th>
                    <th scope="col">ُEkspedisi</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Dest.</th>
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
                        <td><a data-toggle="modal" data-target="#invoiceDetail"class="text-success" href="" onclick="showInvoiceDetails(this)">{{ $dp['invoice'] }}</a></td>
                        <td>{{ date('d-m-Y', strtotime($dp['created_at'])) }}</td>

                        @if( !empty(explode("|",$dp['unit_weight'])[1]) )
                            <td>
                                @php
                                    $qty = explode("|",$dp['unit_qty']);
                                    foreach(explode("|",$dp['unit_weight']) as $k => $v)
                                    $w_unit[] = intval($v) * intval($qty[$k]);
                                @endphp
                                {{--{{ dump($w_unit) }}--}}
                                {{ array_reduce($w_unit, function($acc, $item){return $acc+$item;}) }}
                            </td>
                        @else
                            <td>{{ intval($dp['unit_qty']) * intval($dp['unit_weight']) }}</td>
                        @endif

                        @if(!empty(explode("|", $dp['courier_service'])))
                            <td>
                                {{
                                array_reduce(
                                explode("|", $dp['courier_service']),
                                function($acc, $item){return strtoupper($acc)." ".$item;})
                                }}
                            </td>
                        @else
                        <td class="text-danger">{{ __('err') }}</td>
                        @endif

                        <td>Sidoarjo</td>
                        @if(intval($dp['kota']) !== 0)
                            <td>
                                @php
                                    $origin = \App\Models\City::select('title')->where('id',$dp['kota'])->first()['title'];
                                @endphp
                                {{ $origin }}
                            </td>
                        @else
                            <td class="text-danger">{{ __('err') }}</td>
                        @endif


                        <td>{{ number_format($dp['subtotal'],0,",",".") }}</td>
                        <td>{{ number_format($dp['ongkir'],0,",",".") }}</td>
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
            {{ $dataPayment->links() }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <!-- Modal -->
            <div class="modal fade" id="invoiceDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Invoice Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div class="col align-self-center">
                                <b>Uuid.</b>
                            </div>
                            <div class="col-8">
                                <input class="col-12" type="text" name="uuid" disabled>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="col-3">
                                <b>Item</b>
                            </div>
                            <div class="col-3">
                                <b>Qty</b>
                            </div>
                            <div class="col-3">
                                <b>Weight</b>
                            </div>
                            <div class="col-3">
                                <b>price/unit</b>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap itemDetails">

                        </div>
                        <div class="d-flex mt-4 p-0">
                            <div class="col">
                                <b>Nama</b>
                            </div>
                            <div class="col-8">
                                <input class="p-0 col-12" type="text" name="nama" disabled>
                            </div>
                        </div>
                        <div class="d-flex p-0 mt-1">
                            <div class="col">
                                <b>Alamat</b>
                            </div>
                            <div class="col-8">
                                <input class="p-0 col-12" type="text" name="alamat" disabled>
                            </div>
                        </div>
                        <div class="d-flex p-0 mt-1">
                            <div class="col">
                                <b>Kontak</b>
                            </div>
                            <div class="col-8">
                                <input class="p-0 col-12" type="text" name="kontak" disabled>
                            </div>
                        </div>
                        <div class="d-flex p-0 mt-1">
                            <div class="col">
                                <b>Pesan</b>
                            </div>
                            <div class="col-8">
                                <input class="p-0 col-12" type="text" name="pesan" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
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

        function showInvoiceDetails(val){
            invoice = val.innerHTML
            $.ajax({
                url:"{{ url('/home/history/showdetails') }}",
                type:"POST",
                dataType:"JSON",
                data:{
                    _token:"{{ csrf_token() }}",
                    invoice:invoice
                },
                success: function(data){
                    console.log(data)
                    $('.itemDetails').empty()
                    $('input[name="uuid"]').val(data.invoice)
                    $('input[name="nama"]').val(data.guest_name)
                    $('input[name="alamat"]').val(data.address)
                    $('input[name="kontak"]').val(data.phone)
                    $('input[name="pesan"]').val(data.note)

                    data.u_item.forEach(function(item,key,arr){
                        $('.itemDetails').append(`
                                <div class="col-3">
                                    ${item}
                                </div>
                                <div class="col-3">
                                    ${data.qty[key]}
                                </div>
                                <div class="col-3">
                                    ${data.weight[key]}
                                </div>
                                <div class="col-3">
                                    ${formatter.format(data.price[key])}
                                </div><br>
                        `)
                    })
                }
            })
        }

        $("#inputSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {

                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        @if(session('status'))
            $('tbody tr:first-child').css('background-color','brown')
        @endif
    </script>
    @endsection
@endsection
