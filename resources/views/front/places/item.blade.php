<div class="swiper-slide">
    <div class="list__item d-flex flex-column">
        <a href="{{ route('front.places.show', $place->id) }}" class="d-flex flex-column nop">
            <div class="list__img">
                @if(isset($place->imagePath))
                    {!! ImageHelper::image($place->imagePath) !!}
                @else
                    @if(isset($place->image))
                        {{ MediaHelper::getImage($place) }}
                    @endif
                @endif
            </div>
            <p class="list__name exo">
                {{ $place->name }}
            </p>
            <p class="list__city">
                @if($place->city)
                    <span class="material-icons">room&nbsp;</span>
                    {{ $place->city }}
                @endif
            </p>
        </a>
    </div>
</div>
