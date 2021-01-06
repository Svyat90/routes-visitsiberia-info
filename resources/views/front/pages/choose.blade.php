@extends('layouts.front')

@section('content')
    <main class="main" id="constructor">
        <div class="ctr d-flex justify-content-space-between">
            <a href="{{ route('front.home') }}" class="ctr__container d-flex flex-column align-items-center">
                <img class="ctr__img" src="{{ asset('front/img/ctr_1.svg') }}" alt="">
                <p class="ctr__title exo">
                    Констркутор маршрутов
                </p>
                <p class="ctr__description">
                    Выберите нужные параметры, а мы построим для вас наилучший маршрут
                </p>
            </a>
            <a href="{{ route('front.constructor') }}" class="ctr__container d-flex flex-column align-items-center">
                <img class="ctr__img" src="{{ asset('front/img/ctr_2.svg') }}" alt="">
                <p class="ctr__title exo">
                    Хочу составить маршрут самостоятельно
                </p>
                <p class="ctr__description">
                    Выбирайте объекты, которые хотите посетить, выставляйте порядок и в путь!
                </p>
            </a>
        </div>
    </main>
@endsection
