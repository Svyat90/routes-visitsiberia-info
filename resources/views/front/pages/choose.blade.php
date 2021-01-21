@extends('layouts.front')

@section('content')
    <main class="main" id="constructor">
        <div class="ctr d-flex justify-content-space-between">
            <a href="{{ route('front.home') }}" class="ctr__container d-flex flex-column align-items-center">
                <img class="ctr__img" src="{{ asset('front/img/ctr_1.svg') }}" alt="">
                <p class="ctr__title exo">
                    {{ $vars['choose_constructor_title'] }}
                </p>
                <p class="ctr__description">
                    {{ $vars['choose_constructor_desc'] }}
                </p>
            </a>
            <a href="{{ route('front.constructor') }}" class="ctr__container d-flex flex-column align-items-center">
                <img class="ctr__img" src="{{ asset('front/img/ctr_2.svg') }}" alt="">
                <p class="ctr__title exo">
                    {{ $vars['choose_make_route_title'] }}
                </p>
                <p class="ctr__description">
                    {{ $vars['choose_make_route_desc'] }}
                </p>
            </a>
        </div>
    </main>
@endsection
