<?php

namespace App\Repositories;

use App\Models\Dictionary;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DictionaryRepository extends Dictionary
{

    /**
     * @param int $id
     * @return Dictionary
     */
    public function getDictionary(int $id) : Model
    {
        return Dictionary::query()->find($id);
    }

    /**
     * @return Builder
     */
    public function getParentsBuilder() : Builder
    {
        return Dictionary::query()->whereNull('parent_id');
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
     * @return Dictionary
     */
    public function getParentCityDictionary() : Model
    {
        return Dictionary::query()
            ->with('children')
            ->where('type', 'city')
            ->first();
    }

    /**
     * @return Collection
     */
    public function getListForSelect() : Collection
    {
        return Dictionary::query()
            ->get()
            ->groupBy('id', true)
            ->map(function (Collection $items) {
                return columnTrans($items->shift(), 'name');
            });
    }

    /**
     * @param string|null $type
     *
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getChildrenByType(? string $type)
    {
        return Dictionary::query()
            ->join('dictionaries as parent', 'parent.type', '=', DB::raw("'" . $type . "'"))
            ->where('dictionaries.parent_id', '=', DB::raw('parent.id'))
            ->get(['dictionaries.id', 'dictionaries.name']);
    }

    /**
     * @return Collection
     */
    public function getChildrenForSelect() : Collection
    {
        return Dictionary::query()
            ->whereNotNull('parent_id')
            ->with('parent')
            ->get()
            ->groupBy('id', true)
            ->map(function (Collection $items) {
                $item = $items->shift();
                return sprintf('%s (%s)', $item->name, $item->parent->name);
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
        $dictionary->setTranslations('name', $data['name']);
        $dictionary->update($data);

        return $dictionary->refresh();
    }

    /**
     * @param array $ids
     */
    public function deleteIds(array $ids) : void
    {
        Dictionary::query()
            ->whereIn('id', $ids)
            ->delete();
    }

}
