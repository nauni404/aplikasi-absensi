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
            {{-- Kelas --}}
            <li class="{{ Request::is('guru/kelas*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelas.index') }}">
                    <i class="fas fa-university"></i>
                    <span>Kelas</span>
                </a>
            </li>
            {{-- Jadwal --}}
            <li class="{{ Request::is('guru/jadwal*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('jadwal.index') }}">
                    <i class="fas fa-clock"></i>
                    <span>Jadwal</span>
                </a>
            </li>
            {{-- Absensi --}}
            <li class="{{ Request::is('guru/absensi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru.absensi.index') }}">
                    <i class="fas fa-calendar-day"></i>
                    <span>Absensi</span>
                </a>
            </li>
            {{-- Panduan --}}
            <li class="">
                <a class="nav-link" href="blank.html">
                    <i class="fas fa-rocket"></i>
                    <span>Panduan</span>
                </a>
            </li>
    </aside>
</div>
