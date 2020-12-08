@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="events">
        <div class="events d-flex flex-column" id="events">
            <div class="events__heading heading heading--green" id="heading">
                <h1 class="heading__title">События</h1>
                <div class="heading__selects heading__selects--events">
                    <div class="heading__select" id="heading-first">
                        <input
                            id="first"
                            autocomplete="off"
                            placeholder="Начало пути — Финиш"
                            readonly
                        >
                        <!-- <select id="first">
                          <option disabled selected>14 ноя 2020 - 23 ноя 2020</option>
                        </select> -->
                    </div>
                    <div class="heading__select" id="heading-second">
                        <select id="second">
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
                    <div class="heading__select" id="heading-third">
                        <select id="third">
                            <option disabled selected>С кем</option>
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
            <div class="events__items list">
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
                            <div
                                class="list__item d-flex flex-column"
                                v-for="event in events"
                            >
                                <a href="#" class="d-flex flex-column nop">
                                    <div class="list__img">
                                        <img src="{{ asset('front/img/item-img.jpg') }}" alt="">
                                    </div>
                                    <p href="#" class="list__name exo">
                                        Event name
                                    </p>
                                    <p href="#" class="list__city">
                                        <span class="material-icons">room&nbsp;</span>
                                        Event city
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
                            <!-- <div class="list__item d-flex flex-column">
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                              <a href="#" class="d-flex flex-column nop">
                                <div class="list__img">
                                  <img src="./img/item-img.jpg" alt="">
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
                            </div> -->
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
        /*  $('#first').multiDatesPicker({
            firstDay: 1,
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            // monthNamesShort: ['янв', 'фев', 'мар', 'апр', 'май', 'июн',
            // 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'],
            dateFormat: "d m yy",
            separator: ' — ',
            maxPicks: 2,
          });*/

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
        const events = new Vue({
            el: 'events',
            data() {
                return {
                    events: [],
                    a: 10,
                    filters: []
                }
            },
            async mounted() {
                const res = await fetch('url')
                const data = await res.json()
                // data is raw data from the server
                this.events = data
                await this.fetchFilters()
            },
            methods: {
                async fetchFilters() {
                    const res = await fetch('http://api.webcook.com.ua/public/api/dictionaries')
                    const data = await res.json()

                    this.filters = data.data
                    console.log(this.filters)
                }
            }
        })
    </script>
@endsection
