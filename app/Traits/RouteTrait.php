<?php

namespace App\Traits;

use App\Helpers\CookieHelper;
use Illuminate\Support\Facades\View;

trait RouteTrait
{
    public function shareRouteCount() : void
    {
        $routeData = CookieHelper::getRouteList();

        $routeCount = 0;
        foreach ($routeData as $entity) {
            $routeCount += count($entity);
        }

        View::share(compact('routeCount'));
    }
}
