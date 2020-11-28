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
    public function getBaseDictionaries() : Collection
    {
        return $this->getParentsBuilder()
            ->with('children')
            ->get()
            ->groupBy('type');
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return static::query()
            ->get()
            ->groupBy('id', true)
            ->map(function (Collection $items) {
                return columnTrans($items->shift(), 'name');
            });
    }

    /**
     * @param int|null $dictionaryId
     * @return Collection
     */
    public function getCollectionToIndex(? int $dictionaryId = null) : Collection
    {
        if ($dictionaryId) {
            $parent = $this->getDictionary($dictionaryId);
            $queryBuilder = $parent->children();

        } else {
            $queryBuilder = $this->getParentsBuilder();
        }

        return $queryBuilder
            ->select($this->table . '.*')
            ->get();
    }

    /**
     * @param array $data
     * @return Dictionary
     */
    public function saveDictionary(array $data) : Model
    {
        $dictionary = $this->fillDictionary($data);

        $dictionary->save();

        return $dictionary;
    }

    /**
     * @param array $data
     * @return Dictionary
     */
    public function saveChildDictionary(array $data) : Model
    {
        $parent = $this->getDictionary($data['dictionary_id']);

        $dictionary = $this->fillDictionary($data);

        return $parent->children()->save($dictionary);
    }

    /**
     * @param array $data
     * @return Dictionary
     */
    public function fillDictionary(array $data) : Dictionary
    {
        $dictionary = new Dictionary($data);
        $dictionary->setTranslations('name', $data['name']);

        return $dictionary;
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
        $dictionary->setTranslations('name', $data['name']);

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
