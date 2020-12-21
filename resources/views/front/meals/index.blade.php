@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="places">
        <div class="places d-flex flex-column" id="places">
            <div class="places__heading heading heading--yellow" id="heading">
                <h1 class="heading__title heading__title--big">{{ $vars['places_title'] }}</h1>
                <div class="heading__selects heading__selects--meal">
                    <div class="heading__select" id="heading-first">
                        <select id="first">
                            <option disabled selected>Заведение</option>
                            <option>Кафе</option>
                            <option>Кофейни</option>
                            <option>Бары</option>
                            <option>Рестораны</option>
                            <option>Столовые</option>
                            <option>Булочные и кондитерские</option>
                        </select>
                    </div>
                    <div class="heading__select" id="heading-second">
                        <select id="second">
                            <option disabled selected>Сезон</option>
                            <option>Зима</option>
                            <option>Весна</option>
                            <option>Лето</option>
                            <option>Осень</option>
                            <option>В любой сезон</option>
                        </select>
                    </div>
                    <div class="heading__select" id="heading-third">
                        <select id="third">
                            <option disabled selected>Доставка</option>
                            <option>В заведении</option>
                            <option>С доставкой</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>
            <div class="places__items list">
                <ul class="nav nav-pills list__tabs wow fadeInUp" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ $vars['base_list'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $vars['base_on_map'] }}</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <p class="list__size">
                            {{ $vars['base_showed'] }}: {{ $meals->total() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="list__items show">
                            @foreach($meals as $meal)
                                <div class="list__item d-flex flex-column active">
                                    <a href="{{ route('front.meals.show', $meal->id) }}" class="d-flex flex-column nop position-relative">
                                        <img src="{{ asset('front/img/item-top.svg') }}" class="list__item-sign" alt="">
                                        <div class="list__img">
                                            {{ $meal->image ? $meal->image->img()->lazy() : '' }}
                                        </div>
                                        <p class="list__name exo">
                                            {{ $meal->name }}
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            {{ $meal->location }}
                                        </p>
                                    </a>
                                    <div class="list__buttons d-flex flex-row align-items-center">
                                        <button class="list__button list__button-add">
                                            {{ $vars['base_add'] }}
                                        </button>
                                        <button class="list__button list__button-star material-icons active" >
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="30px" height="30px">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                    <path d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z"/>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{ $meals->links('front.partials.paginator') }}

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent

    <script>
        $(function () {
            $("#first").selectmenu();

            $("#second").selectmenu();

            $("#third").selectmenu()

            $("#fourth").selectmenu();

            let first = $('#first')
            let second = $('#second')
            let third = $('#third')
            let fourth = $('#fourth')

            first.on('selectmenuchange', e => {
                console.log(e.toElement.innerHTML)
            })
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
        });
    </script>

    <script>
        ymaps.ready(init);

        function init() {
            let data = JSON.parse('{{ $geoData->toJson() }}'.replace(/&quot;/g,'"'));

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
                myPlacemark = new ymaps.Placemark([data[i].lat, data[i].lng], {
                    hintContent: data[i].name,
                    balloonContent: data[i].name
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
    </script>
@endsection
