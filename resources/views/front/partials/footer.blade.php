<footer class="footer">
    <div class="footer__content flex-wrap">
        <div class="footer__nav">
            <div class="footer__col">
                <p class="footer__col-name">
                    {!! $vars['footer_title'] !!}
                </p>
                <ul class="footer__col-list pl-0">
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <span class="material-icons">room&nbsp;</span>
                            {{ $vars['footer_address'] }}
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <span class="material-icons">call&nbsp;</span>
                            {{ $vars['footer_phone'] }}
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">
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
            <form class="form-inline footer__form">
                <div class="form-group">
                    <input type="email" class="form-control footer__input" placeholder="{{ $vars['footer_news_placeholder'] }}">
                </div>
                <button type="submit" class="btn footer__btn">{{ $vars['footer_news_ok_button'] }}</button>
            </form>
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
