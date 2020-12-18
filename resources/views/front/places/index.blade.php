@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="places">
        <div class="places d-flex flex-column" id="places">
            <div class="places__heading heading heading--yellow" id="heading">
                <h1 class="heading__title heading__title--big">Достопримечательности</h1>
                <div class="heading__selects heading__selects--places wow fadeInUp">
                    <div class="heading__select" id="heading-first">
                        <select id="first">
                            <option disabled="disabled" selected="selected">Тип отдыха</option>
                            <option title="Включает осмотр природных достопримечательностей, парков, заповедников, гор, катание на лыжах, сноубордах и т.п.">
                                Активно-приключенческий</option>
                            <option title=" Включает в себя более спокойные виды отдыха, такие как отдых на озерах, вблизи рек и на Красноярском море.">
                                Спокойный отдых</option>
                            <option title="Включает в себя изучение таких направлений как Енисейск, Шушенское, Минусинск, Ачинск и Красноярск с точки зрения паломничества.">
                                Культурно-познавательный</option>
                        </select>
                    </div>
                    <div class="heading__select" id="heading-second">
                        <select id="second">
                            <option disabled="disabled" selected="selected">Сезон</option>
                            <option>Зима</option>
                            <option>Весна</option>
                            <option>Лето</option>
                            <option>Осень</option>
                            <option>В любой сезон</option>
                        </select>
                    </div>
                    <div class="heading__select" id="heading-third">
                        <select id="third">
                            <option disabled="disabled" selected="selected">Категория</option>
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
                    <div class="heading__select" id="heading-fourth">
                        <select id="fourth">
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
            <script>
                $(function () {
                    $("#first").selectmenu();
                    $("#second").selectmenu();
                    $("#third").selectmenu()
                    $("#fourth").selectmenu();
                });
            </script>
            <div class="places__items list">
                <ul class="nav nav-pills list__tabs wow fadeInUp" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Список</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">На карте</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <p class="list__size">
                            Показано: 122 результата
                        </p>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="list__items show">
                            @foreach($places as $place)
                                <div class="list__item d-flex flex-column active">
                                    <a href="#" class="d-flex flex-column nop position-relative">
                                        <img src="{{ asset('front/img/item-top.svg') }}" class="list__item-sign" alt="">
                                        <div class="list__img">
                                            <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                        </div>
                                        <p class="list__name exo">
                                            {{ $place->name }}
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            с. Парная
                                            {{ $place->location }}
                                        </p>
                                    </a>
                                    <div class="list__buttons d-flex flex-row align-items-center">
                                        <button class="list__button list__button-add">
                                            Добавить
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

                        <div class="places__pagination pagination wow fadeInUp">
                            <div class="pagination__page active">1</div>
                            <div class="pagination__page">2</div>
                            <div class="pagination__page">3</div>
                            <div class="pagination__page">4</div>
                        </div>
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
@endsection
