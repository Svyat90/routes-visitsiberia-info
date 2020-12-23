<?php

namespace App\Services;

use Illuminate\Support\Collection;

abstract class BaseService
{

    /**
     * @var Collection
     */
    protected Collection $dictionaryIds;

    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->dictionaryIds = new Collection();
    }

    /**
     * @param Collection $dictionaryIds
     */
    public function setDictionaryIds(Collection $dictionaryIds) : void
    {
        $this->dictionaryIds = $dictionaryIds;
    }

    /**
     * @param mixed ...$data
     *
     * @return bool
     */
    protected function filterDictionaries(...$data) : bool
    {
        return collect($data)->map(function ($id) {
            return $this->filterDictionary($id);
        })->first(function (bool $val) {
            return $val === false;
        }, true);
    }

    /**
     * @param int|null $dictionaryId
     *
     * @return bool
     */
    private function filterDictionary(? int $dictionaryId) : bool
    {
        return $dictionaryId
            ? $this->dictionaryIds->contains($dictionaryId)
            : true;
    }

}
