<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">
                <img alt="image" src="{{ asset('assets/default/DJL-Construction_Dark.png') }}" class="header-logo" />
                <span class="logo-name">{{ config('app.name') }}</span>
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown {{ Route::is('dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="nav-link">
                    <i data-feather="monitor"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
