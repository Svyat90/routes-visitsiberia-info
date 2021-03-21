@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="events">
        <div class="events d-flex flex-column" id="events">
            <div class="events__heading heading heading--blue" id="heading">
                <h1 class="heading__title">{{ $vars['events_title'] }}</h1>
                <form action="{{ route('front.events.index') }}" name="filters" class="heading__selects heading__selects--events">

                    <select name="season_id" id="season_id">
                        @php $seasonId = request()->get('season_id') ?? null; @endphp
                        <option value="" disabled="disabled" selected="selected">{{ $vars['filter_season'] }}</option>
                        @foreach($seasonList as $season)
                            <option
                                value="{{ $season->id }}"
                                {{ $seasonId && $seasonId == $season->id ? 'selected' : '' }} >
                                {{ $season->name }}
                            </option>
                        @endforeach
                    </select>

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

                    <div class="heading__select" id="heading-fourth">
                        <select name="whom_id"  id="whom_id">
                            @php $whomId = request()->get('whom_id') ?? null; @endphp
                            <option disabled="disabled" selected="selected">{{ $vars['filter_whom'] }}</option>
                            @foreach($whomList as $whom)
                                <option
                                    value="{{ $whom->id }}"
                                    {{ $whomId && $whomId == $whom->id ? 'selected' : '' }} >
                                    {{ $whom->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="events__items list">
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
                            {{ $vars['base_showed'] }}: {{ $events->total() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>

                @if($events->count())
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            <div class="list__items show">

                                @foreach($events as $event)
                                    <div class="list__item d-flex flex-column">
                                        <a href="{{ route('front.events.show', $event->id) }}" class="d-flex flex-column nop">
                                            <div class="list__img">
                                                {{ $event->image ? $event->image->img()->lazy('list') : '' }}
                                            </div>
                                            <div class="list__subinfo d-flex justify-content-between align-items-center">
                                                <p class="list__subprice mb-0">
{{--                                                    {{ DateHelper::eventRangeTime($event) }}--}}
                                                </p>
                                            </div>
                                            <p class="list__name exo">
                                                {{ $event->name }}
                                            </p>
                                            <a class="list__city"
                                                target="_blank"
                                                href="{{ YandexGeoHelper::yandexMapLink($event->lng, $event->lat) }}"
                                            >
                                                @if($event->city)
                                                    <span class="material-icons">room&nbsp;</span>
                                                    {{ $event->city }}
                                                @endif
                                            </a>
                                        </a>
                                        <div class="list__buttons d-flex flex-row align-items-center">
                                            <button class="list__button list__button-add route-item-add" data-id="{{ $event->id }}" data-type="route-events">
                                                {{ $vars['base_add'] }}
                                            </button>
                                            <button class="list__button list__button-add list__button--green route-item-added d-none" data-id="{{ $event->id }}" data-type="route-events">
                                                {{ $vars['base_added'] }}<span class="material-icons">&nbsp;done</span>
                                            </button>
                                            <button class="list__button list__button-star material-icons favourite-item" data-id="{{ $event->id }}" data-type="favourite-events">
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

                            {{ $events->links('front.partials.paginator') }}

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div id="map"></div>
                        </div>
                    </div>
                @else
                    <div class="list__no-items">
                        <p class="list__no-text exo">
                            {{ $vars['events_no'] }}
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
            let season = $('#season_id');
            let city = $('#city_id');
            let whom = $('#whom_id');
            let filterForm = $('form[name="filters"]');

            city.selectmenu();
            whom.selectmenu();
            season.selectmenu();

            city.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            whom.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            season.on('selectmenuchange', e => {
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
                    let item = data[i];
                    let popup = renderPopup(item.name, item.label, item.phone, '', item.city, item.lat, item.lng, item.site_link, item.link);

                    myPlacemark = new ymaps.Placemark([data[i].lat, data[i].lng], {
                        hintContent: data[i].name,
                        balloonContent: popup
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
