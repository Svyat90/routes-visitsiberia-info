<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.pages.index") }}" class="nav-link {{ request()->is("admin/pages") || request()->is("admin/pages/*") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.pages.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.dictionaries.index") }}" class="nav-link {{ request()->is("admin/dictionaries") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.dictionaries.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.places.index") }}" class="nav-link {{ request()->is("admin/places") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.places.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.hotels.index") }}" class="nav-link {{ request()->is("admin/hotels") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.hotels.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.meals.index") }}" class="nav-link {{ request()->is("admin/meals") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.meals.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is("admin/events") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.events.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is("languages/*") ? 'active' : '' }}" href="{{ route('admin.languages.index') }}">
                        <i class="fa-fw nav-icon fas fa-cogs">
                        </i>
                        <p>
                            {{ trans('cruds.languages.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview {{ request()->is('admin/translations*') ? 'menu-open' : '' }}">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="fa-fw nav-icon fas fa-file-alt"></i>
                        <p>
                            {{ trans('global.translations') }}
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach($languages as $language)
                            <li class="nav-item">
                                <a href="{{ route("admin.translations.edit") }}?path={{ $language->path }}" class="nav-link {{ strpos(urldecode(request()->fullUrl()), '/lang/' . $language->locale) !== false ? 'active' : '' }}">
                                    <i class="fa-fw nav-icon fas fa-file-alt"></i>
                                    <p>{{ $language->locale }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.vars.index") }}" class="nav-link {{ request()->is("admin/vars") || request()->is("admin/vars/*") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.vars.title') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route("admin.export.index") }}" class="nav-link {{ request()->is("admin/export") || request()->is("admin/export/*") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('global.export') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/password') || request()->is('admin/password/*') ? 'active' : '' }}" href="{{ route('admin.password.edit') }}">
                        <i class="fa-fw fas fa-key nav-icon">
                        </i>
                        <p>
                            {{ trans('global.change_password') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
