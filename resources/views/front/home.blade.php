@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="index">
        <div class="index d-flex flex-column" id="index-vue">
            <div class="index__header d-flex flex-column align-items-center justify-content-center">
                <h1 class="index__tagline">
                    Постройте маршрут и отправляйтесь в путешествие!
                </h1>
                <div class="index__constructor-wr">
                    <div class="index__constructor">
                        <div class="heading__selects heading__selects--index">
                            <form action="{{ route('front.routes.index') }}" name="filters" style="display: flex;">
                                <input name="date_from" type="hidden" />
                                <input name="date_to" type="hidden" />
                                <div class="heading__select">
                                    <input name="date_range" id="first" autocomplete="off" placeholder="Сроки" readonly="readonly">
                                </div>

                                <select name="transport_id"  id="transport_id">
                                    @php $transportId = request()->get('transport_id') ?? null; @endphp
                                    <option disabled="disabled" selected="selected">Транспорт</option>
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
                                    <option disabled="disabled" selected="selected">{{ $vars['places_whom'] }}</option>
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
                                    <option value="" disabled="disabled" selected="selected">{{ $vars['places_type_rest'] }}</option>
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
            </div>
            <div class="index__plans-wr">
                <div class="index__plans d-flex flex-column">
                    <h2 class="index__title exo wow slideInUp">
                        Планируйте с <br> лёгкостью
                    </h2>
                    <div class="index__plans-info d-flex justify-content-between">
                        <div class="index__plans-text wow slideInLeft">
                            Благодаря своему географическому положению регион может похвастаться разнообразием
                            природных зон: от дикой и непроходимой тайги до больших степей и тундры.
                        </div>
                        <div class="index__plans-pluses exo d-flex flex-column wow slideInRight">
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">1</span>
                                <p class="index__plus">Множество готовых <br> маршрутов</p>
                            </div>
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">2</span>
                                <span class="index__plus">Конструктор <br> маршрутов</span>
                            </div>
                            <div class="index__plans-plus d-flex wow slideInRight">
                                <span class="index__number">3</span>
                                <span class="index__plus">Добавляйте объекты и <br> редактируйте</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__ways-wr">
                <div class="index__ways d-flex flex-column">
                    <h2 class="index__title exo wow slideInUp">
                        Готовые маршруты по <br> Красноярскому краю
                    </h2>
                    <div class="index__ways-places d-flex flex-column">
                        @foreach($routes as $route)
                            @if($loop->odd)
                                <div class="index__ways-place d-flex index__ways-place--left">
                                    <div class="index__ways-img wow slideInLeft">
                                        {{ $route->image ? $route->image->img()->lazy() : '' }}
                                    </div>
                                    <div class="index__ways-info index__ways-info--left wow fadeInUp d-flex flex-column justify-content-center">
                                        <span class="index__ways-place-year">{{ DateHelper::year($route) }}</span>
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
                                        {{ $route->image ? $route->image->img()->lazy() : '' }}
                                    </div>
                                    <div class="index__ways-info index__ways-info--right wow fadeInUp d-flex flex-column justify-content-center">
                                        <span class="index__ways-place-year">{{ DateHelper::year($route) }}</span>
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
                            <a href="{{ route('front.routes.index') }}" class="index__ways-link exo">Все маршруты</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="index__events-wr wow slideInUp">
                <div class="index__events">
                    <div class="index__title exo wow slideInUp">
                        Ближайшие события <br> края
                    </div>
                    <div class="index__events-slider swiper-container">
                        <div class="swiper-wrapper">

                            @forelse($events as $event)
                                <div class="swiper-slide index__events-slide">
                                    <a href="{{ route('front.events.show', $event->id) }}" class="index__events-img nop">
                                        {{ $event->image ? $event->image->img()->lazy() : '' }}
                                    </a>
                                    <div class="index__events-info d-flex flex-column">
                                        <span class="index__ways-place-year">{{ DateHelper::year($event) }}</span>
                                        <a href="{{ route('front.events.show', $event->id) }}" class="index__ways-place-name exo text-color-imp">{{ $event->name }}</a>
                                        <a href="{{ route('front.events.show', $event->id) }}" class="index__ways-place-city text-color-imp">
                                            @if($event->location)
                                                <span class="material-icons">room&nbsp;</span>
                                                {{ $event->location }}
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="swiper-slide index__events-slide">
                                    Нет событий
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
                        <a href="{{ route('front.events.index') }}" class="index__events-link exo">Все события</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        let dateRange = $('#first');
        let type = $('#type_id');
        let transport = $('#transport_id');
        let whom = $('#whom_id');
        let filterForm = $('form[name="filters"]');
        let dateFrom = $('input[name="date_from"]');
        let dateTo = $('input[name="date_to"]');

        type.selectmenu();
        transport.selectmenu()
        whom.selectmenu();

        dateRange.datepick({
            onSelect: function (dates) {
                dates.map((date, index) => {
                    if (index === 0) {
                        dateFrom.val((new Date(date)).getTime() / 1000)
                    } else {
                        dateTo.val((new Date(date)).getTime() / 1000)
                    }
                });
            },
            yearRange: 'c-0:c+2',
            firstDay: 1,
            multiSelect: 2,
            multiSeparator: ' — ',
            dateFormat: 'd M yyyyy',
            dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            monthNamesShort: ['янв', 'фев', 'мар', 'апр', 'май', 'июн',
                'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'
            ],
            monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ],
        });
    </script>
@endsection
