<header class="header fixed-top">
    <nav class="navbar sticky-top navbar-expand-xl justify-content-between align-items-start">
        <div style="flex-grow: 1;">
            <div class="header__buttons">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon material-icons">menu</span>
                </button>
                <a class="nav-link material-icons" href="./search.html">search</a>
            </div>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.home') }}">{{ $vars['header_home'] }} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.routes.index') }}">{{ $vars['header_routes'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.places.index') }}">{{ $vars['header_places'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.events.index') }}">{{ $vars['header_events'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.hotels.index') }}">{{ $vars['header_hotels'] }}</a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="{{ route('front.meals.index') }}">{{ $vars['header_meals'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link--blue">
                            <span class="nav-counter">3</span>
                            {{ $vars['header_create_route'] }}
                        </a>
                    </li>
                    <li class="nav-item nav-item-last">
                        <a class="nav-link" href="{{ route('front.favourites') }}">{{ $vars['header_favourites'] }}</a>
                    </li>
                    <li class="nav-item header__mobile">
                        <a class="nav-link {{ app()->getLocale() === 'ru' ? 'active' : '' }}" style="margin-right: 10px" href="{{ route('set_locate', 'ru') }}">Ру</a>
                        <a class="nav-link pl-0 {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('set_locate', 'en') }}">En</a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav flex-row header__helpers">
            <li class="nav-item">
                <a class="nav-link material-icons" href="search.html">search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ app()->getLocale() === 'ru' ? 'active' : '' }}" href="{{ route('set_locate', 'ru') }}">Ру</a>
            </li>
            <li class="nav-item pl-0">
                <a class="nav-link pl-0 {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('set_locate', 'en') }}">En</a>
            </li>
        </ul>
    </nav>
</header>
