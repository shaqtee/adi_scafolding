@extends('admin.index')

@section('css')
@endsection

@section('content')

    <h2>Data Alamat Pengiriman</h2>
    <div class="row">
        <div class="col-md-12 col-12">
            <table class="table table-dark table-sm">
                <thead>
                <tr class="text-primary">
                    <th scope="col">User</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">KodePos</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Propinsi</th>
                    <th scope="col">Updated</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($pengiriman as $p)
                    <tr>
                        <th scope="row">{{ $p['pengirimanable_id'] }}</th>
                        <td>{{ $p['alamat'] }}</td>
                        <td>{{ $p['kode_pos'] }}</td>
                        <td>{{ $p['kota'] }}</td>
                        <td>{{ $p['propinsi'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($p['updated_at'])) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
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
