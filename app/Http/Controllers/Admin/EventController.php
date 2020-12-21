<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Events\MassDestroyEventRequest;
use App\Http\Requests\Admin\Events\StoreEventRequest;
use App\Http\Requests\Admin\Events\UpdateEventRequest;
use App\Models\Event;
use App\Repositories\DictionaryRepository;
use App\Services\EventService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Event          $event
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return View
     */
    public function create(Event $event, DictionaryRepository $dictionaryRepository) : View
    {
        $dictionaryChildren = $dictionaryRepository->getChildrenForSelect();
        return view('admin.events.create', compact('event', 'dictionaryChildren'));
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

        return view('admin.events.show', compact('event'));
    }

    /**
     * @param Event                $event
     * @param DictionaryRepository $dictionaryRepository
     *
     * @return Application|Factory|View
     */
    public function edit(Event $event, DictionaryRepository $dictionaryRepository)
    {
        return view('admin.events.edit', [
            'event' => $event,
            'dictionaryChildren' => $dictionaryRepository->getChildrenForSelect(),
            'dictionaryIds' => $this->service->repository->getRelatedDictionaryIds($event)
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
