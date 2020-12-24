<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Dictionaries\StoreDictionaryRequest;
use App\Http\Requests\Admin\Dictionaries\UpdateDictionaryRequest;
use App\Models\Dictionary;
use App\Repositories\DictionaryRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

class DictionaryService
{
    public const TYPE_SEASON = 'season';
    public const TYPE_REST = 'rest';
    public const TYPE_WHOM = 'whom';
    public const TYPE_CATEGORY_PLACE = 'category_place';
    public const TYPE_CATEGORY_FOOD = 'category_food';
    public const TYPE_WAY_TRAVEL = 'way_travel';
    public const TYPE_PLACEMENT = 'placement';
    public const TYPE_TRANSPORT = 'transport';
    public const TYPE_TAG = 'tag';
    public const TYPE_BREAK_PEOPLE = 'break_people';
    public const TYPE_DELIVERY_FOOD = 'delivery_food';
    public const TYPE_CITY = 'city';
    public const TYPE_DISTANCE = 'distance';

    /**
     * @var DictionaryRepository
     */
    private DictionaryRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param DictionaryRepository $repository
     */
    public function __construct(DictionaryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection
     */
    public function getBaseDictionaries() : Collection
    {
        return $this->repository->getBaseDictionaries();
    }

    /**
     * @return Collection
     */
    public function getTypesList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_REST);
    }

    /**
     * @return Collection
     */
    public function getSeasonList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_SEASON);
    }

    /**
     * @return Collection
     */
    public function getTransportList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_TRANSPORT);
    }

    /**
     * @return Collection
     */
    public function getCategoryPlaceList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_CATEGORY_PLACE);
    }

    /**
     * @return Collection
     */
    public function getWhomList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_WHOM);
    }

    /**
     * @return Collection
     */
    public function getDeliveryFoodList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_DELIVERY_FOOD);
    }

    /**
     * @return Collection
     */
    public function getCategoryFoodList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_CATEGORY_FOOD);
    }

    /**
     * @return Collection
     */
    public function getCityList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_CITY);
    }

    /**
     * @return Collection
     */
    public function getDistanceList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_DISTANCE);
    }

    /**
     * @return Collection
     */
    public function getPlacementList() : Collection
    {
        return $this->repository->getChildrenByType(self::TYPE_PLACEMENT);
    }

    /**
     * @param int|null $dictionaryId
     * @return mixed
     * @throws \Exception
     */
    public function getDictionaryDatatables(? int $dictionaryId = null)
    {
        $collection = $this->repository->getCollectionToIndex($dictionaryId);

        return Datatables::of($collection)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', function ($row) {
                return $row->children->count()
                    ? "<a href='" . route("admin.dictionaries.index.child", $row->id) ."'>{$row->name}</a>"
                    : $row->name;
            })
            ->editColumn('hidden', fn ($row) => LabelHelper::boolLabel($row->hidden))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'dictionaries'))
            ->rawColumns(['actions', 'placeholder', 'hidden', 'name'])
            ->make(true);
    }

    /**
     * @param StoreDictionaryRequest $request
     * @return Dictionary
     */
    public function createDictionary(StoreDictionaryRequest $request) : Dictionary
    {
        $inputData = $request->validated();

        if (! empty($inputData['dictionary_id'])) {
           return $this->repository->saveChildDictionary($inputData);
        }

        return $this->repository->saveDictionary($inputData);
    }

    /**
     * @param UpdateDictionaryRequest $request
     * @param Dictionary $dictionary
     * @return Dictionary
     */
    public function updateDictionary(UpdateDictionaryRequest $request, Dictionary $dictionary) : Dictionary
    {
        $inputData = $request->validated();

        $this->repository->handleParent($dictionary, $inputData['dictionary_id'] ?? null);

        if ($dictionary->parent && $dictionary->parent->type === DictionaryService::TYPE_SEASON) {
            $this->normalizeDateRange($inputData);
        }

        return $this->repository->updateData($inputData, $dictionary);
    }

    /**
     * @param array $inputData
     */
    private function normalizeDateRange(array &$inputData) : void
    {
        if (! isset($inputData['date_range'])) {
            return;
        }

        [$dateRangeFrom, $dateRangeTo] = explode(" - ", $inputData['date_range']);

        $inputData['date_range_from'] = Carbon::createFromFormat('d/m/Y', $dateRangeFrom)->format('d-m-Y');
        $inputData['date_range_to'] = Carbon::createFromFormat('d/m/Y', $dateRangeTo)->format('d-m-Y');

        unset($inputData['date_range']);
    }

}
