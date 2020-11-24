<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Dictionaries\StoreDictionaryRequest;
use App\Http\Requests\Dictionaries\UpdateDictionaryRequest;
use App\Models\Dictionary;
use App\Repositories\DictionaryRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class DictionaryService
{
    public const TYPE_SEASON = 'season';
    public const TYPE_REST = 'rest';
    public const TYPE_WHOM = 'whom';
    public const TYPE_CATEGORY_ATTRACTION = 'category_attraction';
    public const TYPE_CATEGORY_FOOD = 'category_food';
    public const TYPE_WAY_TRAVEL = 'way_travel';
    public const TYPE_PLACEMENT = 'placement';

    /**
     * @var DictionaryRepository
     */
    private DictionaryRepository $repository;

    /**
     * DictionaryService constructor.
     * @param DictionaryRepository $repository
     */
    public function __construct(DictionaryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int|null $dictionaryId
     * @return mixed
     * @throws \Exception
     */
    public function getDictionaryDatatables(? int $dictionaryId = null)
    {
        if ($dictionaryId) {
            $parent = $this->repository->getDictionary($dictionaryId);
            $queryBuilder = $parent->children();

        } else {
            $queryBuilder = $this->repository->getParentsBuilder();
        }

        $query = $queryBuilder->select($this->repository->table . '.*');

        $name = localeColumn('name');

        return Datatables::of($query)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn($name, fn ($row) => $row->children->count()
                ? "<a href='" . route("admin.dictionaries.index.child", $row->id) ."'>{$row->$name}</a>"
                : $row->$name
            )
            ->editColumn('hidden', fn ($row) => LabelHelper::boolLabel($row->hidden))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'dictionaries'))
            ->rawColumns(['actions', 'placeholder', 'hidden', $name])
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
