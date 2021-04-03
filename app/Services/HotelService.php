<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Helpers\LabelHelper;
use App\Http\Requests\Admin\Hotels\StoreHotelRequest;
use App\Http\Requests\Admin\Hotels\UpdateHotelRequest;
use App\Models\Hotel;
use App\Repositories\HotelRepository;
use App\Traits\FilterConstantsTrait;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\MediaHelper;
use App\Helpers\ImageHelper;
use Illuminate\Support\Collection;
use App\Http\Requests\Front\Hotels\IndexHotelRequest;

class HotelService extends BaseService
{
    use FilterConstantsTrait;

    const CONDITIONS_PAYMENT_CASH = 'cash';
    const CONDITIONS_PAYMENT_CART = 'card';

    /**
     * @var HotelRepository
     */
    public HotelRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param HotelRepository $repository
     */
    public function __construct(HotelRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getDatatablesData()
    {
        $collection = $this->repository->getCollectionToIndex();

        return Datatables::of($collection)
            ->addColumn('placeholder', '&nbsp;')
            ->editColumn('id', fn ($row) => $row->id)
            ->editColumn('name', fn ($row) => $row->name)
            ->editColumn('slug', fn ($row) => $row->slug)
            ->editColumn('active', fn ($row) => LabelHelper::boolLabel($row->active))
            ->editColumn('recommended', fn ($row) => LabelHelper::boolLabel($row->recommended))
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('image', fn ($row) => ImageHelper::thumbImage($row->image))
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'hotels'))
            ->rawColumns(['actions', 'placeholder', 'active', 'recommended', 'image'])
            ->make(true);
    }

    /**
     * @param StoreHotelRequest $request
     *
     * @return Hotel
     */
    public function createHotel(StoreHotelRequest $request) : Hotel
    {
        $hotel = $this->repository->saveHotel($request->all());

        $this->handleMediaFiles($request, $hotel);
        $this->handleRelationships($hotel, $request);
        $this->handleCityDictionary($hotel);

        return $hotel;
    }

    /**
     * @param UpdateHotelRequest $request
     * @param Hotel              $hotel
     *
     * @return Hotel
     */
    public function updateHotel(UpdateHotelRequest $request, Hotel $hotel) : Hotel
    {
        $this->handleMediaFiles($request, $hotel);
        $this->handleRelationships($hotel, $request);

        return $this->repository->updateData($request->all(), $hotel);
    }

    /**
     * @param IndexHotelRequest $request
     *
     * @return Collection
     */
    public function getFilteredHotels(IndexHotelRequest $request) : Collection
    {
        return Hotel::query()
            ->active()
            ->get()
            ->filter(function (Hotel $hotel) use ($request) {
                $dictionaryIds = $hotel->dictionaries->pluck('id');
                return $this->setFilters($dictionaryIds, $request);
            });
    }

    /**
     * @param Hotel $hotel
     *
     * @return array
     */
    public function getNearData(Hotel $hotel)
    {
        $events = $this->getNearObjects('events', $hotel->lat, $hotel->lng);
        $places = $this->getNearObjects('places', $hotel->lat, $hotel->lng);
        $meals = $this->getNearObjects('meals', $hotel->lat, $hotel->lng);

        $geoData = $events
            ->merge($meals)
            ->merge($places);

        return [$events, $meals, $places, $geoData];
    }

    /**
     * @param Collection        $dictionaryIds
     * @param IndexHotelRequest $request
     *
     * @return bool
     */
    private function setFilters(Collection $dictionaryIds, IndexHotelRequest $request)
    {
        $this->setDictionaryIds($dictionaryIds);

        return $this->filterDictionaries(
            $request->city_id,
            $request->season_id,
            $request->placement_id
        );
    }

    /**
     * @param StoreHotelRequest|UpdateHotelRequest   $request
     * @param Hotel $hotel
     */
    private function handleMediaFiles($request, Hotel $hotel) : void
    {
        MediaHelper::handleMedia($hotel, 'image', $request->image);
        MediaHelper::handleMedia($hotel, 'image_history', $request->image_history);
        MediaHelper::handleMediaCollect($hotel, 'image_gallery', $request->image_gallery);
    }

    /**
     * @param Hotel $hotel
     * @param StoreHotelRequest|UpdateHotelRequest $request
     */
    private function handleRelationships(Hotel $hotel, $request) : void
    {
        $hotel->dictionaries()->sync($request->dictionary_ids);

        if ($request instanceof UpdateHotelRequest) {
            $hotel->socialFields()->delete();
        }

        $this->saveSocialLinks($hotel, $request);
        $this->saveAggregatorLinks($hotel, $request);
        $this->savePhones($hotel, $request);
    }

    /**
     * @return array
     */
    public static function getConditionsTypes() : array
    {
        return self::filterConstants('CONDITIONS_PAYMENT');
    }

}
