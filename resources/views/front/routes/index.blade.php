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
                        <input id="first" autocomplete="off" placeholder="Сроки" readonly="readonly">
                    </div>
                    <select id="second">
                        <option disabled="disabled" selected="selected">Транспорт</option>
                        <option>Машина</option>
                        <option>Автобус</option>
                        <option>Пешком</option>
                    </select>
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
                        <option
                            title="Включает осмотр природных достопримечательностей, парков, заповедников, гор, катание на лыжах, сноубордах и т.п.">
                            Активно-приключенческий
                        </option>
                        <option
                            title=" Включает в себя более спокойные виды отдыха, такие как отдых на озерах, вблизи рек и на Красноярском море.">
                            Спокойный отдых
                        </option>
                        <option
                            title="Включает в себя изучение таких направлений как Енисейск, Шушенское, Минусинск, Ачинск и Красноярск с точки зрения паломничества.">
                            Культурно-познавательный
                        </option>
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
                            {{ $vars['base_showed'] }}: {{ $routes->count() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active list__sliders-wr" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="list__sliders show">
                            @foreach($routes as $route)
                                <div class="list__slider d-flex flex-column list__slider--1 wow fadeInUp">
                                <p class="list__slider-title">{{ $route['model']->name }}</p>
                                <div class="swiper-container list__slider-container">
                                    <div class="list__slider-story exo">
                                        {!! $route['model']->page_desc !!}
                                    </div>
                                    <div class="swiper-wrapper list__slider-wr">
                                        @foreach($route['routable'] as $entity)
                                            <div class="swiper-slide list__slide-wr">
                                            <div class="list__slide">
                                                <div class="list__slide-img-wr">
                                                    {{ $entity->image ? $entity->image->img()->lazy() : '' }}
                                                </div>
                                                <a href="{{ route('front.routes.show', $route['model']->id) }}" class="list__slide-name exo">
                                                    {{ $entity->name }}
                                                </a>
                                                <p class="list__slide-city">
                                                    <span class="material-icons">room&nbsp;</span>
                                                    {{ $entity->location }}
                                                </p>
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

{{--                    {{ $routes->links('front.partials.paginator') }}--}}
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $('#first').datepick({
            onSelect: function (dates) {
                console.log(dates);
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

        $("#second").selectmenu();

        $("#third").selectmenu()

        $("#fourth").selectmenu();

        let first = $('#first')
        let second = $('#second')
        let third = $('#third')
        let fourth = $('#fourth')

        second.on('selectmenuchange', e => {
            console.log(e.toElement.innerHTML)
            //тут нужно будет применять indexOf у массива вариантов селекта,
            //чтобы следить за измененяиями
        })
        third.on('selectmenuchange', e => {
            console.log(e.toElement.innerHTML)
        })
        fourth.on('selectmenuchange', e => {
            console.log(e.toElement.innerHTML)
        })
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
                        results: 1
                    }
                });

                myMap.geoObjects.add(multiRoute);
            }
        }
    </script>
@endsection
