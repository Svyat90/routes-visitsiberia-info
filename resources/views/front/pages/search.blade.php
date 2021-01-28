@extends('layouts.front')

@section('content')
    <main class="main" id="search">
        <div class="search d-flex flex-column list">
            <div class="search__input-wr">
                <input name="search" type="text" placeholder="{{ $vars['search_text_input'] }}" class="search__input">
            </div>
            <div class="search__results">
                <div class="search__result-group">
                    <h4 class="search__result-title">{{ $vars['search_routes_title'] }}</h4>
                    <div id="routes" class="search__result-items d-flex flex-column">
                        <div class="list__no-items">
                            <p class="list__no-text exo">
                                {{ $vars['search_not_found'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search__result-group">
                    <h4 class="search__result-title">{{ $vars['search_places_title'] }}</h4>
                    <div id="places" class="search__result-items d-flex flex-column">
                        <div class="list__no-items">
                            <p class="list__no-text exo">
                                {{ $vars['search_not_found'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search__result-group">
                    <h4 class="search__result-title">{{ $vars['search_events_title'] }}</h4>
                    <div id="events" class="search__result-items d-flex flex-column">
                        <div class="list__no-items">
                            <p class="list__no-text exo">
                                {{ $vars['search_not_found'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search__result-group">
                    <h4 class="search__result-title">{{ $vars['search_hotels_title'] }}</h4>
                    <div id="hotels" class="search__result-items d-flex flex-column">
                        <div class="list__no-items">
                            <p class="list__no-text exo">
                                {{ $vars['search_not_found'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="search__result-group">
                    <h4 class="search__result-title">{{ $vars['search_meals_title'] }}</h4>
                    <div id="meals" class="search__result-items d-flex flex-column">
                        <div class="list__no-items">
                            <p class="list__no-text exo">
                                {{ $vars['search_not_found'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let inputQuery = $("input[name='search']");
            let divRoutes = $("#routes");
            let divPlaces = $("#places");
            let divEvents = $("#events");
            let divHotels = $("#hotels");
            let divMeals = $("#meals");

            let locale = '{{ app()->getLocale() }}';
            let routeChoose = '{{ route('front.choose') }}';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            inputQuery.on("input", function(){
                let query = $(this).val();
                if (query.length !== 0) {
                    sendAjaxSearchRequest();
                }
            });


            function sendAjaxSearchRequest()
            {
                let query = inputQuery.val();
                if (query.length === 0) {
                    clearContainers();
                    return;
                }

                let formData = new FormData();
                formData.append('query', query);

                $.ajax({
                    type: "POST",
                    url: '{{ route('front.search') }}',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response) {
                            renderData(response);

                        } else {
                            clearContainers();
                        }
                    },
                    error: function (response) {
                        console.log('error', response);
                    }
                });
            }

            function renderData(response)
            {
                renderRoutes(response);
                renderHotels(response);
                renderMeals(response);
                renderEvents(response);
                renderPlaces(response);
            }

            function renderRoutes(response)
            {
                let count = Object.keys(response.routes).length;

                divRoutes.empty();

                if (count === 0) {
                    insertEmpty(divRoutes);
                    return;
                }

                for (let index = 0; index < Object.keys(response.routes).length; index++) {
                    let id = response.routes[index].id;
                    let name = response.routes[index].name[locale];
                    let city = response.routes[index].city[locale];
                    let route = '{{ route('front.routes.index') }}';

                    insertItem(id, name, city, route, divRoutes, 'routes')
                }
            }

            function renderHotels(response)
            {
                let count = Object.keys(response.hotels).length;

                divHotels.empty();

                if (count === 0) {
                    insertEmpty(divHotels);
                    return;
                }

                for (let index = 0; index < Object.keys(response.hotels).length; index++) {
                    let id = response.hotels[index].id;
                    let name = response.hotels[index].name[locale];
                    let city = response.hotels[index].city[locale];
                    let rating = response.hotels[index].averageRating + 1;
                    let route = '{{ route('front.hotels.index') }}';

                    insertRatingItem(id, name, city, route, divHotels, 'hotels', rating)
                }
            }

            function renderMeals(response)
            {
                let count = Object.keys(response.meals).length;

                divMeals.empty();

                if (count === 0) {
                    insertEmpty(divMeals);
                    return;
                }

                for (let index = 0; index < Object.keys(response.meals).length; index++) {
                    let id = response.meals[index].id;
                    let name = response.meals[index].name[locale];
                    let city = response.meals[index].city[locale];
                    let route = '{{ route('front.meals.index') }}';

                    insertItem(id, name, city, route, divMeals, 'meals')
                }
            }

            function renderEvents(response)
            {
                let count = Object.keys(response.events).length;

                divEvents.empty();

                if (count === 0) {
                    insertEmpty(divEvents);
                    return;
                }

                for (let index = 0; index < Object.keys(response.events).length; index++) {
                    let id = response.events[index].id;
                    let name = response.events[index].name[locale];
                    let city = response.events[index].city[locale];
                    let route = '{{ route('front.events.index') }}';

                    insertItem(id, name, city, route, divEvents, 'events')
                }
            }

            function renderPlaces(response)
            {
                let count = Object.keys(response.places).length;

                divPlaces.empty();

                if (count === 0) {
                    insertEmpty(divPlaces);
                    return;
                }

                for (let index = 0; index < count; index++) {
                    let id = response.places[index].id;
                    let name = response.places[index].name[locale];
                    let city = response.places[index].city[locale];
                    let rating = response.places[index].averageRating + 1;
                    let route = '{{ route('front.places.index') }}';

                    insertRatingItem(id, name, city, route, divPlaces, 'places', rating)
                }
            }

            function insertItem(id, name, city, route, container, namespace)
            {
                let activeFavourite = generateActiveFavouriteClass(id, namespace);

                let isAdded = checkOnAdded(id, namespace);
                let addClass = isAdded === true ? "d-none" : "";
                let addedClass = isAdded === true ? "" : "d-none";

                let cityContainer = '';
                if (city) {
                    cityContainer = '<span class="material-icons">room </span>' + city
                }

                let insertItem = '<div class="search__result-item d-flex flex-row align-items-center">'
                    + '<a class="search__result-name mb-0 list__name exo " href="' + route + '/' + id + '">' + name + '</a>'
                    + '<p class="list__city search__result-geo">'
                        + cityContainer
                    + '</p>'
                    + '<div class="search__result-buttons d-flex flex-row">'
                    + '<div class="list__button search__result-button material-icons page-nav__icon-add route-item-add-ajax ' + addClass + '" data-id="' + id + '" data-type="route-' + namespace + '">add</div>'
                    + '<div class="list__button search__result-button material-icons list__button--green page-nav__icon-add route-item-added-ajax ' + addedClass + '" data-id="' + id + '" data-type="route-' + namespace + '">done</div>'
                    + '<a href="' + routeChoose + '" class="list__button search__result-button list__button-star list__button-link mb-0 route-item-go ' + addedClass + '">Перейти к маршруту</a>'
                    + '<div class="list__button search__result-button list__button-star material-icons favourite-item-ajax ' + activeFavourite + '" data-id="' + id + '" data-type="favourite-' + namespace + '">star</div>'
                    + '</div>'
                + '</div>';

                container.append(insertItem)
            }

            function insertRatingItem(id, name, city, route, container, namespace, rating = 1)
            {
                console.log(id, name, city, route, container, namespace, rating);

                let activeFavourite = generateActiveFavouriteClass(id, namespace);

                let isAdded = checkOnAdded(id, namespace);
                let addClass = isAdded === true ? "d-none" : "";
                let addedClass = isAdded === true ? "" : "d-none";

                let cityContainer = '';
                if (city) {
                    cityContainer = '<span class="material-icons">room </span>' + city
                }

                let insertItem = '<div class="search__result-item d-flex flex-row align-items-center">'
                    + '<a class="search__result-name mb-0 list__name exo list__subrating d-flex" data-rating="' + rating +'" href="' + route + '/' + id + '">'
                        + '<p class="toe">' + name + '</p>'
                        + '<span class="material-icons">star</span>'
                        + '<span class="material-icons">star</span>'
                        + '<span class="material-icons">star</span>'
                        + '<span class="material-icons">star</span>'
                        + '<span class="material-icons">star</span>'
                    + '</a>'
                    + '<p class="list__city search__result-geo">'
                        + cityContainer
                    + '</p>'
                    + '<div class="search__result-buttons d-flex flex-row">'
                        + '<div class="list__button search__result-button material-icons page-nav__icon-add route-item-add-ajax ' + addClass + '" data-id="' + id + '" data-type="route-' + namespace + '">add</div>'
                        + '<div class="list__button search__result-button material-icons list__button--green page-nav__icon-add route-item-added-ajax ' + addedClass + '" data-id="' + id + '" data-type="route-' + namespace + '">done</div>'
                        + '<a href="' + routeChoose + '" class="list__button search__result-button list__button-star list__button-link mb-0 route-item-go ' + addedClass + '">Перейти к маршруту</a>'
                        + '<div class="list__button search__result-button list__button-star material-icons favourite-item-ajax ' + activeFavourite + '" data-id="' + id + '" data-type="favourite-' + namespace + '">star</div>'
                    + '</div>'
                + '</div>';

                container.append(insertItem)
            }

            /**
             * @param container
             */
            function insertEmpty(container)
            {
                let text = '{{ $vars['search_not_found'] }}';

                let insertEmptyDiv = '<div class="list__no-items">'
                        + '<p class="list__no-text exo">' + text + '</p>'
                    + '</div>';

                container.append(insertEmptyDiv)
            }

            function generateActiveFavouriteClass(id, namespace)
            {
                let isActive = isFavourite(id.toString(), 'favourite-' + namespace);

                return isActive === true ? 'active' : '';
            }

            function checkOnAdded(id, namespace)
            {
                let added = isAdded(id.toString(), 'route-' + namespace)

                return added === true;
            }

            function clearContainers()
            {
                divRoutes.empty();
                divPlaces.empty();
                divEvents.empty();
                divHotels.empty();
                divMeals.empty();
            }

        });
    </script>
@endsection
