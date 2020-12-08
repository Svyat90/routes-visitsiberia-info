@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="route">
        <div class="route d-flex flex-column" id="route">
            <div class="route__heading heading heading--pink" id="heading">
                <h1 class="heading__title">Маршруты</h1>
                <div class="heading__selects heading__selects--route">
                    <div class="heading__select">
                        <input
                            id="first"
                            autocomplete="off"
                            placeholder="Начало пути — Финиш"
                            readonly
                        >
                    </div>
                    <select id="second">
                        <option disabled selected>Сколько дней</option>
                        <option>1 - 3 дней</option>
                        <option>3 - 7 дней</option>
                        <option>7 - 10 дней</option>
                        <option>10 - 15 дней</option>
                        <option>15 - 25 дней</option>
                        <option>25+ дней</option>
                    </select>
                    <select id="third">
                        <option disabled selected>С кем</option>
                        <option>Один или вдвоем</option>
                        <option>С ребенком до 3 лет</option>
                        <option>С ребенком до 10 лет</option>
                        <option>С подростком</option>
                        <option>Вся семья</option>
                        <option>Компания от 4-х человек</option>
                    </select>
                    <select id="fourth">
                        <option disabled selected>Тип отдыха</option>
                        <option title="Включает осмотр природных достопримечательностей, парков, заповедников, гор, катание на лыжах, сноубордах и т.п.">Активно-приключенческий</option>
                        <option title=" Включает в себя более спокойные виды отдыха, такие как отдых на озерах, вблизи рек и на Красноярском море.">Спокойный отдых</option>
                        <option title="Включает в себя изучение таких направлений как Енисейск, Шушенское, Минусинск, Ачинск и Красноярск с точки зрения паломничества.">Культурно-познавательный</option>
                    </select>
                </div>
            </div>
            <div class="route__items list">
                <ul class="nav nav-pills list__tabs wow fadeInUp" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                           aria-controls="pills-home" aria-selected="true">Список</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                           aria-controls="pills-profile" aria-selected="false">На карте</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <p class="list__size">
                            Показано: 122 результата
                        </p>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active list__sliders-wr" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="list__sliders show">
                            <div class="list__slider d-flex flex-column list__slider--1 wow fadeInUp">
                                <p class="list__slider-title">Название маршрута</p>
                                <div class="swiper-container list__slider-container">
                                    <p class="list__slider-story exo">В этом активном туре по Красноярскому краю у вас появится счастливая
                                        возможность пройти самые экзотические пешеходные маршруты Сибири:</p>
                                    <div class="swiper-wrapper list__slider-wr">
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Музей артефактов на вершине пика Грандиозный
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Музей артефактов на вершине пика Грандиозный
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                            <div class="list__slider d-flex flex-column list__slider--2 wow fadeInUp">
                                <p class="list__slider-title">Название маршрута</p>
                                <div class="swiper-container list__slider-container">
                                    <p class="list__slider-story exo">В этом активном туре по Красноярскому краю у вас появится счастливая
                                        возможность пройти самые экзотические пешеходные маршруты Сибири:</p>
                                    <div class="swiper-wrapper list__slider-wr">
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Музей артефактов на вершине пика Грандиозный
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Музей артефактов на вершине пика Грандиозный
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                            <div class="list__slider d-flex flex-column list__slider--3 wow fadeInUp">
                                <p class="list__slider-title">Название маршрута</p>
                                <div class="swiper-container list__slider-container">
                                    <p class="list__slider-story exo">В этом активном туре по Красноярскому краю у вас появится счастливая
                                        возможность пройти самые экзотические пешеходные маршруты Сибири:</p>
                                    <div class="swiper-wrapper list__slider-wr">
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Музей артефактов на вершине пика Грандиозный
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    <img src="{{ asset('front/img/route-slider-img.jpg') }}" alt="">
                                                </div>
                                                <a href="{{ route('front.routes.show') }}" class="list__slide-name exo">
                                                    Гостинница “Огни Енисея”
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    г. Тыва
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="places__pagination pagination">
                        <div class="pagination__page active">1</div>
                        <div class="pagination__page">2</div>
                        <div class="pagination__page">3</div>
                        <div class="pagination__page">4</div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    map
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $('#first').datepick({
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

        $("#second").selectmenu();

        $("#third").selectmenu()

        $("#fourth").selectmenu();
    </script>

    <script>
        var mySwiper = new Swiper('.swiper-container', {
            spaceBetween: 136,
            slidesPerView: 'auto',
            slidePrevClass: 'list__slide--prev',
            /* pagination: {
               el: '.swiper-pagination',
               type: 'progressbar',
             },*/
            scrollbar: {
                el: '.swiper-scrollbar',
                hide: false,
                dragSize: 300,
            },

            on: {
                init() {
                    if (this.slides.length <= 3) {
                        this.allowSlideNext = false
                        this.allowSlidePrev = false
                        this.scrollbar.el.destroy()
                    }
                }
            }
        })
    </script>

    <script>
        const vue = new Vue({
            el: 'route',
            data() {
                return {
                    data: []
                }
            },
            async mounted() {
                const res = await fetch('url')
                const data = await res.json()
                // data is raw data from the server
                this.data = data
            },
            methods: {
            }
        })
    </script>
@endsection
