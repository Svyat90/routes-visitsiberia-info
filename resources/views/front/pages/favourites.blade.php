@extends('layouts.front')

@section('title', config('app.name'))

@section('content')
    <main class="main" id="fav">
        <div class="fav d-flex flex-column" id="favorite-vue">
            <h1 class="fav__heading exo">
                {{ $vars['favourites_title'] }}
            </h1>
            <div class="meal__items list">
                <ul class="nav nav-pills list__tabs fav__tabs justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a href="{{ route('front.favourites') }}" class="nav-link {{ ! request()->has('type') ? 'active' : '' }}" id="pills-home-tab" >{{ $vars['favourites_all'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.favourites', ['type' => 'places']) }}" class="nav-link {{ request()->has('type') && request()->type == 'places' ? 'active' : '' }}" id="pills-profile-tab" >{{ $vars['favourites_places'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.favourites', ['type' => 'events']) }}" class="nav-link {{ request()->has('type') && request()->type == 'events' ? 'active' : '' }}" id="pills-profile-tab" >{{ $vars['favourites_events'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.favourites', ['type' => 'hotels']) }}" class="nav-link {{ request()->has('type') && request()->type == 'hotels' ? 'active' : '' }}" id="pills-profile-tab" >{{ $vars['favourites_hotels'] }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.favourites', ['type' => 'meals']) }}" class="nav-link {{ request()->has('type') && request()->type == 'meals' ? 'active' : '' }}" id="pills-profile-tab" >{{ $vars['favourites_meals'] }}</a>
                    </li>
                </ul>

                @if($data->count())
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-all" role="tabpanel">
                            <div class="list__items show">
                                @foreach($data as $entity)
                                    @php
                                        $namespace = RouteHelper::namespace($entity);
                                    @endphp

                                    <div class="list__item d-flex flex-column">
                                        <a href="{{ RouteHelper::show($entity) }}" class="d-flex flex-column nop">
                                            <div class="list__img">
                                                {{ $entity->image ? $entity->image->img('list')->lazy() : '' }}
                                            </div>
                                            <p href="{{ RouteHelper::show($entity) }}" class="list__name exo">
                                                {{ $entity->name }}
                                            </p>
                                            <p href="{{ RouteHelper::show($entity) }}" class="list__city">
                                                <span class="material-icons">room&nbsp;</span>
                                                {{ $entity->location }}
                                            </p>
                                        </a>
                                        <div class="list__buttons d-flex flex-row align-items-center">
                                            <button class="list__button list__button-add route-item-add" data-id="{{ $entity->id }}" data-type="route-{{ $namespace }}">
                                                {{ $vars['base_add'] }}
                                            </button>
                                            <button class="list__button list__button-add list__button--green route-item-added d-none" data-id="{{ $entity->id }}" data-type="route-{{ $namespace }}">
                                                {{ $vars['base_added'] }}<span class="material-icons">&nbsp;done</span>
                                            </button>
                                            <button class="list__button list__button-star material-icons favourite-item" data-id="{{ $entity->id }}" data-type="favourite-{{ $namespace }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="30px" height="30px">
                                                    <g>
                                                        <rect fill="none" height="24" width="24"/>
                                                        <path d="M14.43,10l-1.47-4.84c-0.29-0.95-1.63-0.95-1.91,0L9.57,10H5.12c-0.97,0-1.37,1.25-0.58,1.81l3.64,2.6l-1.43,4.61 c-0.29,0.93,0.79,1.68,1.56,1.09L12,17.31l3.69,2.81c0.77,0.59,1.85-0.16,1.56-1.09l-1.43-4.61l3.64-2.6 c0.79-0.57,0.39-1.81-0.58-1.81H14.43z"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <a href="{{ route('front.choose') }}" class="list__button list__button-link route-item-go d-none">
                                            {{ $vars['base_go_to_route'] }}
                                        </a>
                                    </div>
                                @endforeach

                            </div>

                            {{ $data->links('front.partials.paginator') }}

                        </div>
                    </div>
                @else
                    <div class="list__no-items">
                        <p class="list__no-text exo">
                            @switch(true)
                                @case(request()->type == 'places')
                                    {{ $vars['places_no'] }}
                                    @break
                                @case(request()->type == 'events')
                                    {{ $vars['events_no'] }}
                                    @break
                                @case(request()->type == 'hotels')
                                    {{ $vars['hotels_no'] }}
                                    @break
                                @case(request()->type == 'meals')
                                    {{ $vars['meals_no'] }}
                                    @break
                                @default
                                    {{ $vars['favourites_no'] }}
                            @endswitch
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
        //
    </script>
@endsection
