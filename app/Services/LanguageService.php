<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\FileSystemHelper;
use App\Helpers\LabelHelper;
use App\Repositories\LanguageRepository;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

class LanguageService
{
    /**
     * @var LanguageRepository
     */
    public LanguageRepository $repository;

    /**
     * LanguageService constructor.
     * @param LanguageRepository $repository
     */
    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getLanguageDatatables()
    {
        $queryBuilder = $this->repository->getLanguagesBuilder();

        return Datatables::of($queryBuilder)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('active', fn ($row) => LabelHelper::boolLabel($row->active))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->editColumn('updated_at', fn ($row) => $row->updated_at)
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'languages'))
            ->rawColumns(['actions', 'placeholder', 'active'])
            ->make(true);
    }

    /**
     * @return string[]
     */
    public function getAvailableLocales() : array
    {
        $existLocales = collect($this->repository->getLanguageLocales());

        $allLocales = collect(FileSystemHelper::getLangDirectories())
            ->map(function (string $path) {
                return collect(explode("/", $path))->last();
            });

        return $allLocales->diff($existLocales)->toArray();
    }

    /**
     * @return Collection
     */
    public function getActiveLanguages() : Collection
    {
        $activeList = $this->repository->activeLocales();

        return collect(FileSystemHelper::getLangDirectories())
            ->filter(function (string $path) use ($activeList) {
                $locale = collect(explode(DIRECTORY_SEPARATOR, $path))->last();
                return in_array($locale, $activeList);
            })
            ->map(function ($path) {
                return $this->fillLang($path);
            });
    }

    /**
     * @param string $path
     * @return \stdClass
     */
    private function fillLang(string $path) : \stdClass
    {
        $lang = new \stdClass();
        $lang->name = collect(explode(DIRECTORY_SEPARATOR, $path))->last();
        $lang->path = $path;

        return $lang;
    }

}
