<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.min.css" integrity="sha512-uCQmAoax6aJTxC03VlH0uCEtE0iLi83TW1Qh6VezEZ5Y17rTrIE+8irz4H4ehM7Fbfbm8rb30OkxVkuwhXxrRg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">

    <script src="https://api-maps.yandex.ru/2.1/?apikey=cffbde42-9a9e-4630-b8af-50781fa386c1&lang=ru_RU" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js" integrity="sha512-VHsNaV1C4XbgKSc2O0rZDmkUOhMKPg/rIi8abX9qTaVDzVJnrDGHFnLnCnuPmZ3cNi1nQJm+fzJtBbZU9yRCww==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    @yield('styles')
</head>
<body>

@include('front.partials.header')
@include('front.partials.modal-share')

@yield('content')

@include('front.partials.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous"></script>
<script>
    new WOW().init();
</script>

<script src="https://code.jquery.com/jquery-1.12.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="{{ asset('front/js/jquery.plugin.js') }}"></script>
<script src="{{ asset('front/js/jquery.datepick.js') }}"></script>
<script src="{{ asset('front/js/main.js') }}"></script>
<script src="{{ asset('front/js/favourites.js') }}"></script>
<script src="{{ asset('front/js/routes.js') }}"></script>

<script>
    /**
     *
     * @param name
     * @param type
     * @param phoneFirst
     * @param phoneSecond
     * @param location
     * @param lat
     * @param lng
     * @param site
     * @param link
     * @returns {string}
     */
    function renderPopup(name, type, phoneFirst, phoneSecond, location, lat, lng, site, link)
    {
        let phoneSecondSection = '';
        if (phoneSecond) {
            phoneSecondSection = `<a href="#"
                                           style="font-size: 18px; display: flex; align-items: center; padding-left: 25px;"
                                           class="material-icons article__contact article__link"
                                       >
                                       ` + phoneSecond + `
                                       </a>`;
        }

        let yandexLink = 'https://yandex.ru/maps/?whatshere[point]=' + lng +',' + lat + '&whatshere[zoom]=17';

        return `<div style="min-width: 310px;">
                        <p style="font-size: 20px;">`  + name + `</p>
                        <span style="color: grey; font-size: 16px;">` + type + `</span>
                        <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
                        <a href="#"
                           style="font-size: 18px; display: flex; align-items: center;"
                           class="material-icons article__contact article__link"
                        >
                        <span style="font-size: 20px;" class="material-icons">call</span>
                            ` + phoneFirst + `
                                </a>
                        ` + phoneSecondSection + `
                                <hr style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
                                <span style="color: grey; font-size: 18px; display: flex; align-items: center;">
                                    <span
                                        style="color: #00314d; font-size: 20px;"
                                        class="material-icons">room
                                    </span>
                    ` + location + `
                                </span>
                                <a href="` + site + `" target="_blank"
                                   style="font-size: 18px; display: flex; align-items: center;"
                                   class="material-icons article__contact article__link"
                                >
                                    <span style="font-size: 20px;" class="material-icons">link</span>` + '{{ __('global.website')}}' + `</a>
                        <hr style="margin-top: 0.5rem;">
                        <div class="d-flex">
                            <a href="` + link + `" target="_blank"
                               style="border-radius: 4px; color: black; background-color: #F2F6F9; padding: 3px 10px; text-align: center; width: 50%;"
                            >
                                ` + '{{ __('global.details')}}' + `
                                </a>
                                &nbsp;&nbsp;
                                <a href="` + yandexLink + `" target="_blank"
                                   style="border-radius: 4px; color: white; background-color: #599cc1; padding: 3px 10px; text-align: center; width: 50%;"
                                >
                    ` + '{{ __('global.navigate_route')}}' + `
                                </a>
                            </div>
                        </div>
                    `;
    }
</script>

@yield('scripts')

</body>
</html>
