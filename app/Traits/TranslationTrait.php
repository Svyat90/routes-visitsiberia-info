<?php

namespace App\Traits;

use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Support\Facades\View;

trait TranslationTrait
{
    public function shareTranslations() : void
    {
        $service = app(LanguageService::class);

        $languages = Language::where('active',1)->get();
        View::share(compact('languages'));
    }
}
