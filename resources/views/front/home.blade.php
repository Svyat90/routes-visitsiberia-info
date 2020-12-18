@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="index">
        <div class="index d-flex flex-column" id="index-vue">
            <div class="index__header d-flex flex-column align-items-center justify-content-center">
                <h1 class="index__tagline">
                    Постройте маршрут и отправляйтесь в путешествие!
                </h1>
                <div class="index__constructor-wr">
                    <div class="index__constructor">
                        <div class="heading__selects heading__selects--index">
                            <div class="heading__select">
                                <input id="first" autocomplete="off" placeholder="Сроки" readonly="readonly">
                            </div>
                            <div class="index__transports d-flex flex-row">
                                <button class="btn material-icons index__transport">
                                    directions_car
                                </button>
                                <button class="btn material-icons active index__transport">
                                    directions_bus
                                </button>
                                <button class="btn material-icons index__transport">
                                    directions_walk
                                </button>
                            </div>
                            <select id="third">
                                <option disabled="disabled" selected="selected">С кем</option>
                                <option>Один или вдвоем</option>
                                <option>С ребенком до 3 лет</option>
                                <option>С ребенком до 10 лет</option>
                                <option>С подростком</option>
                                <option>Вся семья</option>
                                <option>Компания от 4-х человек</option>
                            </select>
                            <select id="fourth">
                                <option disabled="disabled" selected="selected">Тип отдыха</option>
                                <option title="Включает осмотр природных достопримечательностей, парков, заповедников, гор, катание на лыжах, сноубордах и т.п.">Активно-приключенческий</option>
                                <option title="Включает в себя более спокойные виды отдыха, такие как отдых на озерах, вблизи рек и на Красноярском море.">Спокойный отдых</option>
                                <option title="Включает в себя изучение таких направлений как Енисейск, Шушенское, Минусинск, Ачинск и Красноярск с точки зрения паломничества.">Культурно-познавательный</option>
                            </select>
                            <button id="index__submit">
                                <img src="{{ asset('front/img/index-arrow.svg') }}" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__plans-wr">
                <div class="index__plans d-flex flex-column">
                    <h2 class="index__title exo wow slideInUp">
                        Планируйте с <br> лёгкостью
                    </h2>
                    <div class="index__plans-info d-flex justify-content-between">
                        <div class="index__plans-text wow slideInLeft">
                            Благодаря своему географическому положению регион может похвастаться разнообразием
                            природных зон: от дикой и непроходимой тайги до больших степей и тундры.
                        </div>
                        <div class="index__plans-pluses exo d-flex flex-column wow slideInRight">
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">1</span>
                                <p class="index__plus">Множество готовых <br> маршрутов</p>
                            </div>
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">2</span>
                                <span class="index__plus">Конструктор <br> маршрутов</span>
                            </div>
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">3</span>
                                <span class="index__plus">Добавляйте объекты и <br> редактируйте</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__ways-wr">
                <div class="index__ways d-flex flex-column">
                    <h2 class="index__title exo wow slideInUp">
                        Готовые маршруты по <br> Красноярскому краю
                    </h2>
                    <div class="index__ways-places d-flex flex-column">
                        <div class="index__ways-place d-flex index__ways-place--left">
                            <div class="index__ways-img wow slideInLeft">
                                <img src="{{ asset('front/img/main-way-1.jpg') }}" alt="">
                            </div>
                            <div class="index__ways-info index__ways-info--left wow fadeInUp d-flex flex-column justify-content-center">
                                <span class="index__ways-place-year">2020</span>
                                <a class="index__ways-place-name exo">Койское белогоръе - Топольские столбы</a>
                                <a class="index__ways-place-city">
                                    <span class="material-icons">room&nbsp;</span>
                                    Красноярский край, Тыва
                                </a>
                            </div>
                        </div>
                        <div class="index__ways-place d-flex index__ways-place--right">
                            <div class="index__ways-img wow slideInRight">
                                <img src="{{ asset('front/img/main-way-1.jpg') }}" alt="">
                            </div>
                            <div class="index__ways-info index__ways-info--right wow fadeInUp d-flex flex-column justify-content-center">
                                <span class="index__ways-place-year">2019</span>
                                <a class="index__ways-place-name exo">Река Енисей</a>
                                <a class="index__ways-place-city">
                                    <span class="material-icons">room&nbsp;</span>
                                    Красноярский край, Тыва
                                </a>
                            </div>
                        </div>
                        <div class="index__ways-place d-flex index__ways-place--left">
                            <div class="index__ways-img wow slideInLeft">
                                <img src="{{ asset('front/img/main-way-1.jpg') }}" alt="">
                            </div>
                            <div class="index__ways-info index__ways-info--left wow fadeInUp d-flex flex-column justify-content-center">
                                <span class="index__ways-place-year">2019</span>
                                <a class="index__ways-place-name exo">Музей артефактов на вершине пика Грандиозный</a>
                                <a class="index__ways-place-city">
                                    <span class="material-icons">room&nbsp;</span>
                                    Енисей
                                </a>
                            </div>
                        </div>
                        <div class="index__ways-place d-flex index__ways-place--right">
                            <div class="index__ways-img wow slideInRight">
                                <img src="{{ asset('front/img/main-way-1.jpg') }}" alt="">
                            </div>
                            <div class="index__ways-info index__ways-info--right wow fadeInUp d-flex flex-column justify-content-center">
                                <span class="index__ways-place-year">2018</span>
                                <a class="index__ways-place-name exo">Река Енисей</a>
                                <a class="index__ways-place-city">
                                    <span class="material-icons">room&nbsp;</span>
                                    Красноярский край, Тыва
                                </a>
                            </div>
                        </div>
                        <div class="index__ways-place d-flex justify-content-center">
                            <a href="#" class="index__ways-link exo">Все маршруты</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__events-wr wow slideInUp">
                <div class="index__events">
                    <div class="index__title exo wow slideInUp">
                        Ближайшие события <br> края
                    </div>
                    <div class="index__events-slider swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide index__events-slide">
                                <a class="index__events-img nop">
                                    <img src="{{ asset('front/img/main-slider-1.jpg') }}" alt="">
                                </a>
                                <div class="index__events-info d-flex flex-column">
                                    <span class="index__ways-place-year">2018</span>
                                    <a class="index__ways-place-name exo">Река Енисей</a>
                                    <a class="index__ways-place-city">
                                        <span class="material-icons">room&nbsp;</span>
                                        Красноярский край, Тыва
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide index__events-slide">
                                <a class="index__events-img nop">
                                    <img src="{{ asset('front/img/main-slider-1.jpg') }}" alt="">
                                </a>
                                <div class="index__events-info d-flex flex-column">
                                    <span class="index__ways-place-year">2018</span>
                                    <a class="index__ways-place-name exo">Река Енисей</a>
                                    <a class="index__ways-place-city">
                                        <span class="material-icons">room&nbsp;</span>
                                        Красноярский край, Тыва
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide index__events-slide">
                                <a class="index__events-img nop">
                                    <img src="{{ asset('front/img/main-slider-1.jpg') }}" alt="">
                                </a>
                                <div class="index__events-info d-flex flex-column">
                                    <span class="index__ways-place-year">2018</span>
                                    <a class="index__ways-place-name exo">Река Енисей</a>
                                    <a class="index__ways-place-city">
                                        <span class="material-icons">room&nbsp;</span>
                                        Красноярский край, Тыва
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide index__events-slide">
                                <a class="index__events-img nop">
                                    <img src="{{ asset('front/img/main-slider-1.jpg') }}" alt="">
                                </a>
                                <div class="index__events-info d-flex flex-column">
                                    <span class="index__ways-place-year">2018</span>
                                    <a class="index__ways-place-name exo">Река Енисей</a>
                                    <a class="index__ways-place-city">
                                        <span class="material-icons">room&nbsp;</span>
                                        Красноярский край, Тыва
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide index__events-slide">
                                <a class="index__events-img nop">
                                    <img src="{{ asset('front/img/main-slider-1.jpg') }}" alt="">
                                </a>
                                <div class="index__events-info d-flex flex-column">
                                    <span class="index__ways-place-year">2018</span>
                                    <a class="index__ways-place-name exo">Река Енисей</a>
                                    <a class="index__ways-place-city">
                                        <span class="material-icons">room&nbsp;</span>
                                        Красноярский край, Тыва
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button swiper-button-prev"></div>
                        <div class="swiper-button swiper-button-next"></div>
                    </div>
                    <script>
                        let mySwiper = new Swiper('.swiper-container', {
                            slidesPerView: 'auto',
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        })
                    </script>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="index__events-link exo">Все события</a>
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
        const indexVue = new Vue({
            el: 'index-vue',
            mounted() {
                //console.log('VUE!')
            }
        })
    </script>
@endsection
