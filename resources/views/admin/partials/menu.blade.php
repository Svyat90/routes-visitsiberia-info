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
                    <a href="{{ route("admin.dictionaries.index") }}" class="nav-link {{ request()->is("admin/dictionaries") ? 'active' : '' }}" >
                        <i class="fa-fw nav-icon fas fa-book">
                        </i>
                        <p>
                            {{ trans('cruds.dictionaryManagement.title') }}
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
