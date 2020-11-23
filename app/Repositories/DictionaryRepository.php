<?php

namespace App\Repositories;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DictionaryRepository extends Dictionary
{

    /**
     * @param int $id
     * @return Dictionary
     */
    public function getDictionary(int $id) : Model
    {
        return static::query()->find($id);
    }

    /**
     * @return Builder
     */
    public function getParentsBuilder()
    {
        return static::query()->whereNull('parent_id');
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return static::query()
            ->pluck(
                localeColumn('name'),
                'id'
            );
    }

    /**
     * @param array $data
     * @return Dictionary
     */
    public function saveDictionary(array $data) : Model
    {
        return static::query()->create($data);
    }

    /**
     * @param array $data
     * @return Dictionary
     */
    public function saveChildDictionary(array $data) : Model
    {
        $parent = $this->getDictionary($data['dictionary_id']);

        return $parent->children()->create($data);
    }

    /**
     * @param Dictionary $dictionary
     * @param int|null $dictionaryId
     */
    public function handleParent(Dictionary $dictionary, ? int $dictionaryId) : void
    {
        if ($dictionaryId) {
            $dictionary->parent()->associate($dictionaryId);
            return;
        }

        $dictionary->parent()->dissociate();
    }

    /**
     * @param array $data
     * @param Dictionary $dictionary
     * @return Dictionary
     */
    public function updateData(array $data, Dictionary $dictionary) : Dictionary
    {
        $dictionary->update($data);

        return $dictionary->refresh();
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
