<?php

namespace App\Http\Controllers;

use App\Traits\RouteTrait;
use App\Traits\VarTrait;

class FrontController extends Controller
{
    use VarTrait, RouteTrait;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->shareVars();
        $this->shareRouteCount();
    }

}
