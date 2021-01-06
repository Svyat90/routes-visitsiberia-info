@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="meals">
        <div class="meals d-flex flex-column" id="meals">
            <div class="meals__heading heading heading--yellow" id="heading">
                <h1 class="heading__title heading__title--big">{{ $vars['meals_title'] }}</h1>
                <div class="heading__selects heading__selects--meal">
                    <form action="{{ route('front.meals.index') }}" name="filters" style="display: flex;">

                        <div class="heading__select" id="heading-third">
                            <select name="category_id" id="category_id">
                                @php $categoryId = request()->get('category_id') ?? null; @endphp
                                <option value="" disabled="disabled" selected="selected">Категория</option>
                                @foreach($categoryList as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ $categoryId && $categoryId == $category->id ? 'selected' : '' }} >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="heading__select" id="heading-second">
                            <select name="season_id" id="season_id">
                                @php $seasonId = request()->get('season_id') ?? null; @endphp
                                <option value="" disabled="disabled" selected="selected">Сезон</option>
                                @foreach($seasonList as $season)
                                    <option
                                        value="{{ $season->id }}"
                                        {{ $seasonId && $seasonId == $season->id ? 'selected' : '' }} >
                                        {{ $season->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="heading__select" id="heading-fourth">
                            <select name="delivery_id"  id="delivery_id">
                                @php $deliveryId = request()->get('delivery_id') ?? null; @endphp
                                <option disabled="disabled" selected="selected">Доставка</option>
                                @foreach($deliveryList as $delivery)
                                    <option
                                        value="{{ $delivery->id }}"
                                        {{ $deliveryId && $deliveryId == $delivery->id ? 'selected' : '' }} >
                                        {{ $delivery->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                </div>
            </div>
            <div class="meals__items list">
                <ul class="nav nav-pills list__tabs wow fadeInUp" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ $vars['base_list'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ $vars['base_on_map'] }}</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <p class="list__size">
                            {{ $vars['base_showed'] }}: {{ $meals->total() }} {{ $vars['base_results'] }}
                        </p>
                    </li>
                </ul>

                @if($meals->count())
                    <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="list__items show">
                            @foreach($meals as $meal)
                                <div class="list__item d-flex flex-column active">
                                    <a href="{{ route('front.meals.show', $meal->id) }}" class="d-flex flex-column nop position-relative">
                                        <img src="{{ asset('front/img/item-top.svg') }}" class="list__item-sign" alt="">
                                        <div class="list__img">
                                            {{ $meal->image ? $meal->image->img()->lazy() : '' }}
                                        </div>
                                        <p class="list__name exo">
                                            {{ $meal->name }}
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            {{ $meal->location }}
                                        </p>
                                    </a>
                                    <div class="list__buttons d-flex flex-row align-items-center">
                                        <button class="list__button list__button-add route-item-add" data-id="{{ $meal->id }}" data-type="route-meals">
                                            {{ $vars['base_add'] }}
                                        </button>
                                        <button class="list__button list__button-add list__button--green route-item-added d-none" data-id="{{ $meal->id }}" data-type="route-meals">
                                            Добавлено<span class="material-icons">&nbsp;done</span>
                                        </button>
                                        <button class="list__button list__button-star material-icons favourite-item" data-id="{{ $meal->id }}" data-type="favourite-meals">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="30px" height="30px">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                    <path d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z"/>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                    <a href="#" class="list__button list__button-link route-item-go d-none">
                                        Перейти к маршруту
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{ $meals->links('front.partials.paginator') }}

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div id="map"></div>
                    </div>
                </div>
                @else
                    <div class="list__no-items">
                        <p class="list__no-text exo">
                            Нет заведений
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent

    <script>
        $(function () {
            let season = $('#season_id');
            let category = $('#category_id');
            let delivery = $('#delivery_id');
            let filterForm = $('form[name="filters"]');

            season.selectmenu();
            category.selectmenu()
            delivery.selectmenu();

            season.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            category.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })

            delivery.on('selectmenuchange', e => {
                e.preventDefault();
                filterForm.submit();
            })
        });
    </script>

    <script>
        ymaps.ready(init);

        function init() {
            let data = JSON.parse('{{ $geoData->toJson() }}'.replace(/&quot;/g,'"'));

            if (data.length > 0) {
                var myMap = new ymaps.Map('map', {
                    center: [data[0].lat, data[0].lng],
                    zoom: 10
                }, {
                    searchControlProvider: 'yandex#search'
                })

                var MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
                    '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
                )

                for (let i = 0; i < data.length; i++) {
                    myPlacemark = new ymaps.Placemark([data[i].lat, data[i].lng], {
                        hintContent: data[i].name,
                        balloonContent: data[i].name
                    }, {
                        // options
                        iconLayout: 'default#imageWithContent',
                        iconImageHref: 'front/img/geo.svg',
                        iconImageSize: [48, 48],
                        iconImageOffset: [-24, -24],
                        iconContentOffset: [15, 15],
                        iconContentLayout: MyIconContentLayout
                    })
                    myMap.geoObjects.add(myPlacemark)
                }
            }
        }
    </script>
@endsection
