@extends('admin.index')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <form action="{{ url('/admin/productmenu/store') }}" method="POST">
                    @csrf
                    <div class="col p-2 bg-white shadow mb-2 text-center">
                        <h5>Menu PPOB dasboard member :</h5>
                        <p>{{ session('status') }}</p>
                        <div class="row row-cols-md-1 ">
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Menu</span>
                                    </div>
                                    <input name="menu_name" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Icon</span>
                                    </div>
                                    <input name="icon" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Jenis</span>
                                    </div>
                                    <input name="jenis" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Sort</span>
                                    </div>
                                    <input name="sort_menu" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-sm btn-block">submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <div class="d-flex">
                    <ul class="list-group">
                        @foreach($menus as $menu)
                        <li class="list-group-item">{{ $menu['sort_menu'] }} - {{ $menu['menu_name'] }}</li>
                        @endforeach
                        <div class="mt-2">{{ $menus->links() }}</div>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Container-fluid -->
@endsection

@section('js')
@include('layouts.public.chart')
@endsection
