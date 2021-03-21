@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="index">
        <div class="index d-flex flex-column" id="index-vue">
            <div class="index__header d-flex flex-column align-items-center justify-content-center">
                <video loop autoplay muted class="index__video">
                    <source src="{{ asset('front/video/videoplayback.webm') }}" type="video/webm">
                </video>

                <h1 class="index__tagline">
                    {{ $vars['home_title'] }}
                </h1>

                <div class="index__constructor-wr">
                    <div class="index__constructor">
                        <form action="{{ route('front.routes.index') }}" name="filters" class="heading__selects heading__selects--index" >
                            <input name="date_from" type="hidden" />
                            <input name="date_to" type="hidden" />

                            <select name="season_id" id="season_id">
                                @php $seasonId = request()->get('season_id') ?? null; @endphp
                                <option value="" disabled="disabled" selected="selected">{{ $vars['filter_season'] }}</option>
                                @foreach($seasonList as $season)
                                    <option
                                        value="{{ $season->id }}"
                                        {{ $seasonId && $seasonId == $season->id ? 'selected' : '' }} >
                                        {{ $season->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="transport_id"  id="transport_id">
                                @php $transportId = request()->get('transport_id') ?? null; @endphp
                                <option disabled="disabled" selected="selected">{{ $vars['filter_transport'] }}</option>
                                @foreach($transportList as $transport)
                                    <option
                                        value="{{ $transport->id }}"
                                        {{ $transportId && $transportId == $transport->id ? 'selected' : '' }} >
                                        {{ $transport->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="whom_id"  id="whom_id">
                                @php $whomId = request()->get('whom_id') ?? null; @endphp
                                <option disabled="disabled" selected="selected">{{ $vars['filter_whom'] }}</option>
                                @foreach($whomList as $whom)
                                    <option
                                        value="{{ $whom->id }}"
                                        {{ $whomId && $whomId == $whom->id ? 'selected' : '' }} >
                                        {{ $whom->name }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="type_id" id="type_id">
                                @php $typeId = request()->get('type_id') ?? null; @endphp
                                <option value="" disabled="disabled" selected="selected">{{ $vars['filter_type_rest'] }}</option>
                                @foreach($typeList as $type)
                                    <option
                                        value="{{ $type->id }}"
                                        {{ $typeId && $typeId == $type->id ? 'selected' : '' }} >
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>

                            <button id="index__submit">
                                <img src="{{ asset('front/img/index-arrow.svg') }}" alt="">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="index__plans-wr">
                <div class="index__plans d-flex flex-column">
                    <h2 class="index__title exo wow slideInUp">
                        {!! $vars['home_plan_easy_title'] !!}
                    </h2>
                    <div class="index__plans-info d-flex justify-content-between">
                        <div class="index__plans-text wow slideInLeft">
                            {{ $vars['home_plan_easy_desc'] }}
                        </div>
                        <div class="index__plans-pluses exo d-flex flex-column wow slideInRight">
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">1</span>
                                <p class="index__plus">{!! $vars['home_plan_easy_desc_first'] !!}</p>
                            </div>
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">2</span>
                                <span class="index__plus">{!! $vars['home_plan_easy_desc_second'] !!}</span>
                            </div>
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">3</span>
                                <span class="index__plus">{!! $vars['home_plan_easy_desc_third'] !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__ways-wr">
                <div class="index__ways d-flex flex-column">
                    <h2 class="index__title exo wow slideInUp">
                        {!! $vars['home_ready_routes_title'] !!}
                    </h2>
                    <div class="index__ways-places d-flex flex-column">
                        @foreach($routes as $route)
                            @if($loop->odd)
                                <div class="index__ways-place d-flex index__ways-place--left">
                                    <div class="index__ways-img wow slideInLeft">
                                        {{ $route->image ? $route->image->img('main')->lazy() : '' }}
                                    </div>
                                    <div class="index__ways-info index__ways-info--left wow fadeInUp d-flex flex-column justify-content-center">
                                        <a href="{{ route('front.routes.show', $route->id) }}" class="index__ways-place-name exo text-color-imp">{{ $route->name }}</a>
                                        <a href="{{ route('front.routes.show', $route->id) }}" class="index__ways-place-city text-color-imp">
                                            @if($route->location)
                                                <span class="material-icons">room&nbsp;</span>
                                                {{ $route->location }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="index__ways-place d-flex index__ways-place--right">
                                    <div class="index__ways-img wow slideInRight">
                                        {{ $route->image ? $route->image->img('main')->lazy() : '' }}
                                    </div>
                                    <div class="index__ways-info index__ways-info--right wow fadeInUp d-flex flex-column justify-content-center">
                                        <a href="{{ route('front.routes.show', $route->id) }}" class="index__ways-place-name exo text-color-imp">{{ $route->name }}</a>
                                        <a href="{{ route('front.routes.show', $route->id) }}" class="index__ways-place-city text-color-imp">
                                            @if($route->location)
                                                <span class="material-icons">room&nbsp;</span>
                                                {{ $route->location }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="index__ways-place d-flex justify-content-center">
                            <a href="{{ route('front.routes.index') }}" class="index__ways-link exo">{{ $vars['routes_all'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__events-wr wow slideInUp">
                <div class="index__events">
                    <div class="index__title exo wow slideInUp">
                        {!! $vars['home_near_events'] !!}
                    </div>
                    <div class="index__events-slider swiper-container">
                        <div class="swiper-wrapper">

                            @forelse($events as $event)
                                <div class="swiper-slide index__events-slide">
                                    <a href="{{ route('front.events.show', $event->id) }}" class="index__events-img nop">
                                        {{ $event->image ? $event->image->img('near')->lazy() : '' }}
                                    </a>
                                    <div class="index__events-info d-flex flex-column">
                                        <a href="{{ route('front.events.show', $event->id) }}" class="index__ways-place-name exo text-color-imp">{{ $event->name }}</a>
                                        <a class="index__ways-place-city text-color-imp"
                                           target="_blank"
                                           href="{{ YandexGeoHelper::yandexMapLink($event->lng, $event->lat) }}"
                                        >
                                            @if($event->city)
                                                <span class="material-icons">room&nbsp;</span>
                                                {{ $event->city }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="swiper-slide index__events-slide">
                                    {{ $vars['events_no'] }}
                                </div>
                            @endforelse

                        </div>
                        <div class="swiper-button swiper-button-prev"></div>
                        <div class="swiper-button swiper-button-next"></div>
                    </div>
                    <script>
                        let mySwiper = new Swiper('.swiper-container', {
                            slidesPerView: 'auto',
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev',
                            },
                        })
                    </script>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('front.events.index') }}" class="index__events-link exo">{{ $vars['events_all'] }}</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        let season = $('#season_id');
        let type = $('#type_id');
        let transport = $('#transport_id');
        let whom = $('#whom_id');
        let filterForm = $('form[name="filters"]');
        let dateFrom = $('input[name="date_from"]');
        let dateTo = $('input[name="date_to"]');

        season.selectmenu();
        type.selectmenu();
        transport.selectmenu()
        whom.selectmenu();

    </script>
@endsection
