@php
    $reviews = $entity->reviews()->where('approved', true)->get();
@endphp

<section class="article__feedback article__block" id="reviews">
    <h2 class="article__name wow fadeInUp">{{ $vars['base_reviews'] }}</h2>
    <div class="no-comments {{ count($reviews) > 0 ? 'dn' : '' }}" id="no-comments">
        <p class="article__slider-description exo">{{ $vars['review_empty_text'] }}</p>
    </div>
    <div id="form" class="{{ $errors->any() || session()->has('error-review') ? '' : 'dn' }}">
        <form name="comment" action="{{ route('front.review') }}" method="post">
            <input name="entity" value="{{ $namespace }}" type="hidden" />
            <input name="entityId" value="{{ $entity->id }}" type="hidden" />
            <input name="rating" id="rating" value="1" type="hidden" />
            @csrf

            <div class="feedback__row">
                <div class="feedback__col">
                    <input type="text" name="name" placeholder="{{ $vars['review_name'] }}" value="{{ old('name', '') }}" required>
                    <input type="tel" name="phone" placeholder="{{ $vars['review_phone'] }}" value="{{ old('phone', '') }}" required>
                    <input type="email" name="email" placeholder="{{ $vars['review_email'] }}" value="{{ old('email', '') }}" required>
                </div>
                <div class="feedback__col">
                    <div class="list__subrating d-flex mb-0 feedback__stars" data-rating="1">
                        <span class="material-icons feedback__star">star</span>
                        <span class="material-icons feedback__star">star</span>
                        <span class="material-icons feedback__star">star</span>
                        <span class="material-icons feedback__star">star</span>
                        <span class="material-icons feedback__star">star</span>
                    </div>
                    <p class="d-flex">{{ $vars['review_rating_stars'] }}</p>
                </div>
            </div>
            <div class="feedback__row">
              <textarea name="body" id="comment-text" cols="30" rows="5" maxlength="500" placeholder="{{ $vars['review_body'] }}" required>{{ old('body', '') }}</textarea>
            </div>

            @if($errors->any())
                <div class="no-comments">
                    {!! implode('', $errors->all('<p class="article__slider-description exo error-msg">:message</p>')) !!}
                </div>
            @elseif(session()->has('error-review'))
                <div class="no-comments">
                    <p class="article__slider-description exo error-msg">{{ $vars['review_wrong'] }}</p>
                </div>
            @endif

            <button id="button-submit" type="submit" class="article__get-feedback">
                {{ $vars['review_send'] }}
            </button>
        </form>
    </div>

    <div id="comment-container" class="{{ $errors->any() || session()->has('error-review') ? 'dn' : '' }}">
        <div class="article__feedback-slider swiper-container wow fadeInUp">
            <div class="article__feedback-wr swiper-wrapper">
                @foreach($reviews as $review)
                    <div class="feedback swiper-slide">
                        <p class="feedback__name">{{ $review->name }}</p>
                        <p class="feedback__data">{{ DateHelper::reviewDate($review) }}</p>
                        <div class="list__subrating d-flex mb-0 feedback__stars" data-rating="{{ $review->rating }}">
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                            <span class="material-icons feedback__star">star</span>
                        </div>
                        <p class="feedback__text">“{{ $review->body }}”</p>

                        @if(count($review->replies) > 0)
                            @foreach($review->replies as $reply)
                                <div class="feedback__admin">
                                    <div class="feedback__admin-title">
                                        <div class="feedback__reply">
                                            <span class="material-icons feedback__icon">reply</span>
                                            <p class="feedback__reply-name">
                                                @if($reply->is_admin)
                                                    {{ $vars['review_admin_response'] }}
                                                @else
                                                    {{ $reply->name }}
                                                @endif
                                            </p>
                                        </div>
                                        <div class="feedback__reply-data">
                                            {{ DateHelper::reviewDate($reply) }}
                                        </div>
                                        <div class="feedback__text">
                                            {{ $reply->body }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        @if (session()->has('success-create-review'))
            <div class="no-comments">
                <p class="article__slider-description exo success-msg">{{ $vars['review_success_created'] }}</p>
            </div>
        @endif

        <div class="swiper-button-prev swiper-button"></div>
        <div class="swiper-button-next swiper-button"></div>

        <button type="button" id="button-add" class="article__get-feedback">
            {{ $vars['review_give_feedback'] }}
        </button>
    </div>
</section>

@section('scripts')
    @parent
    <script>
        const swiper0 = new Swiper('.article__feedback-slider', {
            spaceBetween: 93,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                1012: {
                    slidesPerView: 2
                }
            }
        })
    </script>

    <script>
        let buttonAdd = document.getElementById('button-add')
        let form = document.getElementById('form')
        let comments = document.getElementById('comment-container')
        let rating = document.getElementById('rating')
        let emptyComments = document.getElementById('no-comments')

        buttonAdd.onclick = () => {
            comments.classList.add('dn')
            form.classList.remove('dn')
            emptyComments.classList.add('dn')
        }

        let stars = Array.from(document.querySelectorAll('.feedback__col .feedback__star'))
        let starsWr = document.querySelector('.feedback__col .feedback__stars')

        for (let i = 0; i < stars.length; i++) {
            let currentStars = stars.indexOf(stars[i]) + 1;
            stars[i].onclick = (e) => {
                starsWr.dataset.rating = currentStars
                console.log(starsWr.dataset.rating);
                rating.value = currentStars;
            }
        }
    </script>
@endsection
