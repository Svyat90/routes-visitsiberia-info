<header class="fixed-top">
    <nav class="navbar sticky-top navbar-expand-lg justify-content-between align-items-start">
        <div style="flex-grow: 1;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon material-icons">menu</span>
            </button>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.home') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.routes.index') }}">Маршруты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.places.index') }}">Объекты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.events.index') }}">События</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.rooms.index') }}">Проживание</a>
                    </li>
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="{{ route('front.meals.index') }}">Еда</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./favorites.html">Избранное</a>
                    </li>
                </ul>
            </div>
        </div>
        <ul class="navbar-nav flex-row">
            <li class="nav-item">
                <a class="nav-link material-icons" href="./search.html">search</a>
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
