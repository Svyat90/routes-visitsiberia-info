<div class="swiper-slide">
    <div class="list__item d-flex flex-column">
        <a href="#" class="d-flex flex-column nop">
            <div class="list__img">
                @if(isset($hotel->imagePath))
                    {!! ImageHelper::image($hotel->imagePath) !!}
                @else
                    @if(isset($meal->image))
                        {{ MediaHelper::getImage($hotel) }}
                    @endif
                @endif
            </div>
            <div class="list__subinfo d-flex justify-content-between align-items-center">
                <p class="list__subprice mb-0">
{{--                    {{ $hotel->price }}--}}
                    от 4000 руб
                </p>
                <p class="list__subrating d-flex mb-0" data-rating="3">
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                </p>
            </div>
            <p class="list__name exo">
                {{ $hotel->name }}
            </p>
            <p class="list__city">
                <span class="material-icons">room&nbsp;</span>
                {{ $hotel->location }}
            </p>
        </a>
    </div>
</div>