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
                        <p class="bg-dark text-success">{{ session('status') }}</p>
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
                        <li class="list-group-item">
                            <a href="" data-toggle="modal" data-target="#editMenu" onclick="editMenu(this)">{{ $menu['sort_menu'] }} - {{ $menu['menu_name'] }}</a> | <a href="{{ url('/admin/productmenu/'.$menu['sort_menu'].'/delete') }}" class="badge badge-danger">del</a>
                        </li>
                        @endforeach
                        <div class="mt-2">{{ $menus->links() }}</div>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Container-fluid -->

    <!-- modal editMenu -->
    <div class="modal fade" id="editMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Menu PPOB</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="" method="POST" name="sortMenu">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label">sort_id:</label>
                    <input type="number" class="form-control col-2" id="sort_id" name="sort_id">
                    </div>
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Menu:</label>
                    <input type="text" class="form-control" id="menu" name="menu">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="updateMenu()">Update</button>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function editMenu(val)
        {
            let sortMenu = $(val).html().split(" - ")[0],
                menu = $(val).html().split(" - ")[1];
            console.log(sortMenu)
            $('#sort_id').val(sortMenu)
            $('#menu').val(menu)
            $('form[name="sortMenu"]').attr('action', `{{ url('/admin/productmenu/update/${sortMenu}') }}`)
        }

        function updateMenu()
        {

        }
    </script>

@endsection
