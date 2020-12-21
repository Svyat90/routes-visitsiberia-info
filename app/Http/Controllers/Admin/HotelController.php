<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Hotel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Hotels\StoreHotelRequest;
use App\Http\Requests\Admin\Hotels\UpdateHotelRequest;
use App\Http\Requests\Admin\Hotels\MassDestroyHotelRequest;
use App\Services\HotelService;
use App\Repositories\DictionaryRepository;

class HotelController extends AdminController
{
    /**
     * @var HotelService
     */
    private HotelService $service;

    /**
     * HotelController constructor.
     *
     * @param HotelService    $service
     */
    public function __construct(HotelService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDatatablesData();
        }

        return view('admin.hotels.index');
    }

    /**
     * @param Hotel          $hotel
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return View
     */
    public function create(Hotel $hotel, DictionaryRepository $dictionaryRepository) : View
    {
        $dictionaryChildren = $dictionaryRepository->getChildrenForSelect();

        return view('admin.hotels.create', compact('hotel', 'dictionaryChildren'));
    }

    /**
     * @param StoreHotelRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreHotelRequest $request)
    {
        $hotel = $this->service->createHotel($request);

        return redirect()->route('admin.hotels.show', $hotel->id);
    }

    /**
     * @param Hotel $hotel
     *
     * @return Application|Factory|View
     */
    public function show(Hotel $hotel)
    {
        $hotel->load('dictionaries');

        return view('admin.hotels.show', compact('hotel'));
    }

    /**
     * @param Hotel                $hotel
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return Application|Factory|View
     */
    public function edit(Hotel $hotel, DictionaryRepository $dictionaryRepository)
    {
        return view('admin.hotels.edit', [
            'hotel' => $hotel,
            'dictionaryChildren' => $dictionaryRepository->getChildrenForSelect(),
            'dictionaryIds' => $this->service->repository->getRelatedDictionaryIds($hotel)
        ]);
    }

    /**
     * @param UpdateHotelRequest $request
     * @param Hotel              $hotel
     *
     * @return RedirectResponse
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $hotel = $this->service->updateHotel($request, $hotel);

        return redirect()->route('admin.hotels.show', $hotel->id);
    }

    /**
     * @param Hotel $hotel
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Hotel $hotel) : RedirectResponse
    {
        $hotel->delete();

        return back();
    }

    /**
     * @param MassDestroyHotelRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function massDestroy(MassDestroyHotelRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
