<?php

namespace App\Services\Browser;

use App\Helpers\CookieHelper;
use Illuminate\Support\Collection;

class ConstructorService extends BrowserService
{

    /**
     * @return Collection
     */
    public function getRouteData() : Collection
    {
        $routeData = CookieHelper::getRouteList();

        return $this->generateData($routeData);
    }

}
