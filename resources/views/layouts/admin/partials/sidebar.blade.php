<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard">Sistem Absensi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin</li>
            {{-- Dashboard --}}
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Master Data</li>
            {{-- User --}}
            <li class="{{ Request::is('admin/user*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="far fa-user"></i>
                    <span>User</span>
                </a>
            </li>
            {{-- Siswa --}}
            <li class="{{ Request::is('admin/siswa*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <i class="fas fa-user-tie"></i>
                    <span>Siswa</span>
                </a>
            </li>
            {{-- Guru --}}
            <li class="{{ Request::is('admin/guru*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('guru.index') }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Guru</span>
                </a>
            </li>
            {{-- Kelas --}}
            <li class="{{ Request::is('admin/kelas*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kelas.index') }}">
                    <i class="fas fa-university"></i>
                    <span>Kelas</span>
                </a>
            </li>
            {{-- Mapel --}}
            <li class="{{ Request::is('admin/mapel*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mapel.index') }}">
                    <i class="fas fa-book"></i>
                    <span>Mapel</span>
                </a>
            </li>
            {{-- Jadwal --}}
            <li class="{{ Request::is('admin/jadwal*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('jadwal.index') }}">
                    <i class="fas fa-clock"></i>
                    <span>Jadwal</span>
                </a>
            </li>
            {{-- Rekap --}}
            <li class="{{ Request::is('admin/rekap*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('rekap.index') }}">
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
