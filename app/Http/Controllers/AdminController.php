<?php

namespace App\Http\Controllers;

use App\Traits\TranslationTrait;

class AdminController extends Controller
{
    use TranslationTrait;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->shareTranslations();
    }

}
