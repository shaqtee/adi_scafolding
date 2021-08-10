<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/'.$url) }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-user-edit" aria-hidden="true"></i>
        </div>
        <div style="font-size:0.7em;" class="sidebar-brand-text mx-3">{{ $role }} <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/'.$url) }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Features
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Account</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Features:</h6>
                <a class="collapse-item" href="{{ url('/home/deposit') }}">Deposit Saldo</a>
                <a class="collapse-item" href="{{ url('/home/send/form') }}">Kirim Saldo</a>
                <a class="collapse-item" href="{{ url('/home/transferbank') }}">Withdrawal/Transfer</a>
                <a class="collapse-item" href="{{ url('/home/claim/form') }}">Claim Bonus</a>
                <h6 class="collapse-header">Setting:</h6>
                <a class="collapse-item" href="{{ url('/pengiriman') }}">Alamat Pengiriman</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Get Promo:</h6>
                <a class="collapse-item" href="#">Redeem Voucher</a>
                <h6 class="collapse-header">Digital Products:</h6>
                <a class="collapse-item" href="#">Unduhan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
            <span>Pengingat Tagihan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        History
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span>Transaksi Produk</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Riwayat:</h6>
                <a class="collapse-item" href="{{ url('/home/history/mainprod') }}">Regular Order</a>
                <a class="collapse-item" href="#">Pulsa Order</a>
                <a class="collapse-item" href="{{ url('/home/history/transferbank') }}">Withdrawal/Transfer</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa fa-history" aria-hidden="true"></i>
        <span>Mutasi</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Account:</h6>
            <a class="collapse-item" href="#">Saldo Utama</a>
            <a class="collapse-item" href="#">Saldo Bonus</a>
        </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profile
    </div>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa fa-users" aria-hidden="true"></i>
        <span>Membership</span>
        </a>
        <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Account:</h6>
            <a class="collapse-item" href="#">My Profile</a>
            <a class="collapse-item" href="#">My Validate</a>
            <a class="collapse-item" href="#">Upgrade</a>
            @role('user')
            <a class="collapse-item" href="#">Referral Statistic</a>
            @endrole
        </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fa fa-question" aria-hidden="true"></i>
            <span>Layanan Bantuan</span>
        </a>
    </li>

    @role('administrator')
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Admin Gate</span>
        </a>
    </li>
    @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
