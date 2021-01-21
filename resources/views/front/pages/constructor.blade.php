@extends('layouts.front')

@section('content')
    <main class="main" id="route-constructor">
        <div class="constructor list d-flex flex-column">
            @if($entities->count())
                <div class="constructor__input-wr">
                    <input type="text" class="constructor__input" placeholder="{{ $vars['constructor_routes_set_name'] }}">
                </div>
                <div class="constructor__results">
                    <div class="constructor__result-group">
                        <div class="constructor__result-items d-flex flex-column" id="sortable">

                            @foreach($entities as $entity)
                                <div id="{{ $loop->iteration }}" class="constructor__result-item d-flex flex-row align-items-center">
                                    <p class="constructor__result-number mb-0 list__name exo">
                                        {{ $loop->iteration }}
                                    </p>
                                    <a href="{{ RouteHelper::show($entity) }}" class="constructor__result-name mb-0 list__name exo">
                                        {{ $entity->name }}
                                    </a>
                                    <p class="list__city constructor__result-geo">
                                        <span class="material-icons">room </span>
                                        {{ $entity->location }}
                                    </p>
                                    <div class="constructor__result-dragger">
                                    <span class="material-icons">
                                      menu
                                    </span>
                                    </div>
                                    <div class="constructor__result-delete">
                                        <span class="desctp">Удалить</span>
                                        <span class="material-icons mb">close</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
                <section class="page__route">

                    @foreach($entities as $entity)
                        <div class="page__route-item" id="r{{ $loop->iteration }}" data-id="{{ $entity->id }}" data-type="{{ RouteHelper::model($entity) }}">
                            <div class="page__route-img-wr">
                                {{ $entity->image ? $entity->image->img()->lazy() : '' }}
                            </div>
                            <a href="{{ RouteHelper::show($entity) }}" class="page__route-name exo">
                                {{ $entity->name }}
                            </a>
                            <a href="{{ RouteHelper::show($entity) }}" class="page__route-city">
                                <span class="material-icons">room</span>
                                {{ $entity->location }}
                            </a>
                        </div>
                    @endforeach

                </section>
            @else
                <div class="list__no-items">
                    <p class="list__no-text exo">
                        {{ $vars['constructor_routes_no_data'] }}
                    </p>
                </div>
            @endif
        </div>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        let items = []
        let sortableEl = $("#sortable");

        $(function() {
            sortableEl.sortable({
                update(e) {
                    items = sortableEl.sortable('toArray')
                    changePhotoOrder()
                }
            });

            items = sortableEl.sortable('toArray')
            sortableEl.disableSelection();
        });

        function changePhotoOrder() {
            let wrapper = document.querySelector('.page__route')
            let newPhotoEls = []

            for (let i = 0; i < items.length; i++) {
                let id = 'r' + items[i]
                let phEl = document.getElementById(id)
                console.log(phEl, phEl.getAttribute('data-id'), phEl.getAttribute('data-type'));
                newPhotoEls.push(phEl)
            }

            Array.from(wrapper.childNodes).forEach(node => node.remove())

            newPhotoEls.forEach(el => {
                wrapper.appendChild(el)
            })
        }

    </script>
@endsection
