<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">GETCO</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(request()->routeIs('home')) active @endif">
        <a class="nav-link " href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
        <hr class="sidebar-divider">
    </li>

    <!-- Nav Item - Tables -->
    {{-- ADMIN --}}
    @role('Admin')
    <li class="nav-item @if(request()->routeIs('akun-premium')) active @endif">
        <a class="nav-link" href="{{ route('akun-premium') }}">
            <i class="fa-solid fa-store"></i>
            <span>{{ __('Akun Premium') }}</span>
        </a>
    </li>
    @endrole

    {{-- PEMILIK USAHA --}}
    @role('Pemilik Usaha')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo" style="padding-top: inherit;">
            <i class="fa-solid fa-store"></i>
            <span>Bahan Baku</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pemilik-bahan-baku.index') }}">Bahan Baku Owner</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if(request()->routeIs('kerja-sama.index')) active @endif">
        <a class="nav-link" href="{{ route('kerja-sama.index') }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>{{ __('Pencatatan Bahan Baku') }}</span>
        </a>
    </li>
    @if (Auth::user()->is_premium)
    <li class="nav-item @if(request()->routeIs('kalkulator-produksi')) active @endif">
        <a class="nav-link" href="{{ route('kalkulator-produksi') }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>{{ __('Kalkulator Produksi') }}</span>
        </a>
    </li>
    @endif
    <hr class="sidebar-divider">
    <li class="nav-item @if(request()->routeIs('pemilik-pemasukan.index')) active @endif">
        <a class="nav-link" href="{{ route('pemilik-pemasukan.index') }}">
            <i class="fa-solid fa-store"></i>
            <span>{{ __('Pemasukan Pemilik Usaha') }}</span>
        </a>
    </li>
    <li class="nav-item @if(request()->routeIs('pemilik-pengeluaran.index')) active @endif">
        <a class="nav-link" href="{{ route('pemilik-pengeluaran.index') }}">
            <i class="fa-solid fa-store"></i>
            <span>{{ __('Pengeluaran Pemilik Usaha') }}</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item @if(request()->routeIs('laporan-keuangan-own')) active @endif">
        <a class="nav-link" href="{{ route('laporan-keuangan-own') }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>{{ __('Laporan Keuangan Owner') }}</span>
        </a>
    </li>
    @endrole

    {{-- SUPPLIER --}}
    @role('Supplier')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo" style="padding-top: inherit;">
            <i class="fa-solid fa-store"></i>
            <span>Bahan Baku</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('supplier-bahan-baku.index') }}">Bahan Baku Supplier</a>
            </div>
        </div>
    </li>
    <li class="nav-item @if(request()->routeIs('kerja-sama.index')) active @endif">
        <a class="nav-link" href="{{ route('kerja-sama.index') }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>{{ __('Pencatatan Bahan Baku') }}</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item @if(request()->routeIs('laporan-keuangan-sup')) active @endif">
        <a class="nav-link" href="{{ route('laporan-keuangan-sup') }}">
            <i class="fa-solid fa-file-pen"></i>
            <span>{{ __('Laporan Keuangan Supplier') }}</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <li class="nav-item @if(request()->routeIs('supplier-pemasukan.index')) active @endif">
        <a class="nav-link" href="{{ route('supplier-pemasukan.index') }}">
            <i class="fa-solid fa-store"></i>
            <span>{{ __('Pemasukan Supplier') }}</span>
        </a>
    </li>
    @endrole
    
    @role(['Pemilik Usaha', 'Supplier'])
    <hr class="sidebar-divider">
    <li class="nav-item @if(request()->routeIs('syarat-akun-premium.index')) active @endif">
        <a class="nav-link" href="{{ route('syarat-akun-premium.index') }}">
            <i class="fa-solid fa-store"></i>
            <span>{{ __('Syarat Akun Premium') }}</span>
        </a>
    </li>
    @endrole
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline pt-4">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
