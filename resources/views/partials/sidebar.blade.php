@inject('request', 'Illuminate\Http\Request')
<ul class="nav" id="side-menu">

    <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
        <a href="{{ url('/') }}">
            <i class="fa fa-wrench"></i>
            <span class="title">@lang('quickadmin.qa_dashboard')</span>
        </a>
    </li>


    @can('user_management_access')
        <li class="">
            <a href="#">
                <i class="fa fa-users"></i>
                <span class="title">@lang('quickadmin.user-management.title')</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level">

                @can('role_access')
                    <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                    <li class="{{ $request->segment(1) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
    @endcan
    @can('language_access')
        <li class="{{ $request->segment(1) == 'languages' ? 'active' : '' }}">
            <a href="{{ route('languages.index') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.languages.title')</span>
            </a>
        </li>
    @endcan

    @can('city_access')
        <li class="{{ $request->segment(1) == 'cities' ? 'active' : '' }}">
            <a href="{{ route('cities.index') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.cities.title')</span>
            </a>
        </li>
    @endcan

    @can('localized_city_datum_access')
        <li class="{{ $request->segment(1) == 'localized_city_datas' ? 'active' : '' }}">
            <a href="{{ route('localized_city_datas.index') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.localized-city-data.title')</span>
            </a>
        </li>
    @endcan

    @can('player_access')
        <li class="{{ $request->segment(1) == 'players' ? 'active' : '' }}">
            <a href="{{ route('players.index') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.players.title')</span>
            </a>
        </li>
    @endcan
    @can('city_step_access')
        <li class="{{ $request->segment(1) == 'city_steps' ? 'active' : '' }}">
            <a href="{{ route('city_steps.index') }}">
                <i class="fa fa-gears"></i>
                <span class="title">@lang('quickadmin.city-steps.title')</span>
            </a>
        </li>
    @endcan


    <li>
        <a href="#logout" onclick="$('#logout').submit();">
            <i class="fa fa-arrow-left"></i>
            <span class="title">@lang('quickadmin.qa_logout')</span>
        </a>
    </li>
</ul>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
