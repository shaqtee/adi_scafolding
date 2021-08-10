@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
    <h3>Transfer Bank History</h3>

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
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $tb['user_name'] }}</td>
            <td>{{ $tb['mutasi_id'] }}</td>
            <td>{{ $tb['bank'] }}</td>
            <td>{{ $tb['rek'] }}</td>
            <td>{{ $tb['nama'] }}</td>
            <td>{{ number_format($tb['nominal'],0,",",".") }}</td>
            <td>{{ number_format($tb['biaya'],0,",",".") }}</td>
            <td>{{ number_format($tb['saldo_before_trx'],0,",",".") }}</td>
            <td>{{ number_format($tb['saldo_after_trx'],0,",",".") }}</td>

            @if($tb['status'] === 'process')
            <td class="text-warning">{{ $tb['status'] }}</td>
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
    {{ $transferBank->links() }}

    @section('js')

    @endsection
@endsection
