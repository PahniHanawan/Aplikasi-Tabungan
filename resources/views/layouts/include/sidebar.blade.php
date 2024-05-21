<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a class="d-block">{{ Auth::user()->name }}</a>
    </div>
</div>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link">
                <i class="fas fa-home"></i>
                <p>Home</p>
            </a>
        </li>
        @if (auth()->user()->role == 'admin')
            <li class="nav-header">DATA MASTER</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.index') }}">
                    <i class="fa-solid fa-person"></i>
                    <p>Siswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tabungan.index') }}">
                    <i class="fa-solid fa-money-bill"></i>
                    <p>Tabungan</p>
                </a>
            </li>
            <li class="nav-header">ADMIN PANEL</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users*') ? 'c-active' : '' }}"
                    href="{{ route('users.index') }}">
                    <i class="fas fa-briefcase"></i>
                    <p>User Management</p>
                </a>
            </li>
        @endif
        <div class="pull-right">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    {{ __('Logout') }}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </div>
    </ul>
</nav>
<!-- /.sidebar-menu -->
