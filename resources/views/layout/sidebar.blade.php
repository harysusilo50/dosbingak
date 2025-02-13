<ul class="navbar-nav sidebar sidebar-light accordion bg-white border" style="border-radius: 10px" id="accordionSidebar">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/home') ? 'active' : '' }} {{ Request::is('home') ? 'active' : '' }}">
        <a class="nav-link"
            href="{{ Auth::user()->role == 'admin' || Auth::user()->role == 'dosen' ? route('admin.home') : route('home') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    @if (Auth::user()->role == 'admin')
        {{-- User --}}
        <div class="sidebar-heading">
            User
        </div>
        <li class="nav-item {{ Request::is('admin/user-all') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.all') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Manajemen User</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/verification-list-user') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.list-verify') }}">
                <i class="fas fa-fw fa-user-check"></i>
                <span>Verifikasi User</span></a>
        </li>
        <div class="sidebar-heading">
            Data
        </div>
        <li class="nav-item {{ Request::is('admin/data-mahasiswa') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.data-mahasiswa.index') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Data Mahasiswa</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/data-dosen') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.data-dosen.index') }}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data Dosen</span></a>
        </li>
        <div class="sidebar-heading">
            Konsultasi
        </div>
        <li class="nav-item {{ Request::is('admin/bimbingan-akademik') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.bimbingan-akademik.index') }}">
                <i class="fas fa-chalkboard-teacher mr-1"></i>
                <span>Bimbingan Akademik</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/persetujuan-krs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.validasi-krs.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Persetujuan Surat</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/jadwal-bimbingan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('jadwal-bimbingan.index') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Jadwal Konsultasi</span></a>
        </li>
    @endif
    @if (Auth::user()->role == 'dosen')
        <div class="sidebar-heading">
            Data
        </div>
        <li class="nav-item {{ Request::is('admin/data-mahasiswa') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.data-mahasiswa.index') }}">
                <i class="fas fa-fw fa-chart-bar"></i>
                <span>Data Mahasiswa</span></a>
        </li>
        <div class="sidebar-heading">
            Konsultasi
        </div>
        <li class="nav-item {{ Request::is('admin/bimbingan-akademik') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.bimbingan-akademik.index') }}">
                <i class="fas fa-chalkboard-teacher mr-1"></i>
                <span>Bimbingan Akademik</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/persetujuan-krs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.validasi-krs.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Persetujuan Surat</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/jadwal-bimbingan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('jadwal-bimbingan.index') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Jadwal Konsultasi</span></a>
        </li>
    @endif
    @if (Auth::user()->role == 'user')
        <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile.index') }}">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>Profile</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/jadwal-bimbingan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('jadwal-bimbingan.index') }}">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Jadwal Konsultasi</span></a>
        </li>
        <li class="nav-item {{ Request::is('bimbingan-akademik') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bimbingan-akademik.index') }}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Bimbingan Akademik</span></a>
        </li>
        <li class="nav-item {{ Request::is('persetujuan-krs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('validasi-krs.index') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Persetujuan Surat</span></a>
        </li>
    @endif

</ul>
