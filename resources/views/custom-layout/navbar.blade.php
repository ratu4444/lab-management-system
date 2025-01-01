<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn">
                    <i data-feather="align-justify"></i>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="bg-primary d-flex justify-content-center align-items-center rounded-circle shadow-lg user-initial">
                    <span class="font-weight-bolder">{{ auth()->user()->initial }}</span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">{{ auth()->user()->name }}</div>

                @if(auth()->user()->type !== \App\Models\User::TYPE_SUPERADMIN)
                    <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon d-flex align-items-center {{ Route::is('profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i> Edit Profile
                    </a>
                @endif

                <div class="dropdown-divider"></div>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <div class="px-2">
                        <button class="btn btn-danger w-100" type="submit"> <i class="fas fa-sign-out-alt"></i> Logout</button>
                    </div>
                </form>
            </div>
        </li>
    </ul>
</nav>
