<div class="swiper-slide">
    <div class="list__item d-flex flex-column">
        <a href="{{ route('front.events.show', $event->id) }}" class="d-flex flex-column nop">
            <div class="list__img">
                @if(isset($event->imagePath))
                    {!! ImageHelper::image($event->imagePath) !!}
                @else
                    @if(isset($event->image))
                        {{ MediaHelper::getImage($event) }}
                    @endif
                @endif
            </div>
            <div class="list__subinfo d-flex justify-content-between align-items-center">
                <p class="list__subprice mb-0">
                    {{ DateHelper::eventRangeTimeStd($event) }}
                </p>
            </div>
            <p class="list__name exo">
                {{ $event->name }}
            </p>
            <p class="list__city">
                @if($event->city)
                    <span class="material-icons">room&nbsp;</span>
                    {{ $event->city }}
                @endif
            </p>
        </a>
    </div>
</div>
