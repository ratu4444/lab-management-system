<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.admin-index') }}">
                <img alt="image" src="{{ asset('assets/default/logo.png') }}" class="header-logo" style="height: 50px"/>
{{--                <span class="logo-name">{{ config('app.name') }}</span>--}}
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            @switch(auth()->user()->type)
                @case(\App\Models\User::TYPE_SUPERADMIN)
                    <li class="dropdown {{ Route::is('control.index') ? 'active' : '' }}">
                        <a href="{{ route('control.index') }}" class="nav-link">
                            <i data-feather="monitor"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="dropdown {{ Route::is('control.admin*') ? 'active' : '' }}">
                        <a href="" class="menu-toggle nav-link has-dropdown">
                            <i data-feather="users"></i>
                            <span>Admins</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::is('control.admin.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('control.admin.index') }}">Admins List</a></li>
                            <li class="{{ Route::is('control.admin.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('control.admin.create') }}">Create Admin</a></li>
                        </ul>
                    </li>
                @break

                @case(\App\Models\User::TYPE_ADMIN)
{{--                @case(\App\Models\User::TYPE_SUPERADMIN)--}}
                <li class="dropdown {{ Route::is('dashboard*') && !Route::is('dashboard.client-index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.admin-index') }}" class="nav-link">
                            <i data-feather="monitor"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{--            Changes in name. Researchers instead of Client--}}
                    <li class="dropdown {{ Route::is('client*') ? 'active' : '' }}">
                        <a href="" class="menu-toggle nav-link has-dropdown">
                            <i data-feather="briefcase"></i>
                            <span>Researchers</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::is('client.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('client.index') }}">Researchers List</a></li>
                            <li class="{{ Route::is('client.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('client.create') }}">Create Researchers</a></li>
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

                    <li class="dropdown {{ Route::is('dashboard.client-index') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.client-index') }}" class="nav-link">
                            <i data-feather="monitor"></i>
                            <span>Project Dashboard</span>
                        </a>
                    </li>

                    <li class="dropdown {{ Route::is('settings*') ? 'active' : '' }}">
                        <a href="" class="menu-toggle nav-link has-dropdown">
                            <i data-feather="briefcase"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="{{ Route::is('settings.task.show') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('settings.task.show') }}">Default Tasks</a>
                            </li>
                        </ul>
                    </li>
                @break

                @case(\App\Models\User::TYPE_CLIENT)
                    <li class="dropdown {{ Route::is('dashboard*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.client-index') }}" class="nav-link">
                            <i data-feather="monitor"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @break
            @endswitch
        </ul>
    </aside>
</div>
