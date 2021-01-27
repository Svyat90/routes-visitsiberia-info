<div class="swiper-slide">
    <div class="list__item d-flex flex-column">
        <a href="{{ route('front.meals.show', $meal->id) }}" class="d-flex flex-column nop">
            <div class="list__img">
                @if(isset($meal->imagePath))
                    {!! ImageHelper::image($meal->imagePath) !!}
                @else
                    @if(isset($meal->image))
                        {{ MediaHelper::getImage($meal) }}
                    @endif
                @endif
            </div>
            <div class="list__subinfo d-flex justify-content-between align-items-center">
                <p class="list__subprice mb-0">
                    {{ $meal->cost }}
                </p>
                <p class="list__subrating d-flex mb-0" data-rating="{{ $meal->averageRating }}">
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                    <span class="material-icons">star</span>
                </p>
            </div>
            <p class="list__name exo">
                {{ $meal->name }}
            </p>
            @if($meal->location)
                <p class="list__city">
                    <span class="material-icons">room&nbsp;</span>
                    {{ LabelHelper::locationLabel($meal->location, 43) }}
                </p>
            @endif
        </a>
    </div>
</div>
