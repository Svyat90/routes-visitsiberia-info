@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="route-item">
        <article class="main__article article">
            <div class="article__header">
                <div class="article__description wow fadeInLeft">
                    <div class="article__title-wrap">
                        <h1 class="article__title">{{ $route->name }}</h1>
                        <div class="article__share">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20px" height="20px"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg>
                        </div>
                    </div>

                    @if($route->recommended)
                        <div class="article__recommendation">
                            <svg class="article__icon-recommandation" width="32" height="32" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="5.6665" width="32" height="32" fill="white"/>
                                <path d="M7.02333 0L7 37.3333L28 51.3333L48.9767 37.3333L49 0H7.02333ZM23.3333 35L11.6667 23.3333L14.9567 20.02L23.3333 28.3967L41.0433 10.6867L44.3333 14L23.3333 35Z" fill="#FFB906"/>
                            </svg>
                            <p class="article__recommendation-text" id="desc">{{ $vars['base_tic_recommended'] }}</p>
                        </div>
                    @endif

                    <div class="article__sign wow fadeInLeft">
                        @foreach(DictionaryHelper::group($route->dictionaries) as $parentName => $dictionaries)
                            <p class="article__sign-bold">
                                {{ $parentName }}:
                                @foreach($dictionaries as $dictionary)
                                    <span href="#" class="article__link">
                                        {{ $dictionary->name . (! $loop->last ? ',' : '') }}
                                    </span>
                                @endforeach
                            </p>
                        @endforeach

                        <p class="article__information article__text" id="desc">
                            {!! $route->page_desc !!}
                        </p>
                    </div>
                </div>

                <sidebar class="article__page-nav page-nav wow fadeInRight">
                    <ul class="page-nav__list">
                        <li class="page-nav__item"><a href="#desc">{{ $vars['base_desc'] }}</a></li>
                        <li class="page-nav__item"><a href="#info">{{ $vars['base_help_info'] }}</a></li>
                        <li class="page-nav__item"><a href="#photo">{{ $vars['base_photo'] }}</a></li>
                        <li class="page-nav__item"><a href="#story">{{ $vars['base_history'] }}</a></li>
                        <li class="page-nav__item"><a href="#way">{{ $vars['base_how_to_get'] }}</a></li>
                        <li class="page-nav__item"><a href="#reviews">{{ $vars['base_reviews'] }}</a></li>
                        <li class="page-nav__item"><a href="#events">{{ $vars['base_events_early'] }}</a></li>
                        <li class="page-nav__item"><a href="#places">{{ $vars['base_where_to_stay'] }}</a></li>
                        <li class="page-nav__item"><a href="#meals">{{ $vars['base_where_to_eat'] }}</a></li>
                    </ul>
                    <div class="page-nav__button">
                        @include('front.partials.show-share')
                    </div>
                </sidebar>
            </div>

            <section class="page__route" id="photo">
                @foreach($routable as $entity)
                    <div class="page__route-item">
                        <a href="{{ RouteHelper::show($entity) }}" class="page__route-img-wr">
                            {{ $entity->image ? $entity->image->img('route')->lazy() : '' }}
                        </a>
                        <a href="{{ RouteHelper::show($entity) }}" class="page__route-name exo">{{ $entity->name }}</a>
                        <a href="{{ RouteHelper::show($entity) }}" class="page__route-city">
                            @if($entity->city)
                                <span class="material-icons">room</span>
                                {{ $entity->city }}
                            @endif
                        </a>
                    </div>
                @endforeach
            </section>

            <section class="article__info">
                <div class="article__img-wr wow fadeInUp">
                    {{ $route->image ? $route->image->img('main')->lazy() : '' }}
                </div>
                <div class="article__text article__block-info wow fadeInUp">
                    {!! $route->page_desc !!}
                    <p class="article__contact-title" id="info">
                        {{ $vars['base_help_info'] }}:
                    </p>

                    <p>{!! $route->life_hacks !!}</p>
                    <p>{!! $route->features !!}</p>
                    <p>{!! $route->static_info !!}</p>
                    <p>{!! $route->duration !!}</p>
                    <p>{!! $route->list_points !!}</p>
                    <p>{!! $route->addresses_representatives !!}</p>
                    <p>{!! $route->phones_representatives !!}</p>
                    <p>{!! $route->more_info !!}</p>

                    @if($route->site_link)
                        <a href="{{ $route->site_link }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $route->name }}</a>
                    @endif

                    @if($route->email)
                        <a href="{{ $route->email }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $route->email }}</a>
                    @endif

                    @if($route->location)
                        <a href="#" class="material-icons article__contact article__link">
                            <span class="material-icons">room</span>
                        {{ $route->location }}
                        </a>
                    @endif
                </div>
            </section>

            @if($route->history_desc)
                <section class="article__history article__block" id="story">
                    <div class="article__history-block wow fadeInLeft">
                        <h2 class="article__name exo">{{ $vars['base_history'] }}</h2>
                        <div class="article__history-text">
                            <p class="article__text">
                                {!! $route->history_desc !!}
                            </p>
                        </div>
                    </div>
                    @if($route->image_history)
                        <div class="article__img-wr wow fadeInRight">
                            {{ $route->image_history->img('history')->attributes(['class' => 'article__map'])->lazy() }}
                        </div>
                    @endif
                </section>
            @endif

            <section class="article__block article__pass" id="way">
                <div class="article__pass-text">
                    <h2 class="article__name wow fadeInUp">
                        {{ $vars['base_how_to_get'] }}
                    </h2>
                    <p class="article__text wow fadeInUp">
                        {!! $route->contact_desc !!}
                    </p>
                </div>

                <div class="article__map-wrap">
                    <div id="map"></div>
                </div>
            </section>

            @include('front.partials.reviews', ['entity' => $route, 'namespace' => 'routes'])

            <section class="article__events article__block" id="events">
                <h2 class="article__name article__name-position wow fadeInUp">
                    События поблизости
                </h2>
                <div class="article__cafe-slider wow fadeInUp">
                    <div class="swiper-container e1 article__events-slider-cont">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                10-15 окт. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Гостинница “Огни Енисея”
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                12 дек. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Река Енисей
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                1 янв. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Река Енисей
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0 exo">
                                                21 окт. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Койское белогоръе - Топольские столбы
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                11-12 ноя. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Музей артефактов на вершине пика Грандиозный
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next swiper-button "></div>
                        <div class="swiper-button-prev  swiper-button"></div>
                    </div>
                    <script>
                        const swiper1 = new Swiper('.e1', {
                            slidesPerView: 'auto',
                            spaceBetween: 79,
                            slidesOffsetBefore: 170,

                            //width: 1107,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        })
                    </script>
                </div>
            </section>

            <section class="article__place-for-sleep article__block" id="places">
                <h2 class="article__name article__name-position wow fadeInUp">
                    Где остановиться в пути
                </h2>
                <div class="article__cafe-slider wow fadeInUp">
                    <div class="swiper-container e2 article__events-slider-cont">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                10-15 окт. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Гостинница “Огни Енисея”
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                12 дек. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Река Енисей
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                1 янв. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Река Енисей
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0 exo">
                                                21 окт. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Койское белогоръе - Топольские столбы
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                11-12 ноя. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Музей артефактов на вершине пика Грандиозный
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next swiper-button "></div>
                        <div class="swiper-button-prev  swiper-button"></div>
                    </div>
                    <script>
                        const swiper2 = new Swiper('.e2', {
                            slidesPerView: 'auto',
                            spaceBetween: 79,
                            slidesOffsetBefore: 170,

                            //width: 1107,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        })
                    </script>
                </div>
            </section>

            <section class="article__cafe article__block" id="meals">
                <h2 class="article__name article__name-position wow fadeInUp">
                    Самые вкусные места на маршруте
                </h2>
                <div class="article__cafe-slider wow fadeInUp">
                    <div class="swiper-container e3 article__events-slider-cont">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                10-15 окт. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Гостинница “Огни Енисея”
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                12 дек. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Река Енисей
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                1 янв. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Река Енисей
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0 exo">
                                                21 окт. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Койское белогоръе - Топольские столбы
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="list__item d-flex flex-column">
                                    <a href="#" class="d-flex flex-column nop">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                11-12 ноя. 2020
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            Музей артефактов на вершине пика Грандиозный
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next swiper-button "></div>
                        <div class="swiper-button-prev  swiper-button"></div>
                    </div>
                    <script>
                        const swiper3 = new Swiper('.e3', {
                            slidesPerView: 'auto',
                            spaceBetween: 79,
                            slidesOffsetBefore: 170,

                            //width: 1107,
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        })
                    </script>
                </div>
            </section>
        </article>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $('a[href^="#"]').click(function(e) {
            e.preventDefault()
            var target = $(this).attr('href');
            $('html').animate({scrollTop: $(target).offset().top - 130 }, 900);
        })
    </script>

    <script>
        ymaps.ready(init);

        function init() {
            let geoData = '{{ $geoData->toJson() }}';
            let route = JSON.parse(geoData.replace(/&quot;/g,'"'));

            let nearItems = JSON.parse('{{ $nearGeoDataAll->toJson() }}'.replace(/&quot;/g,'"'));

            let routeMap = new ymaps.Map('map', {
                center: [route[0].lat, route[0].lng],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            })

            routeMap.geoObjects.add(new ymaps.multiRouter.MultiRoute({
                referencePoints: route.map(el => {
                    return [el.lat, el.lng]
                }),
                params: {
                    results: 1,
                    routingMode: '{{ $routeType }}',
                }
            }));

            var MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
            )

            for (let k = 0; k < nearItems.length; k++) {
                let item = nearItems[k]

                let image = '';
                if (item.imagePath) {
                    image = '<span><img src="{{ config('app.url') }}/storage/' + item.imagePath + '" style="max-width: 100px" /></span>';
                }

                let name = '';
                if (item.name) {
                    name = item.name;
                }

                routeMap.geoObjects.add(new ymaps.Placemark([item.lat, item.lng], {
                        hintContent: name,
                        balloonContent: image
                    }, {
                        // options
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: '{{ asset('front/img/Ygeo.svg') }}',
                        iconImageSize: [48, 48],
                        iconImageOffset: [-24, -24],
                        iconContentOffset: [15, 15],
                        iconContentLayout: MyIconContentLayout
                    })
                )
            }
        }
    </script>
@endsection
