@extends('layouts.front')

@section('title', 500)

@section('content')
    @php
        $varsRepository = app(\App\Repositories\VarRepository::class);
        $vars = $varsRepository->getAllVars();
    @endphp

    <main class="main error">
        <div class="error__container">
            <img src="{{ asset('front/img/505.svg') }}" alt="">
            <h1 class="error__code">500</h1>
        </div>
        <h2 class="error__message">
            {{ $vars['500_title'] }}
        </h2>
        <p class="error__text">
            {{ $vars['500_info'] }}
        </p>
        <a href="{{ Request::url() }}" onclick="history.go(0)" class="error__link">
            {{ $vars['500_reset'] }}
        </a>
    </main>

@endsection
