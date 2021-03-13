@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="route">
        <div class="route d-flex flex-column" id="route">
            <div class="route__heading heading heading--pink" id="heading">
                <h1 class="heading__title">{{ $vars['routes_title'] }}</h1>
                <form action="{{ route('front.routes.index') }}" name="filters" class="heading__selects heading__selects--route">

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

                    <select name="transport_id"  id="transport_id">
                        @php $transportId = request()->get('transport_id') ?? null; @endphp
                        <option disabled="disabled" selected="selected">{{ $vars['filter_transport'] }}</option>
                        @foreach($transportList as $transport)
                            <option
                                value="{{ $transport->id }}"
                                {{ $transportId && $transportId == $transport->id ? 'selected' : '' }} >
                                {{ $transport->name }}
                            </option>
                        @endforeach
                    </select>

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

                    <select name="type_id" id="type_id">
                        @php $typeId = request()->get('type_id') ?? null; @endphp
                        <option value="" disabled="disabled" selected="selected">{{ $vars['filter_type_rest'] }}</option>
                        @foreach($typeList as $type)
                            <option
                                value="{{ $type->id }}"
                                {{ $typeId && $typeId == $type->id ? 'selected' : '' }} >
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
            </form>
            </div>

            <div class="route__items list">
                <ul class="nav nav-pills list__tabs wow fadeInUp" id="pills-tab" role="tablist">
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
                            {{ $vars['base_showed'] }}: {{ $routes->total() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>

                @if($routes->count())
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active list__sliders-wr" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="list__sliders show">

                            @foreach($routes as $key => $route)
                                <div class="list__slider d-flex flex-column list__slider--1 wow fadeInUp">
                                <p class="list__slider-title">
                                    <a href="{{ route('front.routes.show', $route['model']->id) }}" class="text-color-imp">{{ $route['model']->name }}</a>
                                </p>
                                <div class="swiper-container list__slider-container">
                                    <div class="list__slider-story exo">
                                        {!! \App\Helpers\HtmlHelper::clearHtml( $route['model']->page_desc ) !!}
                                    </div>
                                    <div class="swiper-wrapper list__slider-wr">
                                        @foreach($route['routable'] as $entity)
                                            <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <a href="{{ RouteHelper::show($entity) }}" class="list__slide-img-wr">
                                                    {{ $entity->image ? $entity->image->img('route')->lazy() : '' }}
                                                </a>
                                                <a href="{{ RouteHelper::show($entity) }}" class="list__slide-name exo">
                                                    {{ $entity->name }}
                                                </a>
{{--                                                <a class="list__slide-city"--}}
{{--                                                   target="_blank"--}}
{{--                                                   href="{{ YandexGeoHelper::yandexMapLink($entity->lng, $entity->lat) }}"--}}
{{--                                                >--}}
{{--                                                    @if($entity->city)--}}
{{--                                                        <span class="material-icons">room&nbsp;</span>--}}
{{--                                                        {{ $entity->city }}--}}
{{--                                                    @endif--}}
{{--                                                </a>--}}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    </div>

                    {{ $routes->links('front.partials.paginator') }}

                </div>
                @else
                    <div class="list__no-items">
                        <p class="list__no-text exo">
                            {{ $vars['routes_no'] }}
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
            let type = $('#type_id');
            let transport = $('#transport_id');
            let whom = $('#whom_id');
            let filterForm = $('form[name="filters"]');

            type.selectmenu();
            transport.selectmenu()
            whom.selectmenu();
            season.selectmenu();

            type.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            transport.on('selectmenuchange', e => {
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
        const key = 'cffbde42-9a9e-4630-b8af-50781fa386c1'
    </script>

    <script>
        var mySwiper = new Swiper('.swiper-container', {
            spaceBetween: 76,
            slidesPerView: 'auto',
            slidePrevClass: 'list__slide--prev',
            scrollbar: {
                el: '.swiper-scrollbar',
                hide: false,
                dragSize: 300,
            },
            breakpoints: {
                0: {
                    spaceBetween: 10
                },
                576: {
                    spaceBetween: 76
                },
                768: {
                    spaceBetween: 136,
                }
            },
            on: {
                init() {
                    if (this.slides.length <= 3) {
                        if (window.innerWidth > 1440) {
                            this.allowSlideNext = false
                            this.allowSlidePrev = false
                            this.scrollbar.el && this.scrollbar.el.destroy()
                        }
                    }
                }
            }
        })
    </script>

    <script>
        ymaps.ready(init);

        let geoData = '{{ $geoData->toJson() }}';
        let items = JSON.parse(geoData.replace(/&quot;/g,'"'));

        function init() {
            for (let i = 0; i < items.length; i++) {
                let item = items[i]
                let id = item.name
                const domEl = document.createElement('div')
                domEl.id = id
                domEl.classList.add('route__map')

                document.getElementById('pills-profile').appendChild(domEl)

                var myMap = new ymaps.Map(id, {
                    center: [item.items[0].lat, item.items[0].lng],
                    zoom: 10
                }, {
                    searchControlProvider: 'yandex#search'
                })

                let points = []
                for (let idx = 0; idx < Object.keys(item.items).length; idx++) {
                    let lat = item.items[idx].lat
                    let lng = item.items[idx].lng

                    points.push([lat, lng])
                }

                var multiRoute = new ymaps.multiRouter.MultiRoute({
                    referencePoints: points,
                    params: {
                        results: 1,
                        routingMode: '{{ $routeType }}',
                    }
                });

                myMap.geoObjects.add(multiRoute);
            }
        }
    </script>
@endsection
