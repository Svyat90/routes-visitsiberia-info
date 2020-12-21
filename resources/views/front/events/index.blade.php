@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="rooms">
        <div class="rooms d-flex flex-column" id="rooms">
            <div class="rooms__heading heading heading--blue" id="heading">
                <h1 class="heading__title">Проживание</h1>
                <div class="heading__selects heading__selects--rooms">
                    <div class="heading__select" id="heading-first">
                        <input id="first" autocomplete="off" placeholder="Сроки" readonly="readonly">
                    </div>
                    <div class="heading__select" id="heading-second">
                        <select id="second">
                            <option disabled="disabled" selected="selected">Город</option>
                            <option>Активно</option>
                            <option>Спокойный</option>
                            <option>Культурно</option>
                            <option>Озера, реки и водопады</option>
                            <option>Горы и скалы</option>
                            <option>Места силы</option>
                            <option>Храмы и святыни</option>
                            <option>Парки и заповедники</option>
                            <option>Городские пространства</option>
                            <option>Музеи</option>
                            <option>Скульптура и архитектура</option>
                        </select>
                    </div>
                    <div class="heading__select" id="heading-third">
                        <select id="third">
                            <option disabled="disabled" selected="selected">С кем</option>
                            <option>Один или вдвоем</option>
                            <option>С ребенком до 3 лет</option>
                            <option>С ребенком до 10 лет</option>
                            <option>С подростком</option>
                            <option>Вся семья</option>
                            <option>Компания от 4-х человек</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="rooms__items list">
                <ul class="nav nav-pills list__tabs" id="pills-tab" role="tablist">
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
                            {{ $vars['base_showed'] }}: {{ $events->total() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="list__items show">
                            @foreach($events as $event)
                                <div class="list__item d-flex flex-column">
                                    <a href="{{ route('front.events.show', $event->id) }}"
                                       class="d-flex flex-column nop">
                                        <div class="list__img">
                                            {{ $event->image ? $event->image->img()->lazy() : '' }}
                                        </div>
                                        <div class="list__subinfo d-flex justify-content-between align-items-center">
                                            <p class="list__subprice mb-0">
                                                {{ $event->date_from->format('d') . '-' . $event->date_to->format('d') . ' ' . $event->date_to->format('F') . ' ' .  $event->date_to->format('Y') }}
                                            </p>
                                        </div>
                                        <p class="list__name exo">
                                            {{ $event->name }}
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            {{ $event->location }}
                                        </p>
                                    </a>
                                    <div class="list__buttons d-flex flex-row align-items-center">
                                        <button class="list__button list__button-add">
                                            {{ $vars['base_add'] }}
                                        </button>
                                        <button class="list__button list__button-star material-icons">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                                 viewBox="0 0 24 24"
                                                 fill="black" width="30px" height="30px">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                    <path
                                                        d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z"/>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                        {{ $events->links('front.partials.paginator') }}

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
                    'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            });

            $("#second").selectmenu();
            $("#third").selectmenu()
            $("#fourth").selectmenu()

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
