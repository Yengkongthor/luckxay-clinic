<header class="app-header navbar navbar-expand-lg">
    <button class="navbar-toggler sidebar-toggler d-lg-none" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    @if(View::exists('admin.layout.logo'))
    @include('admin.layout.logo')
    @endif

    <ul class="nav navbar-nav d-none d-lg-flex">
        <li class="nav-item @active('*admin')">
            <a class="nav-link" href="{{ route('admin/dashboard') }}">{{ __('Dashboard') }} <span
                    class="sr-only">(current)</span></a>
        </li>



        @can('admin.department.index')
        <li class="nav-item @active('*departments')">
            <a class="nav-link" href="{{ url('admin/departments') }}">
                {{ trans('admin.department.title') }}</a>
        </li>
        @endcan

        @can('admin')
        <li class="nav-item dropdown @active('*admin/booking-time*','*admin/roles*','*admin/permissions*')">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownManageAccess" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('App Manager') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownManageAccess">
                <a class="dropdown-item @active('*admin/booking-date*')"
                    href="{{ url('admin/booking-dates') }}">{{ trans('admin.booking-date.title') }}</a>
                <a class="dropdown-item @active('*admin/booking-time*')"
                    href="{{ url('admin/booking-times') }}">{{ trans('admin.booking-time.title') }}</a>
                <a class="dropdown-item @active('*admin/promotion*')"
                    href="{{ url('admin/promotions') }}">{{ trans('admin.promotion.title') }}</a>
                <a class="dropdown-item @active('*admin/health-tip*')"
                    href="{{ url('admin/health-tips') }}">{{ trans('admin.health-tip.title') }}</a>
                <a class="dropdown-item @active('*admin/province*')"
                    href="{{ url('admin/provinces') }}">{{ trans('admin.province.title') }}</a>
            </div>
        </li>
        @endcan



        @can('admin.admin-user.index')
        <li class="nav-item dropdown @active('*admin/admin-users*','*admin/roles*','*admin/permissions*')">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownManageAccess" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Setting') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownManageAccess">
                <a class="dropdown-item @active('*admin/admin-users*')"
                    href="{{ url('admin/admin-users') }}">{{ trans('admin.admin-user.title') }}</a>
                <a class="dropdown-item @active('*admin/roles*')"
                    href="{{ url('admin/roles') }}">{{ trans('admin.role.title') }}</a>
                <a class="dropdown-item @active('*admin/permissions*')"
                    href="{{ url('admin/permissions') }}">{{ trans('admin.permission.title') }}</a>
                <a class="dropdown-item @active('*admin/translations*')"
                    href="{{ url('admin/translations') }}">{{ __('Translations') }}</a>
            </div>
        </li>
        @endcan

        @can('admin.content.index')
        <li class="nav-item @active('*content')">
            <a class="nav-link" href="{{ url('admin/content') }}">
                content</a>
        </li>
        @endcan
        {{-- @can('admin.admin-user.index')
        <li class="nav-item dropdown @active('*admin/admin-users*','*admin/roles*','*admin/permissions*')">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownManageAccess" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Setting') }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownManageAccess">
                <a class="dropdown-item @active('*admin/admin-users*')"
                    href="{{ url('admin/admin-users') }}">{{ trans('admin.admin-user.title') }}</a>
                <a class="dropdown-item @active('*admin/roles*')"
                    href="{{ url('admin/roles') }}">{{ trans('admin.role.title') }}</a>
                <a class="dropdown-item @active('*admin/permissions*')"
                    href="{{ url('admin/permissions') }}">{{ trans('admin.permission.title') }}</a>
                <a class="dropdown-item @active('*admin/translations*')"
                    href="{{ url('admin/translations') }}">{{ __('Translations') }}</a>
            </div>
        </li>
        @endcan --}}

        {{-- @can('admin.owner')
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/owners') }}">{{ __('Owner') }} </a>
        </li>
        @endcan --}}
    </ul>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a role="button" class="dropdown-toggle nav-link">
                <span>
                    @if(Auth::check() && Auth::user()->avatar_thumb_url)
                    <img src="{{ Auth::user()->avatar_thumb_url }}" class="avatar-photo">
                    @elseif(Auth::check() && Auth::user()->first_name && Auth::user()->last_name)
                    <span
                        class="avatar-initials">{{ mb_substr(Auth::user()->first_name, 0, 1) }}{{ mb_substr(Auth::user()->last_name, 0, 1) }}</span>
                    @elseif(Auth::check() && Auth::user()->name)
                    <span class="avatar-initials">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                    @elseif(Auth::guard(config('admin-auth.defaults.guard'))->check() &&
                    Auth::guard(config('admin-auth.defaults.guard'))->user()->first_name &&
                    Auth::guard(config('admin-auth.defaults.guard'))->user()->last_name)
                    <span
                        class="avatar-initials">{{ mb_substr(Auth::guard(config('admin-auth.defaults.guard'))->user()->first_name, 0, 1) }}{{ mb_substr(Auth::guard(config('admin-auth.defaults.guard'))->user()->last_name, 0, 1) }}</span>
                    @else
                    <span class="avatar-initials"><i class="fa fa-user"></i></span>
                    @endif

                    @if(!is_null(config('admin-auth.defaults.guard')))
                    <span
                        class="hidden-md-down">{{ Auth::guard(config('admin-auth.defaults.guard'))->check() ? Auth::guard(config('admin-auth.defaults.guard'))->user()->full_name : 'Anonymous' }}</span>
                    @else
                    <span class="hidden-md-down">{{ Auth::check() ? Auth::user()->full_name : 'Anonymous' }}</span>
                    @endif

                </span>
                <span class="caret"></span>
            </a>
            @if(View::exists('admin.layout.profile-dropdown'))
            @include('admin.layout.profile-dropdown')
            @endif
        </li>
    </ul>
</header>
