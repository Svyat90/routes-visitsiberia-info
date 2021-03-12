<footer class="footer">
    <div class="footer__content flex-wrap">
        <div class="footer__nav">
            <div class="footer__col">
                <p class="footer__col-name">
                    {!! $vars['footer_title'] !!}
                </p>
                <ul class="footer__col-list pl-0">
                    <li class="footer__item">
                        <a class="footer__link"
                           target="_blank"
{{--                           href="{{ YandexGeoHelper::yandexMapLink($vars['footer_address_lng'], $vars['footer_address_lat']) }}"--}}
                           href="https://www.google.com/maps/place/%D1%83%D0%BB.+%D0%9B%D0%B5%D0%BD%D0%B8%D0%BD%D0%B0,+120,+%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D1%8F%D1%80%D1%81%D0%BA,+%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D1%8F%D1%80%D1%81%D0%BA%D0%B8%D0%B9+%D0%BA%D1%80%D0%B0%D0%B9,+%D0%A0%D0%BE%D1%81%D1%81%D0%B8%D1%8F,+660017/@56.012708,92.846999,17z/data=!3m1!4b1!4m5!3m4!1s0x5cd7ae0d6401bce9:0x2dae867fee673b4e!8m2!3d56.012705!4d92.849193"
                        >
                            <span class="material-icons">room&nbsp;</span>
                            {{ $vars['footer_address'] }}
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="tel:{{ $vars['footer_phone'] }}" class="footer__link">
                            <span class="material-icons">call&nbsp;</span>
                            {{ $vars['footer_phone'] }}
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="mailto:{{ $vars['footer_mail'] }}" class="footer__link">
                            <span class="material-icons">mail&nbsp;</span>
                            {{ $vars['footer_mail'] }}
                        </a>
                    </li>
                </ul>
                <div class="footer__socials footer__mobile">
                    <a href="{{ $vars['social_facebook'] }}" class="footer__social">
                        <img src="{{ asset('front/img/facebook-c.svg') }}" alt="facebook">
                    </a>
                    <a href="{{ $vars['social_vkontakte'] }}" class="footer__social">
                        <img src="{{ asset('front/img/vk-c.svg') }}" alt="vkontakte">
                    </a>
                    <a href="{{ $vars['social_youtube'] }}" class="footer__social">
                        <img src="{{ asset('front/img/youtube-c.svg') }}" alt="youtube">
                    </a>
                    <a href="{{ $vars['social_instagram'] }}" class="footer__social">
                        <img src="{{ asset('front/img/instagram-c.svg') }}" alt="instagram">
                    </a>
                    <a href="{{ $vars['social_odnoklassniki'] }}" class="footer__social">
                        <img src="{{ asset('front/img/ok-c.svg') }}" alt="odnoklassniki">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer__col footer__mob-first">
            <p class="footer__col-text">
                {{ $vars['footer_news_title'] }}
            </p>

            <form action="{{ route('front.subscribe') }}" method="post" class="form-inline footer__form">
                @csrf

                <div class="form-group">
                    <input name="email" type="email" class="form-control footer__input" placeholder="{{ $vars['footer_news_placeholder'] }}">
                </div>
                <button type="submit" class="btn footer__btn">{{ $vars['footer_news_ok_button'] }}</button>

            </form>

            @if($errors->any())
                {!! implode('', $errors->all('<p class="error-msg-subscribe">:message</p>')) !!}
            @elseif(session()->has('subscribed'))
                <p class="article__slider-description exo success-msg-subscribe">{{ $vars['success_add_subscriber'] }}</p>
            @endif

            <div class="footer__socials footer__desktop">
                <a href="{{ $vars['social_facebook'] }}" class="footer__social">
                    <img src="{{ asset('front/img/facebook-c.svg') }}" alt="facebook">
                </a>
                <a href="{{ $vars['social_vkontakte'] }}" class="footer__social">
                    <img src="{{ asset('front/img/vk-c.svg') }}" alt="vkontakte">
                </a>
                <a href="{{ $vars['social_youtube'] }}" class="footer__social">
                    <img src="{{ asset('front/img/youtube-c.svg') }}" alt="youtube">
                </a>
                <a href="{{ $vars['social_instagram'] }}" class="footer__social">
                    <img src="{{ asset('front/img/instagram-c.svg') }}" alt="instagram">
                </a>
                <a href="{{ $vars['social_odnoklassniki'] }}" class="footer__social">
                    <img src="{{ asset('front/img/ok-c.svg') }}" alt="odnoklassniki">
                </a>
            </div>
        </div>
        <p class="footer__copy">
            &copy; {{ date('Y') }}. {{ $vars['footer_copyright'] }}
        </p>
    </div>
</footer>
