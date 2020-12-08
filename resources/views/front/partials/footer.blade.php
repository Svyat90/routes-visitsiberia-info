<footer class="footer">
    <div class="footer__content justify-content-between flex-wrap">
        <div class="footer__nav">
            <div class="footer__col">
                <p class="footer__col-name">
                    Туристский <br> информационный центр
                </p>
                <ul class="footer__col-list pl-0">
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <span class="material-icons">room&nbsp;</span>
                            Красноярск, ул. Ленина, 120
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <span class="material-icons">call&nbsp;</span>
                            +7 (391) 215 00 02
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">
                            <span class="material-icons">mail&nbsp;</span>
                            itc.krsk@gmail.com
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer__col ml-auto mr-auto">
                <p class="footer__col-name">
                    Контакты
                </p>
                <ul class="footer__col-list pl-0">
                    <li class="footer__item">
                        <a href="#" class="footer__link">Полезные контакты</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Обратная связь</a>
                    </li>
                    <li class="footer__item">
                        <a href="#" class="footer__link">Туристические центры края</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__col">
            <p class="footer__col-text">
                Получайте актуальные новости
            </p>
            <form class="form-inline footer__form">
                <div class="form-group">
                    <input type="email" class="form-control footer__input" placeholder="e-mail">
                </div>
                <button type="submit" class="btn footer__btn">Ок</button>
            </form>
            <div class="footer__socials">
                <a href="#" class="footer__social">
                    <img src="{{ asset('front/img/facebook-c.svg') }}" alt="facebook">
                </a>
                <a href="#" class="footer__social">
                    <img src="{{ asset('front/img/vk-c.svg') }}" alt="vkontakte">
                </a>
                <a href="#" class="footer__social">
                    <img src="{{ asset('front/img/youtube-c.svg') }}" alt="youtube">
                </a>
                <a href="#" class="footer__social">
                    <img src="{{ asset('front/img/instagram-c.svg') }}" alt="instagram">
                </a>
                <a href="#" class="footer__social">
                    <img src="{{ asset('front/img/ok-c.svg') }}" alt="odnoklassniki">
                </a>
            </div>
        </div>
        <p class="footer__copy">
            &copy; 2020. Туристский портал Красноярского края
        </p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous"></script>
    <script>
        new WOW().init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

    <script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- <script src="./js/jquery-ui.multidatespicker.js"></script> -->
    <!-- <script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script> -->
    <script src="{{ asset('front/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('front/js/jquery.datepick.js') }}"></script>
</footer>
