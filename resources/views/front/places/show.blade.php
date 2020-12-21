@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="places-item">
        <article class="main__article article">
            <div class="article__header">
                <div class="article__description wow fadeInLeft">
                    <h1 class="article__title">{{ $place->name }}</h1>
                    @if($place->recommended)
                        <div class="article__recommendation">
                            <svg width="32" height="32" viewBox="0 0 56 56" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="5.6665" width="32" height="32" fill="white"/>
                                <path
                                    d="M7.02333 0L7 37.3333L28 51.3333L48.9767 37.3333L49 0H7.02333ZM23.3333 35L11.6667 23.3333L14.9567 20.02L23.3333 28.3967L41.0433 10.6867L44.3333 14L23.3333 35Z"
                                    fill="#FFB906"/>
                            </svg>
                            <p class="article__recommendation-text" id="desc">{{ $vars['base_tic_recommended'] }}</p>
                        </div>
                    @endif
                    <div class="article__sign wow fadeInLeft">
                        @foreach($place->dictionaries as $dictionary)
                            <p class="article__sign-bold">
                                {{ $dictionary->parent->name }}: <span href="#" class="article__link">{{ $dictionary->name }}</span>
                            </p>
                        @endforeach
                        <p class="article__information">
                            {!! $place->header_desc !!}
                        </p>
                    </div>
                </div>

                <sidebar class="article__page-nav page-nav wow fadeInRight">
                    <ul class="page-nav__list">
                        <li>{{ $vars['base_desc'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_help_info'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_photo'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_history'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_how_to_get'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_reviews'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_events_early'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_where_to_stay'] }}</li>
                        <li class="page-nav__item">{{ $vars['base_where_to_eat'] }}</li>
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
                    {{ $place->image ? $place->image->img()->lazy() : '' }}
                </div>
                <div class="article__text article__block-info wow fadeInUp">
                    {!! $place->page_desc !!}
                    <p class="article__contact-title" id="info">
                        {{ $vars['base_help_info'] }}:
                    </p>
                    {!! $place->helpful_info !!}
                </div>
            </section>

            <section class="article__slider article__block wow fadeInUp" id="photo">
                <div class="swiper-container article__slider-container">
                    <div class="swiper-wrapper">
                        @foreach($place->image_gallery as $image)
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

            <section class="article__history article__block" id="story">
                <div class="article__history-block wow fadeInLeft">
                    <h2 class="article__name exo">{{ $vars['base_history'] }}</h2>
                    <div class="article__history-text">
                        <p class="article__text">
                            {!! $place->history_desc !!}
                        </p>
                    </div>
                </div>
                @if($hotel->image_history)
                    <div class="article__img-wr wow fadeInRight">
                        {{ $place->image_history->img()->attributes(['class' => 'article__map'])->lazy() }}
                    </div>
                @endif
            </section>

            <section class="article__block article__pass" id="way">
                <div class="article__pass-text">
                    <h2 class="article__name wow fadeInUp">
                        {{ $vars['base_how_to_get'] }}
                    </h2>
                    <p class="article__text wow fadeInUp">
                        {!! $place->contact_desc !!}
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
        ymaps.ready(init);

        function init() {
            let item = {
                lat: '{{ $place->lat }}',
                lng: '{{ $place->lng }}'
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
