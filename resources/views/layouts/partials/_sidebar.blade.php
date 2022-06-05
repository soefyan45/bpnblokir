<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">@yield('siteName')</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">BPN</a>
        </div>
        {{-- <li>{{auth()->user()}}</li> --}}
        @role('Petugas')
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li>
                <a class="nav-link" href="{{route('officerIndex')}}">
                    <i class="fas fa-pencil-ruler"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{route('officer.riwayatblokir')}}">
                    <i class="fas fa-columns"></i> <span>Riwayat Pengajuan</span>
                </a>
            </li>
            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Blokir Online</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('apps.blokir')}}">Pengajuan Blokir Online</a></li>
                    <li><a class="nav-link" href="{{route('apps.riwayatblokir')}}">Riwayat Pengajuan Blokir</a></li>
                </ul>
            </li> --}}
            <li>
                <a class="nav-link" href="{{route('officer.reportBlokir')}}">
                    <i class="fas fa-pencil-ruler"></i> <span>Report</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Setting</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('officer.settingPetugas')}}">Petugas</a></li>
                    <li><a class="nav-link" href="{{route('officer.settingPemohon')}}">Pemohon</a></li>
                    <li><a class="nav-link" href="{{route('officer.settingPenjabat')}}">Penjabat</a></li>
                </ul>
            </li>
        </ul>
        @endrole
        @role('Pemohon')
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li>
                <a class="nav-link" href="{{route('appsIndex')}}">
                    <i class="fas fa-pencil-ruler"></i> <span>Pemohon</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Blokir Online</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('apps.blokir')}}">Pengajuan Blokir Online</a></li>
                    <li><a class="nav-link" href="{{route('apps.riwayatblokir')}}">Riwayat Pengajuan Blokir</a></li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{route('apps.profile')}}">
                    <i class="fas fa-pencil-ruler"></i> <span>Profile</span>
                </a>
            </li>
        </ul>
        @endrole
    </aside>
</div>
