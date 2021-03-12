<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Event;
use App\Repositories\PlaceRepository;
use App\Services\DictionaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\Events\StoreEventRequest;
use App\Http\Requests\Admin\Events\UpdateEventRequest;
use App\Http\Requests\Admin\Events\MassDestroyEventRequest;
use App\Services\EventService;

class EventController extends AdminController
{
    /**
     * @var EventService
     */
    private EventService $service;

    /**
     * EventController constructor.
     *
     * @param EventService    $service
     */
    public function __construct(EventService $service)
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

        return view('admin.events.index');
    }

    /**
     * @param Event $event
     * @param DictionaryService $dictionaryService
     * @param PlaceRepository $placeRepository
     * @return View
     */
    public function create(Event $event, DictionaryService $dictionaryService, PlaceRepository  $placeRepository) : View
    {
        return view('admin.events.create', [
            'placeIds' => $placeRepository->getListForSelect(),
            'seasonList' => $dictionaryService->getSeasonList(),
            'event' => $event
        ]);
    }

    /**
     * @param StoreEventRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreEventRequest $request)
    {
        $event = $this->service->createEvent($request);

        return redirect()->route('admin.events.show', $event->id);
    }

    /**
     * @param Event $event
     *
     * @return Application|Factory|View
     */
    public function show(Event $event)
    {
        $event->load('dictionaries');

        $socialLinks = $this->service->repository->getSocialLinks($event);
        $additionalLinks = $this->service->repository->getAdditionalLinks($event);
        $phoneLinks = $this->service->repository->getPhoneLinks($event);
        $addresses = $this->service->repository->getAddresses($event);

        return view('admin.events.show', compact('event', 'socialLinks', 'additionalLinks', 'phoneLinks', 'addresses'));
    }

    /**
     * @param Event $event
     * @param DictionaryService $dictionaryService
     * @param PlaceRepository $placeRepository
     * @return Application|Factory|View
     */
    public function edit(Event $event, DictionaryService $dictionaryService, PlaceRepository  $placeRepository)
    {
        return view('admin.events.edit', [
            'event' => $event,
            'dictionaryIds' => $this->service->repository->getRelatedDictionaryIds($event),
//            'placeIds' => $placeRepository->getListForSelect(),
            'seasonList' => $dictionaryService->getSeasonList(),
            'socialLinks' => $this->service->repository->getSocialLinks($event),
            'additionalLinks' => $this->service->repository->getAdditionalLinks($event),
            'linkPhones' => $this->service->repository->getPhoneLinks($event),
            'addresses' => $this->service->repository->getAddresses($event),
        ]);
    }

    /**
     * @param UpdateEventRequest $request
     * @param Event              $event
     *
     * @return RedirectResponse
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $event = $this->service->updateEvent($request, $event);

        return redirect()->route('admin.events.show', $event->id);
    }

    /**
     * @param Event $event
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Event $event) : RedirectResponse
    {
        $event->delete();

        return back();
    }

    /**
     * @param MassDestroyEventRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function massDestroy(MassDestroyEventRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
