@extends('layouts.front')

@section('title', 404)

@section('content')
    @php
        $varsRepository = app(\App\Repositories\VarRepository::class);
        $vars = $varsRepository->getAllVars();
    @endphp

    <main class="main error">
        <div class="error__container">
            <img src="{{ asset('front/img/404.svg') }}" alt="">
            <h1 class="error__code">404</h1>
        </div>
        <h2 class="error__message">
            {{ $vars['404_title'] }}
        </h2>
        <p class="error__text">
            {{ $vars['404_info'] }}
        </p>
        <a href="{{ route('front.home') }}" class="error__link">
            {{ $vars['404_home'] }}
        </a>
    </main>

@endsection
