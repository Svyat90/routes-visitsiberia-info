<?php

namespace App\Repositories;

use App\Models\VarModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class VarRepository extends Model
{

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function getVar(string $key) : ? string
    {
        return VarModel::query()
            ->where('key_ru', $key . '_ru')
            ->orWhere('key_en', $key . '_en')
            ->value('val_' . app()->getLocale());
    }

    /**
     * @return array
     */
    public function getAllVars() : array
    {
        return VarModel::query()
            ->pluck(
                'val_' . app()->getLocale(),
                'key'
            )->toArray();
    }

    /**
     * @return Collection
     */
    public function getCollectionToIndex() : Collection
    {
        return VarModel::query()->get();
    }

    /**
     * @param array    $data
     * @param VarModel $varModel
     *
     * @return VarModel
     */
    public function updateData(array $data, VarModel $varModel) : VarModel
    {
        $varModel->update($data);

        return $varModel->refresh();
    }

}
