<div class="main-sidebar">
    <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{route("home")}}">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
            <a href="{{route("home")}}"><i class="fas fa-fire"></i> <span>Toko Online</a>
        </li>
        @if (Auth::user()->permission== "admin" || Auth::user()->permission== "penjual")   
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-circle"></i> <span>Barang</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route("barang.index")}}">List Barang</a></li>
                <li><a class="nav-link" href="{{route("barang.create")}}">Tambah Barang</a></li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->permission=="admin")
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-user"></i> <span>User</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route("user.index")}}">List User</a></li>
                </ul>
            </li>
        @endif
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> <span>Troli</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route("barang.checkout")}}">List Pesanan</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-arrow-left"></i> <span>History</span></a>
            <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route("history.index")}}">List History</a></li>
            </ul>
        </li>
        </ul>
    </aside>
</div>