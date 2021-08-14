@extends('admin.index')

@section('css')
@endsection

@section('content')

    <h2>History Penjualan Produk Utama</h2>
    <div class="row">
        <div class="col-md-12 col-12">
            @if(session('status'))
                <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(session()->has('failed'))
                <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('failed') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
            <table class="table table-dark table-hover table-sm">
                <thead class="text-center">
                    <tr class="text-primary">
                    <th scope="col">#</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Tgl.</th>
                    <th scope="col">Weight</th>
                    <th scope="col">ُEkspedisi</th>
                    <th scope="col">User</th>
                    <th scope="col">Origin</th>
                    <th scope="col">Dest.</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Ongkir</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Exec</th>
                    </tr>
                </thead>
                <tbody style="font-size:0.8em;" class="text-center">
                    @foreach($dataPayment as $dp)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td><a data-toggle="modal" data-target="#invoiceDetail"class="text-success" href="" onclick="showInvoiceDetails(this)">{{ $dp['invoice'] }}</a></td>
                        <td>{{ date('d-m-Y', strtotime($dp['created_at'])) }}</td>

                        @if( !empty(explode("|",$dp['unit_weight'])[1]) )
                            <td>
                                @php
                                    $qty = explode("|",$dp['unit_qty']);
                                    unset($w_unit);
                                    foreach(explode("|",$dp['unit_weight']) as $k => $v){
                                    $w_unit[] = intval($v) * intval($qty[$k]);
                                    }
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

                        <td>{{ $dp['user_id'] }}</td>

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
                            <td class="text-warning align-middle">
                                {{ $dp['status'] }}
                            </td>
                            @elseif($dp['status'] === "refund")
                            <td class="text-danger align-middle">
                                {{ $dp['status'] }}
                            </td>
                            @else
                                <td class="text-success align-middle">
                                    {{ $dp['status'] }}
                                </td>
                        @endif
                        <td>
                            @if($dp['status'] === 'process')
                                <a href="" data-invoice="{{ $dp['invoice'] }}" onclick="refundMainProd(this)" data-toggle="modal" data-target="#refundMainProd" class="badge badge-success text-dark">refund</a>
                                <a href="" data-invoice="{{ $dp['invoice'] }}" onclick="successMainProd(this)" data-toggle="modal" data-target="#successMainProd" class="badge badge-primary">success</a>
                            @endif
                        </td>
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
            <!-- Modal Invoice-->
            <div class="modal fade" id="invoiceDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Invoice Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body" style="font-size: 1em">
                        <div class="d-flex">
                            <div class="col align-self-center">
                                <b>Uuid.</b>
                            </div>
                            <div class="col-8">
                                <input class="col-12" type="text" name="uuid" disabled>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-wrap itemDetails mt-2">

                        </div>
                        <div class="d-flex p-0">
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

            <!-- Modal Success -->
            <div class="modal fade" id="successMainProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Success Delivered</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/admin/history/success') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Invoice:</label>
                                    <input type="text" class="form-control" id="invoiceUuid" name=invoiceUuid readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Proof No.</label>
                                    <input type="text" class="form-control" id="proofNo" name="proof">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form  >
                    </div>
                </div>
            </div>

            <!-- Modal Refund-->
            <div class="modal fade" id="refundMainProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Refund Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ url('/admin/history/refund/'.$dp['invoice']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Refund</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
        <script>
            function showInvoiceDetails(val){
                invoice = val.innerHTML
                $.ajax({
                    url:"{{ url('/admin/history/showinvoice') }}",
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
                                    <div class="col">
                                        <b>Item :</b> ${item}
                                    </div>
                                    <div class="col">
                                        <b>Qty :</b> ${data.qty[key]}
                                    </div>
                                    <div class="col">
                                        <b>Price :</b> ${formatter.format(data.price_before_disc[key])}
                                    </div>

                                    <div class="col">
                                        <b>Disc :</b> ${parseFloat(data.disc[key]).toFixed(0)+"% -"+formatter.format(data.disc_price[key])}
                                    </div>

                                    <div class="col">
                                        <b>Weight :</b> ${data.weight[key]}
                                    </div>
                                    <div class="col">
                                        <b>Price(ad) :</b> ${formatter.format(data.price[key])}
                                    </div><br>
                            `)
                        })
                    }
                })
            }

            function successMainProd(val){
                let invoice = $(val).data('invoice')
                $('#invoiceUuid').val(invoice)
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
