@extends('admin.index')

@section('css')
@endsection

@section('content')

    <h2 style="font-size:1em;">Request Transfer Bank</h2>
    {{-- Here --}}
    @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-dark">
            <thead>
                <tr class="text-center text-info">
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">trx_id</th>
                    <th scope="col">Bank</th>
                    <th scope="col">No.Rek</th>
                    <th scope="col">An.</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Biaya</th>
                    <th scope="col">Before</th>
                    <th scope="col">After</th>
                    <th scope="col">Status</th>
                    <th scope="col">trf_id</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody style="font-size:0.8em;">
                @foreach($transferBank as $tb)
                <tr class='text-center'>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $tb['user_name'] }}</td>
                    <td><a href="#" class="trxid" data-toggle="modal" data-target="#transferbank">{{ $tb['mutasi_id'] }}</a></td>
                    <td>{{ $tb['bank'] }}</td>
                    <td>{{ $tb['rek'] }}</td>
                    <td>{{ $tb['nama'] }}</td>
                    <td>{{ number_format($tb['nominal'],0,",",".") }}</td>
                    <td>{{ number_format($tb['biaya'],0,",",".") }}</td>
                    <td>{{ number_format($tb['saldo_before_trx'],0,",",".") }}</td>
                    <td>{{ number_format($tb['saldo_after_trx'],0,",",".") }}</td>

                    @if($tb['status'] === 'process')
                    <td class="text-warning text-center">
                        <form action="{{ url('/admin/transferbank/failed') }}" method="POST">
                            @csrf
                            <a href="" data-toggle="modal" data-target="#tbFailed" class="badge badge-danger text-white p-1 tbFailed" data-id="{{ $tb['mutasi_id'] }}">gagalkan&nbsp;&nbsp;</a>
                        </form>
                        {{ $tb['status'] }}
                    </td>
                    @elseif($tb['status'] === 'expired')
                        <td class="text-danger">{{ $tb['status'] }}</td>
                    @else
                        <td class="text-success">{{ $tb['status'] }}</td>
                    @endif

                    <td>{{ $tb['bkt_trf'] }}</td>
                    <td>{{ $tb['updated_at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $transferBank->links() }}
    {{-- endHere --}}

    <!-- Modal -->
    <div class="modal fade" id="transferbank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin/transferbank/success') }}" method="POST" class="inline">
                        @csrf
                        <div class="input-group">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="submit" id="buttonTrf">Enter</button>
                                </div>
                                <input name="bkt_trf" type="text" class="form-control" placeholder="Masukkan Bukti Transfer" aria-label="Example text with button addon" aria-describedby="button-addon1" required>
                                <input name="trx_id" type="text" class="form-control" placeholder="Masukkan Bukti Transfer" aria-label="Example text with button addon" aria-describedby="button-addon1" hidden>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tbFailed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin/transferbank/failed') }}" method="POST" class="inline">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button class="btn btn-danger" type="submit" id="buttonFailed">Delete</button>
                            </div>
                            <input name="trx_id" type="text" class="form-control" placeholder="Masukkan Bukti Transfer" aria-label="Example text with button addon" aria-describedby="button-addon1">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
    $(".searchTable").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('.trxid').on('click', function(){
        let trxid = $(this).html()
        $('input[name="trx_id"]').val(trxid)
    })

    $('.tbFailed').on('click', function(){
        let trxid = $(this).data('id')
        $('input[name="trx_id"]').val(trxid)
    })
    </script>
@endsection
