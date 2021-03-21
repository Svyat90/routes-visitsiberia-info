@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="places-item">
        <article class="main__article article">
            <div class="article__header">
                <div class="article__description wow fadeInLeft">
                    <div class="article__title-wrap">
                        <h1 class="article__title">{{ $hotel->name }}</h1>
                        <div class="article__share">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20px" height="20px"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg>
                        </div>
                    </div>

                    @if($hotel->recommended)
                        <div class="article__recommendation">
                            <svg class="article__icon-recommandation" width="32" height="32" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="5.6665" width="32" height="32" fill="white"/>
                                <path d="M7.02333 0L7 37.3333L28 51.3333L48.9767 37.3333L49 0H7.02333ZM23.3333 35L11.6667 23.3333L14.9567 20.02L23.3333 28.3967L41.0433 10.6867L44.3333 14L23.3333 35Z" fill="#FFB906"/>
                            </svg>
                            <p class="article__recommendation-text" id="desc">{{ $vars['base_tic_recommended'] }}</p>
                        </div>
                    @endif

                    <div class="article__add-to-pass route-item-add"
                         data-id="{{ $hotel->id }}"
                         data-type="route-hotels">
                        {{ $vars['base_add_to_route'] }}
                    </div>
                    <div class="article__add-to-pass page-nav__off active d-none route-item-added"
                         data-id="{{ $hotel->id }}"
                         data-type="route-hotels">
                        {{ $vars['base_added'] }}
                        <span class="material-icons">&nbsp;done</span>
                    </div>

                    <div class="article__sign wow fadeInLeft">

                        @include('front.partials.dictionary', ['model' => $hotel, 'parentType' => \App\Services\DictionaryService::TYPE_PLACEMENT])
                        @include('front.partials.dictionary', ['model' => $hotel, 'parentType' => \App\Services\DictionaryService::TYPE_SEASON, 'base' => true])

                        <p class="article__information article__text" id="desc">
                            {!! $hotel->description !!}
                        </p>
                    </div>
                </div>

                <sidebar class="article__page-nav page-nav wow fadeInRight">
                    <ul class="page-nav__list">
                        <li class="page-nav__item"><a href="#desc">{{ $vars['base_desc'] }}</a></li>
                        <li class="page-nav__item"><a href="#info">{{ $vars['base_help_info'] }}</a></li>
                        <li class="page-nav__item"><a href="#photo">{{ $vars['base_photo'] }}</a></li>
                        <li class="page-nav__item"><a href="#story">{{ __('global.conditions') }}</a></li>
                        <li class="page-nav__item"><a href="#way">{{ $vars['base_how_to_get'] }}</a></li>
                        <li class="page-nav__item"><a href="#reviews">{{ $vars['base_reviews'] }}</a></li>
                        <li class="page-nav__item"><a href="#events">{{ $vars['base_events_early'] }}</a></li>
                        <li class="page-nav__item"><a href="#places">{{ $vars['base_where_to_stay'] }}</a></li>
                        <li class="page-nav__item"><a href="#meals">{{ $vars['base_where_to_eat'] }}</a></li>
                    </ul>
                    <div class="page-nav__button">

                        @include('front.partials.show-routes', ['entity' => $hotel, 'namespace' => 'hotels'])
                        @include('front.partials.show-share')

                    </div>
                    <a href="{{ route('front.choose') }}" class="page-nav__link-map route-item-go d-none" id="route-item-go-show">
                        {{ $vars['base_go_to_route'] }}
                    </a>
                </sidebar>
            </div>

            <section class="article__info" style="margin-top: 0px;">
                <div class="article__text article__block-info wow fadeInUp">
                    <p class="article__contact-title" id="info">
                        {{ $vars['base_contacts'] }}:
                    </p>

                    @if($hotel->site_link)
                        <a href="{{ $hotel->site_link }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $hotel->name }}</a>
                    @endif

                    @if($aggregatorLinks)
                        @foreach($aggregatorLinks as $link)
                            @if($link->url && $link->title)
                                <a href="{{ $link->url }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $link->title }}</a>
                            @endif
                        @endforeach
                    @endif

                    @if($socialLinks)
                        @foreach($socialLinks as $link)
                            @if($link->url && $link->title)
                                <a href="{{ $link->url }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $link->title }}</a>
                            @endif
                        @endforeach
                    @endif

                    @if($phones)
                        @foreach($phones as $phone)
                            @if($phone->title)
                                <a href="tel:{{ $phone->title }}" class="material-icons article__contact article__link"><span class="material-icons">call</span>{{ $phone->title }}</a>
                            @endif
                        @endforeach
                    @endif

                    @if($hotel->location)
                        <a class="material-icons article__contact article__link"
                           target="_blank"
                           href="{{ YandexGeoHelper::yandexMapLink($hotel->lng, $hotel->lat) }}"
                        >
                            <span class="material-icons">room</span>
                            {{ $hotel->location }}
                        </a>
                    @endif
                </div>
            </section>

            @if($hotel->image_gallery->count())
                <section class="article__slider article__block wow fadeInUp" id="photo">
                    <div class="swiper-container article__slider-container">
                        <div class="swiper-wrapper">
                            @foreach($hotel->image_gallery as $image)
                                <div class="swiper-slide d-flex flex-column align-items-center">
                                    <div class="article__slider-img-wr">
                                        {{ $image->img('gallery')->lazy() }}
                                    </div>
                                    <p class="article__slider-description exo">
                                        {{ $image->getCustomProperty('title') }}
                                    </p>
                                    <p class="article__slider-author">
                                        {{ $image->getCustomProperty('desc') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-button"></div>
                    <div class="swiper-button-prev swiper-button"></div>
                    <script>
                        const gallerySwiper = new Swiper('.article__slider-container', {
                            slidesPerView: 1,

                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        })
                    </script>
                </section>
            @endif

            <section class="article__history article__block" id="story">
                <div class="article__history-block wow fadeInLeft">
                    <h2 class="article__name exo">{{ __('global.conditions') }}</h2>
                    <div class="article__history-text">
                        <div class="article__text">
                            {!! \App\Helpers\HtmlHelper::clearHtml($hotel->conditions_accommodation) !!}
                        </div>
                        <p class="article__text article__text-bold">
                            - {{ __('global.have_food_point') }}
                        </p>
                        <p class="article__text">
                            {{ $hotel->have_food_point ? __('global.yes') : __('global.no') }}
                        </p>
                        <p class="article__text article__text-bold">
                            - {{ __('global.term_payment') }}
                        </p>
                        <p class="article__text">
                            {{ __('global.' . $hotel->conditions_payment) }}
                        </p>
                    </div>
                </div>
            </section>

            @if($hotel->rooms_fund)
                <section class="article__history article__block" id="story">
                    <div class="article__history-block wow fadeInLeft">
                        <h2 class="article__name exo">{{ __('global.rooms_fund') }}</h2>
                        <div class="article__history-text">
                            <div class="article__text">
                                {!! \App\Helpers\HtmlHelper::clearHtml($hotel->rooms_fund) !!}
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if($hotel->additional_services)
                <section class="article__history article__block" id="story">
                    <div class="article__history-block wow fadeInLeft">
                        <h2 class="article__name exo">{{ __('global.additional_services') }}</h2>
                        <div class="article__history-text">
                            <div class="article__text">
                                {!! \App\Helpers\HtmlHelper::clearHtml($hotel->additional_services) !!}
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            <section class="article__block article__pass" id="way">
                <div class="article__pass-text">
                    <h2 class="article__name wow fadeInUp">
                        {{ $vars['base_how_to_get'] }}
                    </h2>
                    <div class="article__text wow fadeInUp">
                        {!! \App\Helpers\HtmlHelper::clearHtml($hotel->contact_desc) !!}
                    </div>
                </div>

                <div class="article__map-wrap">
                    <div id="map"></div>
                </div>
            </section>

            @include('front.partials.reviews', ['entity' => $hotel, 'namespace' => 'hotels'])

            @if($events->count() > 0)
                <section class="article__events article__block" id="events">
                    <h2 class="article__name article__name-position wow fadeInUp">
                        {{ $vars['base_events_early'] }}
                    </h2>
                    <div class="article__cafe-slider wow fadeInUp">
                        <div class="swiper-container e1 article__events-slider-cont">
                            <div class="swiper-wrapper">
                                @each('front.events.item', $events, 'event')
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
            @endif

            @if($places->count() > 0)
                <section class="article__place-for-sleep article__block" id="places">
                    <h2 class="article__name article__name-position wow fadeInUp">
                        {{ $vars['base_where_to_stay_on_way'] }}
                    </h2>
                    <div class="article__cafe-slider wow fadeInUp">
                        <div class="swiper-container e2 article__events-slider-cont">
                            <div class="swiper-wrapper">
                                @each('front.places.item', $places, 'place')
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
            @endif

            @if($meals->count() > 0)
                <section class="article__cafe article__block" id="meals">
                    <h2 class="article__name article__name-position wow fadeInUp">
                        {{ $vars['base_where_to_eat_desc'] }}
                    </h2>
                    <div class="article__cafe-slider wow fadeInUp">
                        <div class="swiper-container e3 article__events-slider-cont">
                            <div class="swiper-wrapper">
                                @each('front.meals.item', $meals, 'meal')
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
            @endif
        </article>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        ymaps.ready(init);

        function init() {
            let item = {
                lat: '{{ $hotel->lat }}',
                lng: '{{ $hotel->lng }}',
                name: '{{ $hotel->name }}',
                label: '{{ __("global.types.hotels") }}',
                location: '{{ $hotel->location }}',
                site_link: '{{ $hotel->site_link }}',
                link: '{{ route('front.hotels.show', $hotel->id) }}',
                phone: '{{ $phones->first() ? $phones->first()->url : '' }}',
            }

            let popup = renderPopup(item.name, item.label, item.phone, '', item.location, item.lat, item.lng, item.site_link, item.link);

            let name = '';
            if (item.name) {
                name = item.name;
            }

            let nearItems = JSON.parse('{{ $nearGeoData->toJson() }}'.replace(/&quot;/g,'"'));

            let placeMap = new ymaps.Map('map', {
                center: [item.lat, item.lng],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            })

            let iconContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
            )

            placeMap.geoObjects.add(new ymaps.Placemark([item.lat, item.lng], {
                    hintContent: name,
                    balloonContent: popup
                }, {
                    // options
                    iconLayout: 'default#imageWithContent',
                    iconImageHref: '{{ asset('front/img/geo.svg') }}',
                    iconImageSize: [48, 48],
                    iconImageOffset: [-24, -24],
                    iconContentOffset: [15, 15],
                    iconContentLayout: iconContentLayout
                })
            )

            for (let j = 0; j < nearItems.length; j++) {
                let item = nearItems[j]

                let popup = renderPopup(item.name, item.label, item.phone, '', item.location, item.lat, item.lng, item.site_link, item.link);

                let name = '';
                if (item.name) {
                    name = item.name;
                }

                placeMap.geoObjects.add(new ymaps.Placemark([item.lat, item.lng], {
                        hintContent: name,
                        balloonContent: popup
                    }, {
                        // options
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: '{{ asset('front/img/Ygeo.svg') }}',
                        iconImageSize: [48, 48],
                        iconImageOffset: [-24, -24],
                        iconContentOffset: [15, 15],
                        iconContentLayout: iconContentLayout
                    })
                )
            }
        }
    </script>
@endsection
