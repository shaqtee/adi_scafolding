@extends('admin.index')

@section('css')
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Topbar Search -->
        <form class="container col-sm-4 navbar-search py-3">
            <div class="input-group shadow">
                <input id="inputSearch" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        {{-- Here --}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        @php $users = DB::table('users')->orderBy('last_login', 'DESC')->paginate(4); @endphp

                        <div class="container produkLoop">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Last Login</th>
                                    <th>Last Logout</th>
                                    <th>Online > 1 mnt</th>
                                    <th>Live</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->last_login}}</td>
                                        <td>{{$user->last_online}}</td>
                                        <td>{{$user->online}}</td>
                                        <td>
                                            @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-success">Yes</span>
                                            @else
                                                <span class="text-secondary">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- endHere --}}

    </div>
    <!-- End of Container-fluid -->
@endsection

@section('js')
<script>
$("#inputSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});
</script>
@include('layouts.public.chart')
@endsection
