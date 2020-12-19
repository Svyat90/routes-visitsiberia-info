@extends('layouts.front')

@section('styles')
@endsection

@section('content')
    <main class="main" id="places">
        <div class="places d-flex flex-column" id="places">
            <div class="places__heading heading heading--yellow" id="heading">
                <h1 class="heading__title heading__title--big">Достопримечательности</h1>
                <div class="heading__selects heading__selects--places wow fadeInUp">
                    <form action="{{ route('front.places.index') }}" name="filters" style="display: flex;">
                        <div class="heading__select" id="heading-type_id">
                            <select name="type_id" id="type_id">
                                @php $typeId = request()->get('type_id') ?? null; @endphp

                                <option value="" disabled="disabled" selected="selected">Тип отдыха</option>
                                    @foreach($typeList as $type)
                                        <option
                                            value="{{ $type->id }}"
                                            {{ $typeId && $typeId == $type->id ? 'selected' : '' }} >
                                            {{ $type->name }}
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
                        <div class="heading__select" id="heading-fourth">
                            <select name="whom_id"  id="whom_id">
                                @php $whomId = request()->get('whom_id') ?? null; @endphp

                                <option disabled="disabled" selected="selected">С кем</option>
                                    @foreach($whomList as $whom)
                                        <option
                                            value="{{ $whom->id }}"
                                            {{ $whomId && $whomId == $whom->id ? 'selected' : '' }} >
                                            {{ $whom->name }}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                $(function () {
                    // $("#type_id").selectmenu();
                    // $("#season_id").selectmenu();
                    // $("#category_id").selectmenu()
                    // $("#whom_id").selectmenu();

                    let type = $('#type_id');
                    let season = $('#season_id');
                    let category = $('#category_id');
                    let whom = $('#whom_id');
                    let filterForm = $('form[name="filters"]');

                    type.on('change', function (e) {
                        e.preventDefault();
                        filterForm.submit();
                    })

                    season.on('change', function (e) {
                        e.preventDefault();
                        filterForm.submit();
                    })

                    category.on('change', function (e) {
                        e.preventDefault();
                        filterForm.submit();
                    })

                    whom.on('change', function (e) {
                        e.preventDefault();
                        filterForm.submit();
                    })

                });
            </script>
            <div class="places__items list">
                <ul class="nav nav-pills list__tabs wow fadeInUp" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Список</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">На карте</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <p class="list__size">
                            Показано: {{ $places->total() }} результата
                        </p>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                        <div class="list__items show">
                            @foreach($places as $place)
                                <div class="list__item d-flex flex-column active">
                                    <a href="{{ route('front.places.show', $place->id) }}" class="d-flex flex-column nop position-relative">
                                        <img src="{{ asset('front/img/item-top.svg') }}" class="list__item-sign" alt="">
                                        <div class="list__img">
                                            {{ $place->image->img()->lazy() }}
                                        </div>
                                        <p class="list__name exo">
                                            {{ $place->name }}
                                        </p>
                                        <p class="list__city">
                                            <span class="material-icons">room&nbsp;</span>
                                            {{ $place->location }}
                                        </p>
                                    </a>
                                    <div class="list__buttons d-flex flex-row align-items-center">
                                        <button class="list__button list__button-add">
                                            Добавить
                                        </button>
                                        <button class="list__button list__button-star material-icons active" >
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="30px" height="30px">
                                                <g>
                                                    <rect fill="none" height="24" width="24"/>
                                                    <path d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z"/>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{ $places->links('front.partials.paginator') }}

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    @parent
@endsection
