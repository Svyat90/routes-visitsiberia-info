<?php

namespace App\Http\Controllers;

use App\Traits\VarTrait;

class FrontController extends Controller
{
    use VarTrait;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->shareVars();
    }

}
