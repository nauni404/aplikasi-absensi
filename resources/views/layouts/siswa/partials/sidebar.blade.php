<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard">Sistem Absensi</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">siswa</li>
            {{-- Dashboard --}}
            <li class="{{ Request::is('siswa/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="/">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
    </aside>
</div>
