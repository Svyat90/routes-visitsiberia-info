<?php

namespace App\Traits;

use App\Services\LanguageService;
use Illuminate\Support\Facades\View;

trait TranslationTrait
{
    public function shareTranslations() : void
    {
        $service = app(LanguageService::class);

        $languages = $service->repository->getCreatedLanguages();

        View::share(compact('languages'));
    }
}
