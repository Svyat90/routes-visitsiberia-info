<?php

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class LanguageRepository extends Language
{
    /**
     * @return array
     */
    public function activeLocales() : array
    {
        return static::active()
            ->pluck('locale')
            ->toArray();
    }

    /**
     * @return array
     */
    public function getLanguageLocales() : array
    {
        return static::query()
            ->pluck('locale')
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function getCreatedLanguages() : Collection
    {
        return $this->getLanguagesBuilder()->get();
    }

    /**
     * @return Builder
     */
    public function getLanguagesBuilder()
    {
        return static::query()
            ->select($this->table . '.*');
    }

    /**
     * @param array $data
     * @return Language
     */
    public function saveLanguage(array $data) : Model
    {
        return static::query()->create($data);
    }

    /**
     * @param array $data
     * @param Language $language
     * @return Language
     */
    public function updateData(array $data, Language $language) : Language
    {
        $language->update($data);

        return $language->refresh();
    }

    /**
     * @param array $ids
     */
    public function deleteIds(array $ids) : void
    {
        static::query()
            ->whereIn('id', $ids)
            ->delete();
    }

}
