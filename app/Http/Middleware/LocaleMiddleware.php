<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Session\Store;

class LocaleMiddleware
{
    /**
     * @var string
     */
    public static string $mainLanguage = 'ru';

    /**
     * @var array|string[]
     */
    public static array $languages = [
        'ru', 'en'
    ];

    /**
     * @var Store
     */
    private Store $store;

    /**
     * LocaleMiddleware constructor.
     *
     * @param Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * @return mixed|string|null
     */
    public static function getLocale()
    {
        $uri = Request::path();
        $segmentsUri = explode('/', $uri);
        $locale = $segmentsUri[0];

        if (! empty($locale)
            && in_array($locale, self::$languages)
            && $locale !== self::$mainLanguage) {

            return $locale;
        }

        return null;
    }



    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale() ?? session('locale') ?? self::$mainLanguage;

        App::setLocale($locale);

        return $next($request);
    }
}
