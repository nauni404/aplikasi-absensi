<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard">Sistem Absensi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Guru</li>
            {{-- Dashboard --}}
            <li class="{{ Request::is('guru/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Master Data</li>
            {{-- Absensi --}}
            <li class="{{ Request::is('guru/absensi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru.absensi.index') }}">
                    <i class="fas fa-calendar-day"></i>
                    <span>Absensi</span>
                </a>
            </li>
            {{-- Rekap --}}
            <li class="{{ Request::is('guru/rekap*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru.rekap.index') }}">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Rekap</span>
                </a>
            </li>
            {{-- Panduan --}}
            {{-- <li class="">
                <a class="nav-link" href="blank.html">
                    <i class="fas fa-rocket"></i>
                    <span>Panduan</span>
                </a>
            </li> --}}
    </aside>
</div>
