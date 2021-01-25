@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="rooms">
        <div class="rooms d-flex flex-column" id="rooms">
            <div class="rooms__heading heading heading--blue" id="heading">
                <h1 class="heading__title">{{ $vars['hotels_title'] }}</h1>
                <form action="{{ route('front.hotels.index') }}" name="filters" class="heading__selects heading__selects--rooms" >
                        <input name="date_from" type="hidden" value="{{ request()->get('date_from') ?? '' }}" />
                        <input name="date_to" type="hidden" value="{{ request()->get('date_to') ?? '' }}" />

                        <div class="heading__select" id="heading-first">
                            @php $dateRange = request()->get('date_range') ?? ''; @endphp
                            <input name="date_range" id="first" value="{{ $dateRange }}" autocomplete="off" placeholder="{{ $vars['filter_time_range'] }}" readonly="readonly">
                        </div>

                        <div class="heading__select" id="heading-type_id">
                            <select name="city_id" id="city_id">
                                @php $cityId = request()->get('city_id') ?? null; @endphp
                                <option value="" disabled="disabled" selected="selected">{{ $vars['filter_city'] }}</option>
                                @foreach($cityList as $city)
                                    <option
                                        value="{{ $city->id }}"
                                        {{ $cityId && $cityId == $city->id ? 'selected' : '' }} >
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="heading__select" id="heading-second">
                            <select name="distance_id" id="distance_id">
                                @php $distanceId = request()->get('distance_id') ?? null; @endphp
                                @foreach($distanceList as $distance)
                                    <option value="" disabled="disabled" selected="selected">{{ $vars['filter_distance'] }}</option>
                                    <option
                                        value="{{ $distance->id }}"
                                        {{ $distanceId && $distanceId == $distance->id ? 'selected' : '' }} >
                                        {{ $distance->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="heading__select" id="heading-third">
                            <select name="placement_id" id="placement_id">
                                @php $placementId = request()->get('placement_id') ?? null; @endphp
                                <option value="" disabled="disabled" selected="selected">{{ $vars['filter_type_allocation'] }}</option>
                                @foreach($placementList as $placement)
                                    <option
                                        value="{{ $placement->id }}"
                                        {{ $placementId && $placementId == $placement->id ? 'selected' : '' }} >
                                        {{ $placement->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                </form>
            </div>
            <div class="rooms__items list">
                <ul class="nav nav-pills list__tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                           aria-controls="pills-home" aria-selected="true">{{ $vars['base_list'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                           aria-controls="pills-profile" aria-selected="false">{{ $vars['base_on_map'] }}</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <p class="list__size">
                            {{ $vars['base_showed'] }}: {{ $hotels->total() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>

                @if($hotels->count())
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="list__items show">
                            @foreach($hotels as $hotel)
                                <div class="list__item d-flex flex-column {{ $hotel->recommended ? 'active' : '' }}">
                                    <a href="{{ route('front.hotels.show', $hotel->id) }}" class="d-flex flex-column nop">
                                        <img src="{{ asset('front/img/item-top.svg') }}" class="list__item-sign" alt="">

                                        <div class="list__img">
                                            {{ $hotel->image ? $hotel->image->img('list')->lazy() : '' }}
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                {{ $vars['base_price_from'] }} {{ $hotel->price }} {{ $vars['base_price_currency'] }}
                                            </p>
                                            <p class="list__subrating d-flex mb-0" data-rating="{{ $hotel->averageRating() }}">
                                                <span class="material-icons">star</span>
                                                <span class="material-icons">star</span>
                                                <span class="material-icons">star</span>
                                                <span class="material-icons">star</span>
                                                <span class="material-icons">star</span>
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            {{ $hotel->name }}
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            {{ $hotel->location }}
                                        </p>
                                    </a>
                                    <div class="list__buttons d-flex flex-row align-items-center">
                                        <button class="list__button list__button-add route-item-add" data-id="{{ $hotel->id }}" data-type="route-hotels">
                                            {{ $vars['base_add'] }}
                                        </button>
                                        <button class="list__button list__button-add list__button--green route-item-added d-none" data-id="{{ $hotel->id }}" data-type="route-hotels">
                                            {{ $vars['base_added'] }}<span class="material-icons">&nbsp;done</span>
                                        </button>
                                        <button class="list__button list__button-star material-icons favourite-item" data-id="{{ $hotel->id }}" data-type="favourite-hotels">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                                 viewBox="0 0 24 24"
                                                 fill="black" width="30px" height="30px">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                    <path
                                                        d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z"/>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    <a href="{{ route('front.choose') }}" class="list__button list__button-link route-item-go d-none">
                                        {{ $vars['base_go_to_route'] }}
                                    </a>
                                </div>

                            @endforeach
                        </div>

                        {{ $hotels->links('front.partials.paginator') }}

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div id="map"></div>
                    </div>
                </div>
                @else
                    <div class="list__no-items">
                        <p class="list__no-text exo">
                            {{ $vars['hotels_no'] }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dateRange = $('#first');
            let city = $('#city_id');
            let distance = $('#distance_id');
            let placement = $('#placement_id');
            let filterForm = $('form[name="filters"]');
            let dateFrom = $('input[name="date_from"]');
            let dateTo = $('input[name="date_to"]');

            city.selectmenu();
            distance.selectmenu()
            placement.selectmenu();

            dateRange.datepick({
                onSelect: function (dates) {
                    dates.map((date, index) => {
                        if (index === 0) {
                            dateFrom.val((new Date(date)).getTime() / 1000)
                        } else {
                            dateTo.val((new Date(date)).getTime() / 1000)
                        }
                    });

                    if (dates.length === 2) {
                        // filterForm.submit();
                    }
                },
                yearRange: 'c-0:c+2',
                firstDay: 1,
                multiSelect: 2,
                multiSeparator: ' — ',
                dateFormat: 'd M yyyyy',
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                monthNamesShort: ['янв', 'фев', 'мар', 'апр', 'май', 'июн',
                    'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'
                ],
                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
                ],
            });

            city.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            distance.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            placement.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })
        });
    </script>

    <script>
        ymaps.ready(init);

        function init() {
            let data = JSON.parse('{{ $geoData->toJson() }}'.replace(/&quot;/g,'"'));

            if (data.length > 0) {
                var myMap = new ymaps.Map('map', {
                    center: [data[0].lat, data[0].lng],
                    zoom: 10
                }, {
                    searchControlProvider: 'yandex#search'
                })

                var MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                    '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
                )

                for (let i = 0; i < data.length; i++) {
                    myPlacemark = new ymaps.Placemark([data[i].lat, data[i].lng], {
                        hintContent: data[i].name,
                        balloonContent: data[i].name
                    }, {
                        // options
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: 'front/img/geo.svg',
                        iconImageSize: [48, 48],
                        iconImageOffset: [-24, -24],
                        iconContentOffset: [15, 15],
                        iconContentLayout: MyIconContentLayout
                    })
                    myMap.geoObjects.add(myPlacemark)
                }
            }
        }
    </script>
@endsection
