@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="places-item">
        <article class="main__article article">
            <div class="article__header">
                <div class="article__description wow fadeInLeft">
                    <div class="article__title-wrap">
                        <h1 class="article__title">{{ $event->name }}</h1>
                        <div class="article__share">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20px" height="20px"><path d="M0 0h24v24H0z" fill="none"/><path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/></svg>
                        </div>
                    </div>

                    <div class="article__add-to-pass route-item-add"
                         data-id="{{ $event->id }}"
                         data-type="route-events">
                        {{ $vars['base_add_to_route'] }}
                    </div>
                    <div class="article__add-to-pass page-nav__off active d-none route-item-added"
                         data-id="{{ $event->id }}"
                         data-type="route-events">
                        {{ $vars['base_added'] }}
                        <span class="material-icons">&nbsp;done</span>
                    </div>

                    <div class="article__sign wow fadeInLeft">
                        @foreach(DictionaryHelper::group($event->dictionaries) as $parentName => $dictionaries)
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
                            {!! $event->page_desc !!}
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
                        @include('front.partials.show-routes', ['entity' => $event, 'namespace' => 'events'])
                        @include('front.partials.show-share')
                    </div>
                    <a href="{{ route('front.choose') }}" class="page-nav__link-map route-item-go d-none" id="route-item-go-show">
                        {{ $vars['base_go_to_route'] }}
                    </a>
                </sidebar>
            </div>

            <section class="article__info">
                <div class="article__img-wr wow fadeInUp">
                    {{ $event->image ? $event->image->img('main')->lazy() : '' }}
                </div>
                <div class="article__text article__block-info wow fadeInUp">

                    <p class="article__contact-title" id="info">
                        {{ $vars['base_help_info'] }}:
                    </p>

                    <p>Есть кемпинг:
                        @if($event->have_camping)
                            Да
                        @else
                            Нет
                        @endif
                    </p>

                    {!! $event->life_hacks !!}
                    {!! $event->addresses_representatives !!}
                    {!! $event->phones_representatives !!}

                    <p class="article__contact-title" id="info">
                        {{ $vars['base_contacts'] }}:
                    </p>

                    @if($event->site_link)
                        <a href="{{ $event->site_link }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $event->name }}</a>
                    @endif

                    @if($event->additional_links)
                        @php $links =  explode("," , $event->additional_links) @endphp
                        @foreach($links as $link)
                            @if($link)
                                <a href="{{ $link }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $link }}</a>
                            @endif
                        @endforeach
                    @endif

                    @if($event->location)
                        <a class="material-icons article__contact article__link"
                            target="_blank"
                            href="{{ YandexGeoHelper::yandexMapLink($event->lng, $event->lat) }}"
                        >
                            <span class="material-icons">room</span>
                            {{ $event->location }}
                        </a>
                    @endif
                </div>
            </section>

            <section class="article__slider article__block wow fadeInUp" id="photo">
                <div class="swiper-container article__slider-container">
                    <div class="swiper-wrapper">
                        @foreach($event->image_gallery as $image)
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

            <section class="article__block article__pass" id="way">
                <div class="article__pass-text">
                    <h2 class="article__name wow fadeInUp">
                        {{ $vars['base_how_to_get'] }}
                    </h2>
                    <p class="article__text wow fadeInUp">
                        {!! $event->contact_desc !!}
                    </p>
                </div>

                <div class="article__map-wrap">
                    <div id="map"></div>
                </div>
            </section>

            @include('front.partials.reviews', ['entity' => $event, 'namespace' => 'events'])

            @if($hotels->count() > 0)
                <section class="article__place-for-sleep article__block" id="places">
                    <h2 class="article__name article__name-position wow fadeInUp">
                        {{ $vars['base_where_to_stay_on_way'] }}
                    </h2>
                    <div class="article__cafe-slider wow fadeInUp">
                        <div class="swiper-container e2 article__events-slider-cont">
                            <div class="swiper-wrapper">
                                @each('front.hotels.item', $hotels, 'hotel')
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
        $('#first').datepick({
            onSelect: function(dates) { console.log(dates); },
            yearRange:'c-0:c+2',
            firstDay: 1,
            multiSelect: 2,
            multiSeparator: ' — ',
            dateFormat: 'd M yyyyy',
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            monthNamesShort: ['янв', 'фев', 'мар', 'апр', 'май', 'июн',
                'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
        });

        ymaps.ready(init);

        function init() {
            let item = {
                lat: '{{ $event->lat }}',
                lng: '{{ $event->lng }}',
                name: '{{ $event->name }}',
            }

            let image = '{!! $event->image ? ImageHelper::image($event->image->id . '/' . $event->image->file_name, 100) : '' !!}';

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
                    balloonContent: image
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

                let image = '';
                if (item.imagePath) {
                    image = '<span><img src="{{ config('app.url') }}/storage/' + item.imagePath + '" style="max-width: 100px" /></span>';
                }

                let name = '';
                if (item.name) {
                    name = item.name;
                }

                placeMap.geoObjects.add(new ymaps.Placemark([item.lat, item.lng], {
                        hintContent: name,
                        balloonContent: image
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
