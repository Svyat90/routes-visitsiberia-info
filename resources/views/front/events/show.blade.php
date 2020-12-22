@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="places-item">
        <article class="main__article article">
            <div class="article__header">
                <div class="article__description wow fadeInLeft">
                    <h1 class="article__title">{{ $event->name }}</h1>
                    <div class="article__sign wow fadeInLeft">
                        @foreach($event->dictionaries as $dictionary)
                            <p class="article__sign-bold">
                                {{ $dictionary->parent->name }}: <span href="#" class="article__link">{{ $dictionary->name }}</span>
                            </p>
                        @endforeach
                        <p class="article__information">
                            {!! $event->header_desc !!}
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
                        <button class="page-nav__off">
                            <span class="material-icons page-nav__icon-add">add</span>
                        </button>
                        <a href="#" class="page-nav__share">
                            {{ $vars['base_share'] }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="19.5px"
                                 height="22px"
                                 class="page-nav__icon-share">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path
                                    d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                            </svg>
                        </a>
                    </div>
                    <a href="#" class="page-nav__link-map">{{ $vars['base_go_to_route'] }}</a>
                </sidebar>
            </div>

            <section class="article__info">
                <div class="article__img-wr wow fadeInUp">
                    {{ $event->image ? $event->image->img()->lazy() : '' }}
                </div>
                <div class="article__text article__block-info wow fadeInUp">
                    {!! $event->page_desc !!}
                    <p class="article__contact-title" id="info">
                        {{ $vars['base_contacts_owners'] }}:
                    </p>
                    @if($event->site_link)
                        <a href="{{ $event->site_link }}" class="material-icons article__contact article__link"><span class="material-icons">link</span>{{ $event->name }}</a>
                    @endif
                    <a href="#" class="article__contact article__link">Тепсей: молитва вечному небу. Какие тайны скрываетлегендарная гора?</a>
                    <a href="#" class="article__contact article__link">Гора Тепсей - ТУРИСТСКИЙ ИНФОРМАЦИОННЫЙ ЦЕНТР</a>
                </div>
            </section>

            <section class="article__slider article__block wow fadeInUp" id="photo">
                <div class="swiper-container article__slider-container">
                    <div class="swiper-wrapper">
                        @foreach($event->image_gallery as $image)
                            <div class="swiper-slide d-flex flex-column align-items-center">
                                <div class="article__slider-img-wr">
                                    {{ $image->img()->lazy() }}
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

            @if($event->history_desc)
                <section class="article__history article__block" id="story">
                    <div class="article__history-block wow fadeInLeft">
                        <h2 class="article__name exo">{{ $vars['base_history'] }}</h2>
                        <div class="article__history-text">
                            <p class="article__text">
                                {!! $event->history_desc !!}
                            </p>
                        </div>
                    </div>
                    @if($event->image_history)
                        <div class="article__img-wr wow fadeInRight">
                            {{ $event->image_history->img()->attributes(['class' => 'article__map'])->lazy() }}
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
                        {!! $event->contact_desc !!}
                    </p>
                </div>

                <div class="article__map-wrap">
                    <div id="map"></div>
                </div>
            </section>

            <section class="article__feedback article__block" id="reviews">
                <h2 class="article__name wow fadeInUp">{{ $vars['base_reviews'] }}:</h2>
                <div class="article__feedback-slider wow fadeInUp">
                    <div class="feedback">
                        <div class="feedback__img-wr">
                            <img src="{{  asset('front/img/feedback.png')  }}" alt="Image feedback"
                                 class="feedback__img">
                        </div>
                        <p class="feedback__name">Королёв В.</p>
                        <p class="feedback__data">3 октября 2020</p>
                        <div class="list__subrating d-flex mb-0 feedback__stars" data-rating="3">
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                        </div>
                        <p class="feedback__text">“Все очень понравилось! Это как раз тот случай, когда можно
                            спланировать поездку
                            от начала до конца”</p>

                        <div class="feedback__admin">
                            <div class="feedback__admin-title">
                                <div class="feedback__reply">
                                  <span class="material-icons feedback__icon">
                                    reply
                                  </span>
                                    <p class="feedback__reply-name">Ответ администратора</p>
                                </div>
                                <div class="feedback__reply-data">
                                    3 октября 2020
                                </div>
                                <div class="feedback__text">
                                    Спасибо за комментарий!
                                </div>
                            </div>
                        </div>
                        <div class="feedback__button">
                            <p class="feedback__button-name">
                                Ответить
                            </p>
                            <span class="material-icons feedback__button-icon">
                reply
              </span>
                        </div>
                    </div>
                </div>
                <button type="button" class="article__get-feedback">
                    Оставить отзыв
                </button>
            </section>

            <section class="article__events article__block" id="events">
                <h2 class="article__name article__name-position wow fadeInUp">
                    {{ $vars['base_events_early'] }}
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
                    {{ $vars['base_where_to_stay_on_way'] }}
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
                    {{ $vars['base_where_to_eat_desc'] }}
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
                lng: '{{ $event->lng }}'
            }

            var myMap = new ymaps.Map('map', {
                center: [item.lat, item.lng],
                zoom: 10
            }, {
                searchControlProvider: 'yandex#search'
            })

            var MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
            )

            myPlacemark = new ymaps.Placemark([item.lat, item.lng], {
                hintContent: 'Собственный значок метки',
                balloonContent: 'Это красивая метка'
            }, {
                // options
                iconLayout: 'default#imageWithContent',
                iconImageHref: '{{ asset('front/img/geo.svg') }}',
                iconImageSize: [48, 48],
                iconImageOffset: [-24, -24],
                iconContentOffset: [15, 15],
                iconContentLayout: MyIconContentLayout
            })

            myMap.geoObjects.add(myPlacemark)
        }
    </script>
@endsection
