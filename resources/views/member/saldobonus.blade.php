@extends('member.index')
@section('css')
<style>
    .mycol{
        border:2px solid red;
    }
</style>
@endsection
@section('container')
    <h3>Mutasi Saldo Bonus</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-sm table-dark">
                    <thead>
                    <tr class="text-warning">
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Note</th>
                    </tr>
                    </thead>
                    <tbody style="font-size:0.8em;">
                    @foreach($data as $d)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $d['uuid'] }}</td>
                        <td>{{ $d['updated_at'] }}</td>
                        @if($d['type'] == 'kredit')
                        <td class="text-success">{{ $d['type'] }}</td>
                        @else
                        <td class="text-primary">{{ $d['type'] }}</td>
                        @endif
                        <td>{{ number_format($d['nominal'],0,",",".") }}</td>
                        <td>{{ number_format($d['saldo'],0,",",".") }}</td>
                        <td>{{ $d['note'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>

        </div>
    </div>

    @section('js')
        <script>

        </script>
    @endsection
@endsection
