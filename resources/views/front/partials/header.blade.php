<header class="header fixed-top">
    <nav class="navbar sticky-top navbar-expand-lg justify-content-between align-items-start">
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
                        <a class="nav-link" href="{{ route('front.home') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.routes.index') }}">Маршруты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.places.index') }}">Достопримечательности</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.events.index') }}">События</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.hotels.index') }}">Проживание</a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="{{ route('front.meals.index') }}">Еда</a>
                    </li>
                    <li class="nav-item nav-item-last">
                        <a class="nav-link" href="favorites.html">Избранное</a>
                    </li>
                    <li class="nav-item header__mobile">
                        <a class="nav-link active" style="margin-right: 10px" href="#">Ру</a>
                        <a class="nav-link pl-0" href="#">En</a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav flex-row header__helpers">
            <li class="nav-item">
                <a class="nav-link material-icons" href="search.html">search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Ру</a>
            </li>
            <li class="nav-item pl-0">
                <a class="nav-link pl-0" href="#">En</a>
            </li>
        </ul>
    </nav>
</header>
