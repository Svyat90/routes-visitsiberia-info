<div class="swiper-slide">
    <div class="list__item d-flex flex-column">
        <a href="{{ route('front.hotels.show', $hotel->id) }}" class="d-flex flex-column nop">
            <div class="list__img">
                @if(isset($hotel->imagePath))
                    {!! ImageHelper::image($hotel->imagePath) !!}
                @else
                    @if(isset($hotel->image))
                        {{ MediaHelper::getImage($hotel) }}
                    @endif
                @endif
            </div>
            <div class="list__subinfo d-flex justify-content-between align-items-center">
                <p class="list__subprice mb-0">
                    {{ $vars['base_price_from'] }} {{ $hotel->price }} {{ $vars['base_price_currency'] }}
                </p>
                <p class="list__subrating d-flex mb-0" data-rating="{{ $hotel->averageRating }}">
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
            @if($hotel->location)
                <p class="list__city">
                    <span class="material-icons">room&nbsp;</span>
                    {{ LabelHelper::locationLabel($hotel->location, 43) }}
                </p>
            @endif
        </a>
    </div>
</div>
