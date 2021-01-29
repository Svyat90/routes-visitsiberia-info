@extends('layouts.front')

@section('content')
    <main class="main" id="route-constructor">
        <div class="constructor list d-flex flex-column">
            @if($entities->count())
                <div class="constructor__input-wr">
                    <input type="text" class="constructor__input" id="route-name" placeholder="{{ $vars['constructor_routes_set_name'] }}">
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
                                    <a class="list__city constructor__result-geo" href="{{ RouteHelper::show($entity) }}">
                                        @if($entity->city)
                                            <span class="material-icons">room </span>
                                            {{ $entity->city }}
                                        @endif
                                    </a>
                                    <div class="constructor__result-dragger">
                                    <span class="material-icons">
                                      menu
                                    </span>
                                    </div>
                                    <div class="constructor__result-delete">
                                        <a class="desctp route-delete-item"
                                           data-id="{{ $entity->id }}"
                                           data-type="route-{{ RouteHelper::namespace($entity) }}"
                                        >
                                            {{ $vars['base_delete'] }}
                                        </a>
                                        <span class="material-icons mb">close</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                </div>
                <section class="page__route">

                    @foreach($entities as $entity)
                        <div class="page__route-item"
                             id="r{{ $loop->iteration }}"
                             data-id="{{ $entity->id }}"
                             data-type="{{ RouteHelper::model($entity) }}"
                             data-name="{{ $entity->name }}"
                             data-img="{{ $entity->image->getFullUrl('list') }}"
                        >
                            <a href="{{ RouteHelper::show($entity) }}" class="page__route-img-wr">
                                {{ $entity->image ? $entity->image->img('route')->lazy() : '' }}
                            </a>
                            <a href="{{ RouteHelper::show($entity) }}" class="page__route-name exo">
                                {{ $entity->name }}
                            </a>
                            <a href="{{ RouteHelper::show($entity) }}" class="page__route-city">
                                @if($entity->city)
                                    <span class="material-icons">room</span>
                                    {{ $entity->city }}
                                @endif
                            </a>
                        </div>
                    @endforeach

                </section>

                <p class="article__text mb-128">
                    {{ $vars['constructor_text_1'] }}
                    <br>
                    <br>
                    {{ $vars['constructor_text_2'] }}
                </p>

                <form name="save-route" id="save-route" action="{{ route('front.save_route') }}" method="get">
                    <input type="hidden" name="route_data" id="route_data" value="" />
                    <input type="hidden" name="route_name" id="route_name_hidden" value="" />
                    <button type="button" class="article__get-feedback mb-364" id="save-route-btn">
                        {{ $vars['constructor_save_route'] }}
                    </button>
                </form>

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
            let routeData = $("#route_data");
            let routeNameHidden = $("#route_name_hidden");
            let routeNameInput = $("#route-name");
            let saveRouteForm = $("#save-route");
            let saveRouteBtn = $("#save-route-btn");

            saveRouteBtn.click(function (e) {
                e.preventDefault();

                let data = [];
                for (let i = 0; i < items.length; i++) {
                    let phEl = document.getElementById('r' + items[i])
                    let id = phEl.getAttribute('data-id');
                    let namespace = phEl.getAttribute('data-type');
                    let img = phEl.getAttribute('data-img');
                    let name = phEl.getAttribute('data-name');
                    data.push([id, name, namespace, img]);
                }

                routeData.val(JSON.stringify(data));
                routeNameHidden.val(routeNameInput.val());

                saveRouteForm.submit();
            })

            sortableEl.sortable({
                update(e) {
                    items = sortableEl.sortable('toArray')
                    changePhotoOrder()
                }
            });

            items = sortableEl.sortable('toArray')
            sortableEl.disableSelection();

            function changePhotoOrder() {
                let wrapper = document.querySelector('.page__route')
                let newPhotoEls = []

                for (let i = 0; i < items.length; i++) {
                    let id = 'r' + items[i]
                    let phEl = document.getElementById(id)
                    newPhotoEls.push(phEl)
                }

                Array.from(wrapper.childNodes).forEach(node => node.remove())

                newPhotoEls.forEach(el => {
                    wrapper.appendChild(el)
                })
            }
        });


    </script>
@endsection
