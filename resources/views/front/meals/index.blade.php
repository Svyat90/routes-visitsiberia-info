@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="meal">
        <div class="meal d-flex flex-column">
            <div class="meal__heading heading heading--cyan" id="heading">
                <h1 class="heading__title">Еда</h1>
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
            <script>
                $(function () {
                    $("#first").selectmenu();

                    $("#second").selectmenu();

                    $("#third").selectmenu()

                    $("#fourth").selectmenu();
                });
            </script>
            <div class="meal__items list">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
                                <a href="{{ route('front.meals.show') }}" class="d-flex flex-column nop">
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
            el: 'meal',
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
