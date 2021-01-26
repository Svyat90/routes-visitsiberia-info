<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ModelHelper;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Dictionaries\DetachDictionaryRequest;
use App\Http\Requests\Admin\Dictionaries\MassDestroyDictionaryRequest;
use App\Http\Requests\Admin\Dictionaries\StoreDictionaryRequest;
use App\Http\Requests\Admin\Dictionaries\UpdateDictionaryRequest;
use App\Models\Dictionary;
use App\Repositories\DictionaryRepository;
use App\Services\DictionaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class DictionaryController extends AdminController
{
    /**
     * @var DictionaryRepository
     */
    private DictionaryRepository $repository;

    /**
     * @var DictionaryService
     */
    private DictionaryService $service;

    /**
     * DictionaryController constructor.
     * @param DictionaryRepository $repository
     * @param DictionaryService $service
     */
    public function __construct(DictionaryRepository $repository, DictionaryService $service)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDictionaryDatatables();
        }

        return view('admin.dictionaries.index');
    }

    /**
     * @param Request $request
     * @param $dictionaryId
     * @return Application|Factory|View|mixed
     * @throws \Exception
     */
    public function indexChild(Request $request, $dictionaryId)
    {
        if ($request->ajax()) {
            return $this->service->getDictionaryDatatables($dictionaryId);
        }

        return view('admin.dictionaries.index');
    }

    /**
     * @return View
     */
    public function create() : View
    {
        $dictionaryList = $this->repository->getListForSelect();

        return view('admin.dictionaries.create', compact('dictionaryList'));
    }

    /**
     * @param StoreDictionaryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreDictionaryRequest $request)
    {
        $dictionary = $this->service->createDictionary($request);

        return redirect()->route('admin.dictionaries.show', $dictionary->id);
    }

    /**
     * @param Dictionary $dictionary
     * @return Application|Factory|View
     */
    public function show(Dictionary $dictionary)
    {
        $dictionary->load('children');

        return view('admin.dictionaries.show', compact('dictionary'));
    }

    /**
     * @param Dictionary $dictionary
     * @return Application|Factory|View
     */
    public function edit(Dictionary $dictionary)
    {
        $dictionaryList = $this->repository->getListForSelect();

        return view('admin.dictionaries.edit', compact('dictionary', 'dictionaryList'));
    }

    /**
     * @param UpdateDictionaryRequest $request
     * @param Dictionary $dictionary
     * @return RedirectResponse
     */
    public function update(UpdateDictionaryRequest $request, Dictionary $dictionary)
    {
        $dictionary = $this->service->updateDictionary($request, $dictionary);

        return redirect()->route('admin.dictionaries.show', $dictionary->id);
    }

    /**
     * @param Dictionary $dictionary
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Dictionary $dictionary) : RedirectResponse
    {
        $dictionary->delete();

        return back();
    }

    /**
     * @param MassDestroyDictionaryRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyDictionaryRequest $request) : Response
    {
        $this->repository->deleteIds($request->ids);

        return response()->noContent();
    }

    /**
     * @param DetachDictionaryRequest $request
     * @return RedirectResponse
     */
    public function detach(DetachDictionaryRequest $request) : RedirectResponse
    {
        $model = ModelHelper::findModel($request->entity, $request->entity_id);

        if ($model) {
            $model->dictionaries()->detach($request->dictionary_id);
            session()->flash('message', __('global.success_delete_dictionary'));
        }

        return redirect()->back();
    }
}
