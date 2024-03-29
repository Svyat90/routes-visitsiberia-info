<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LocaleMiddleware;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class LocaleController extends Controller
{

    /**
     * @param string $lang
     *
     * @return RedirectResponse
     */
    public function setLocale(string $lang) : RedirectResponse
    {
        $referer = Redirect::back()->getTargetUrl(); // URL предыдущей страницы
        $parse_url = parse_url($referer, PHP_URL_PATH); // URI предыдущей страницы

        // разбиваем на массив по разделителю
        $segments = explode('/', $parse_url);

        // Если URL (где нажали на переключение языка) содержал корректную метку языка
        if (in_array($segments[1], LocaleMiddleware::$languages)) {

            unset($segments[1]); // удаляем метку
        }

        // Добавляем метку языка в URL (если выбран не язык по-умолчанию)
        if ($lang != LocaleMiddleware::$mainLanguage) {
            array_splice($segments, 1, 0, $lang);
        }

        // формируем полный URL
        $url = Request::root() . implode("/", $segments);

        // если были еще GET-параметры - добавляем их
        if (parse_url($referer, PHP_URL_QUERY)) {
            $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
        }

        return redirect($url); // Перенаправляем назад на ту же страницу
    }

}
