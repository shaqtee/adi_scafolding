@extends('layouts.public')

@section('css')
    <style>
.mycol{
    border:2px solid red;
}
    </style>
@endsection

@section('public_content')

@include('layouts.public.top')

<div class="container mt-3">

    <div class="row mb-4">
        <div class="col-md-8">
            <div class="row-12 card text-center align-middle">
                <div id="cekresicom_id" class="text-center"></div>
            </div>
            <div class="row-12 mt-3">
                <div class="card">
                    <div class="card-header">Destination</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Kota/Kab Asal</td>
                                    <td>Kota/Kab Tujuan</td>
                                    <td>Berat</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $origin->title }}</td>
                                    <td>{{ $destination->title }}</td>
                                    <td>{{ $weight }}gr</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @foreach ($result as $cost)
                <div class="row-12 mt-3">
                    <div class="card">
                        <div class="card-header">{{ $cost[0]['name'] }}</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Layanan</td>
                                        <td>Estimasi Hari</td>
                                        <td>Ongkir</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cost[0]['costs'] as $cost)
                                        <tr>
                                            <td>{{ $cost['description'] }} ({{$cost['service']}})</td>
                                            <td>{{ $cost['cost'][0]['etd'] }}</td>
                                            <td>Rp{{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4 mt-3">
            <div class="card align-self-center p-4">
                <div data-theme="light" id="rajaongkir-widget" class="p-0 m-0"></div>
            </div>
        </div>
    </div>

</div>

@include('layouts.public.bottom')

@endsection

@section('js')
    <script type="text/javascript" src="//rajaongkir.com/script/widget.js"></script>

    {{-- Searching --}}
    <script>
        $("#inputSearch").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".produkLoop div").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>

    <script type="text/javascript" src="https://cekresi.com/widget/widgetcekresicom_v1.js"></script>
    <script type="text/javascript">
    init_widget_cekresicom('w3',370,80)
    </script>
@endsection
