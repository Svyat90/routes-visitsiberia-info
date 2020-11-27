<?php

namespace App\Services;

use App\Helpers\FileSystemHelper;
use App\Repositories\LanguageRepository;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Collection;

class TranslationService
{
    /**
     * @var LanguageRepository
     */
    private LanguageRepository $languageRepository;

    /**
     * @var array
     */
    private array $locales;

    /**
     * TranslationService constructor.
     * @param LanguageRepository $languageRepository
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->locales = $this->languageRepository->activeLocales();
    }

    /**
     * @param string $folder
     * @return Collection
     */
    public function getFilesWithContent(string $folder) : Collection
    {
        return collect(FileSystemHelper::getFolderFiles($folder))
            ->map(function (SplFileInfo $file) {
                return (object) [
                    'name' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'content' => include($file->getPathname())
                ];
            });
    }

    /**
     * @param Model $model
     * @param string $field
     * @param string $val
     */
    public function setLocaleTranslates(Model &$model, string $field, string $val) : void
    {
        $translations = collect($this->locales)->map(function (string $locale) use ($val) {
            return [$locale => $val];
        })->collapse()->toArray();

        $model->setTranslations($field, $translations);
    }

}
