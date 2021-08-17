@extends('admin.index')
@section('css')
<style>
    /*.changeMonth .ui-datepicker-calendar {
        display: none;
    }*/
    </style>
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex flex-wrap align-items-center justify-content-between mb-3">
            <div class="text-center">
                <a href="/checkout" class=" btn btn-sm btn-secondary shadow-sm border border-white">Back to Checkout</a>
                <a href="/" class="btn btn-sm btn-secondary shadow-sm border border-white">Go Shop</a>
            </div>
            <div class="text-center">
            <a href="#" class="btn btn-sm btn-danger btn-block shadow-sm liveMode">
                Live Mode
            </a>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Saldo Utama User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($allUserSaldo,0,",",".") }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Saldo Bonus User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($allUserBonus,0,",",".") }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Saldo Digiflazz</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">-</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-2">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Alfabet Shop Product</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body p-0">
                            <div id="reasons-div"></div>
                            @piechart('reasons', 'reasons-div')
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card shadow mb-2">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Alfabet PPOB</h6>
                            <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-0">
                        <div id="ppob-div"></div>
                        @piechart('ppob', 'ppob-div')
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-6 my-2">
                <!-- Color System -->
                <div class="row">
                    <div class="col-lg-6 mb-2">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body text-center">
                        Transaksi
                        <div class="text-white h4 text-center">1001</div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body text-center">
                        Transaksi Bulan Agustus
                        <div class="text-white h4 text-center">523</div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 my-2">

                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body text-center">
                            Users
                            <div class="text-white h4 text-center">215</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body text-center">
                            Deposit Bulan Agustus
                            <div class="text-white h4 text-center">508</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6 col-12">
                <ul class="list-group mb-1">
                    <li class="list-group-item text-center active" aria-current="true">Deposit</li>
                    <li class="list-group-item text-center">
                        1652
                    </li>
                </ul>
                <select class="custom-select" id="validationTooltip04" required>
                    <option selected disabled value="">Check Member Saldo</option>
                    <option>...</option>
                </select>
                <div class="invalid-tooltip">
                    Please select a valid state.
                </div>
                <div class="table-responsive mt-1">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">Menunggu</th>
                                <th scope="col">Validasi</th>
                                <th scope="col">Berhasil</th>
                                <th scope="col">Gagal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th>101</th>
                                <td>202</td>
                                <td>531</td>
                                <td>25</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <div class="card p-2">
                    <div class="bg-success p-2 text-white text-center rounded">
                        <span mt-5>Top 5 User Bulan - X</span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @for($i = 0; $i < 5; $i++)
                        <div class="p-2 text-center mt-3">
                            <img src="https://place-hold.it/70x70" alt=""><br>
                            <span><a href="" class='text-success'><b>Member</b></a></span>
                        </div>
                        @endfor
                    </div>
                    <hr>
                    <a href="" class="text-center">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">

            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6 mb-3">
                <span for="" class="mt-3"><b>By Date</b></span>
                <div class="input-group">
                    <input type="text" class="form-control datepicker" aria-label="Dollar amount (with dot and two decimal places)">
                    <div class="input-group-append">
                        <span class="input-group-text">&nbsp;&nbsp;TO&nbsp;&nbsp;</span>
                    </div>
                </div>
                <div class="input-group mt-2">
                    <input type="text" class="form-control datepicker" aria-label="Dollar amount (with dot and two decimal places)">
                    <div class="input-group-prepend" id="button-addon3">
                        <button class="btn btn-outline-secondary" type="button">Filter</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-3">
                <span for="" class="mt-3"><b>By Month</b></span>
                <div class="input-group">
                    <input type="text" class="form-control changeMonth" aria-label="Dollar amount (with dot and two decimal places)">
                    <div class="input-group-prepend" id="button-addon3">
                        <button class="btn btn-outline-secondary" type="button">Filter</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card p-2">
                    <div class="bg-primary p-2 text-white rounded">
                        <span mt-5>Activity</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Transaksi</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Member Baru</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <td>Permintaan Deposit</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pesan Masuk</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="bg-primary p-2 text-white rounded">
                        <span mt-5>Recruitment</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Omset</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Utang Bonus</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <td>Tunai Bonus</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gross Profit Recruitment</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-3">
                <div class="card p-2">

                    <div class="bg-primary p-2 text-white rounded">
                        <span mt-5>Transaksi Produk Utama</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Omset</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>HPP</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <td>Pend. Ongkir</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Beban. Ongkir</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <td>Gross Profit Produk Utama</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                    </table>


                    <div class="bg-primary p-2 text-white rounded">
                        <span mt-5>Transaksi PPOB</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Omset</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Server</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <td>Gross Profit PPOB</td>
                                <td>:</td>
                                <td>0</td>
                                <td><a href="" class="badge badge-primary">lihat</a></td>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody><tr style="background-color: #F8F8F8;font-size: 10px;">
                                <th style="text-align: center;">Berhasil</th>
                                <th style="text-align: center;">Pending</th>
                                <th style="text-align: center;">Gagal</th>
                            </tr>
                            <tr align="center" style="font-size: 15px;font-weight: bold;">
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <div class="card p-2">
                    <div class="bg-danger p-2 text-white text-center rounded">
                        <span mt-5>Member Baru</span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @for($i = 0; $i < 5; $i++)
                        <div class="p-2 text-center mt-3">
                            <img src="https://place-hold.it/70x70" alt=""><br>
                            <span><a href="" class="text-danger"><b>Member</b></a></span>
                        </div>
                        @endfor
                    </div>
                    <hr>
                    <a href="" class="text-center">Lihat Semua</a>
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <div class="card p-2">
                    <div class="bg-danger p-2 text-white text-center rounded">
                        <span mt-5>Request Validasi</span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @for($i = 0; $i < 5; $i++)
                        <div class="p-2 text-center mt-3">
                            <img src="https://place-hold.it/70x70" alt=""><br>
                            <span><a href="" class="text-danger"><b>Member</b></a></span>
                        </div>
                        @endfor
                    </div>
                    <hr>
                    <a href="" class="text-center">Lihat Semua</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <div class="card p-2">
                    <div class="bg-danger p-2 text-white text-center rounded">
                        <span mt-5>Request Transfer Bank</span>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center">
                        @for($i = 0; $i < 5; $i++)
                        <div class="p-2 text-center mt-3">
                            <img src="https://place-hold.it/70x70" alt=""><br>
                            <span><a href="" class="text-danger"><b>Member</b></a></span>
                        </div>
                        @endfor
                    </div>
                    <hr>
                    <a href="" class="text-center">Lihat Semua</a>
                </div>
            </div>

        </div>

    </div>
    <!-- End of Container-fluid -->
@endsection

@section('js')
<script type="text/javascript" src="packages/jquery-ui/jquery.mtz.monthpicker.js"></script>
<script>
    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true
    });

    $('.changeMonth').monthpicker({
        pattern:'mmmm-yyyy'
    })

    $('.liveMode').on('click', function(){

        if($(this).html() === 'Live Mode'){
            console.log('hai')
        }
    })
</script>
@endsection
