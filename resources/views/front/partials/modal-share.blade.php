<div class="modal-wr modal__esc">
    <div class="modall">
        <div class="modal__header">
            <h3 class="modal__title">
                {{ $vars['base_share'] }}
            </h3>
            <div class="modal__close modal__esc material-icons">
                close
            </div>
        </div>
        <div class="modal__body d-flex flex-column">
            <div class="modal__row d-flex">
                <div class="d-flex flex-column w-100">
                    <p class="modal__text">
                        {{ $vars['base_direct_link'] }}
                    </p>
                    <div class="modal__link-wr d-flex w-100 align-items-center">
                        <input class="modal__input" type="text" disabled value="{{ Request::fullUrl() }}">
                        <div class="modal__copy">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 1.25H5C3.625 1.25 2.5 2.375 2.5 3.75V21.25H5V3.75H20V1.25ZM23.75 6.25H10C8.625 6.25 7.5 7.375 7.5 8.75V26.25C7.5 27.625 8.625 28.75 10 28.75H23.75C25.125 28.75 26.25 27.625 26.25 26.25V8.75C26.25 7.375 25.125 6.25 23.75 6.25ZM23.75 26.25H10V8.75H23.75V26.25Z" fill="#011B2B"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal__row d-flex justify-content-between">
                <div class="d-flex flex-column">
                    <p class="modal__text">
                        {{ $vars['base_social_networks'] }}
                    </p>
                    <div class="d-flex modal__icons a2a_kit">
                        <a class="modal__icon a2a_button_vk">
                            <img src="{{ asset('front/img/vk-b.svg') }}">
                        </a>
                        <a class="modal__icon a2a_button_telegram">
                            <img src="{{ asset('front/img/tg.svg') }}" alt="">
                        </a>
                        <a class="modal__icon a2a_button_whatsapp">
                            <img src="{{ asset('front/img/wa.svg') }}" alt="">
                        </a>
                        <a class="modal__icon a2a_button_viber">
                            <img src="{{ asset('front/img/v-b.svg') }}" alt="">
                        </a>
                        <a class="modal__icon a2a_button_email">
                            <img src="{{ asset('front/img/m-b.svg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-column mr-43 a2a_kit">
                    <p class="modal__text">
                        {{ $vars['base_print'] }}
                    </p>
                    <a class="modal__icon modal__icon-l a2a_button_printfriendly" style="color: black;">
                        <img src="{{ asset('front/img/printer.svg') }}" alt="">
                        {{ $vars['base_printing'] }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script async src="https://static.addtoany.com/menu/page.js"></script>
@endsection
