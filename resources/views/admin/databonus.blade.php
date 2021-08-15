@extends('admin.index')

@section('css')
@endsection

@section('content')

    <h2>Data Bonus All Member</h2>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="table-responsive">
                <table class="table table-dark table-hover table-sm">
                    <thead>
                    <tr class="text-primary">
                        <th scope="col">User</th>
                        <th scope="col">uuid.</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Saldo Bonus</th>
                        <th scope="col">note.</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($bonus as $b)
                        <tr>
                            <th scope="row">{{ $b['user_id'] }}</th>
                            <td>{{ $b['uuid'] }}</td>
                            <td>{{ $b['created_at'] }}</td>
                            <td>{{ $b['type'] }}</td>
                            <td>{{ $b['nominal'] }}</td>
                            <td>{{ $b['saldo'] }}</td>
                            <td>{{ $b['note'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
