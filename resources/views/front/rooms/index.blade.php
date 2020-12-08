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
                        <select class="heading__select" id="first">
                            <option disabled selected>Город</option>
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
                    <div class="heading__select" id="heading-second">
                        <select class="heading__select" id="second">
                            <option disabled selected>Расстояние</option>
                            <option>&lt; 1км от центра</option>
                            <option>&lt; 3км от центра</option>
                            <option>&lt; 5км от центра</option>
                        </select>
                    </div>
                    <div class="heading__select" id="heading-third">
                        <select class="heading__select" id="third">
                            <option disabled selected>Тип размещения</option>
                            <option>Отели</option>
                            <option>Хостелы</option>
                            <option>Базы отдыха</option>
                            <option>Турбазы</option>
                            <option>Гостиницы для животных</option>
                        </select>
                    </div>
                </div>
            </div>
            <script>
                $(function () {
                    $("#first").selectmenu();

                    $("#second").selectmenu();

                    $("#third").selectmenu()
                });
            </script>
            <div class="rooms__items list">
                <ul class="nav nav-pills list__tabs" id="pills-tab" role="tablist">
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
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="list__items show">
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <div class="list__subinfo d-flex justify-content-between align-items-center">
                                        <p class="list__subprice mb-0">
                                            от 4000 руб./ночь
                                        </p>
                                        <p class="list__subrating d-flex mb-0" data-rating="3">
                                            <span class="material-icons">star</span>
                                            <span class="material-icons">star</span>
                                            <span class="material-icons">star</span>
                                            <span class="material-icons">star</span>
                                            <span class="material-icons">star</span>
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
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Музей артефактов на вершине пика Грандиозный
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons active">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add list__button--green">
                                        Добавлено<span class="material-icons">&nbsp;done</span>
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Музей артефактов на вершине пика Грандиозный
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons active">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Музей артефактов на вершине пика Грандиозный
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
                            </div>
                            <div class="list__item d-flex flex-column">
                                <a href="{{ route('front.rooms.show') }}" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Гостинница “Огни Енисея”
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        с. Парная
                                    </p>
                                </a>
                                <div class="list__buttons d-flex flex-row align-items-center">
                                    <button class="list__button list__button-add">
                                        Добавить
                                    </button>
                                    <button class="list__button list__button-star material-icons active">
                                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24"
                                             fill="black" width="30px" height="30px">
                                            <g>
                                                <rect fill="none" height="24" width="24" />
                                                <path
                                                    d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z" />
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <a href="#" class="list__button list__button-link">
                                    Перейти к маршруту
                                </a>
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
        const vue = new Vue({
            el: 'room',
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
