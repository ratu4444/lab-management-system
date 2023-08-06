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

            <li class="dropdown {{ Route::is('client*') ? 'active' : '' }}">
                <a href="" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="briefcase"></i>
                    <span>Client</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('client.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('client.index') }}">Clients List</a></li>
                    <li class="{{ Route::is('client.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('client.create') }}">Create Client</a></li>
                </ul>
            </li>

            <li class="dropdown {{ Route::is('project*') ? 'active' : '' }}">
                <a href="" class="menu-toggle nav-link has-dropdown">
                    <i data-feather="briefcase"></i>
                    <span>Project</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('project.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('project.index') }}">Projects List</a></li>
                    <li class="{{ Route::is('project.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('project.create') }}">Create Project</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
