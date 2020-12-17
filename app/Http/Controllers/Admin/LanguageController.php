<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\Languages\StoreLanguageRequest;
use App\Http\Requests\Admin\Languages\UpdateLanguageRequest;
use App\Http\Requests\Admin\Languages\MassDestroyLanguageRequest;

class LanguageController extends AdminController
{
    /**
     * @var LanguageService
     */
    protected LanguageService $service;

    /**
     * LanguageController constructor.
     * @param LanguageService $service
     */
    public function __construct(LanguageService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        return $request->ajax()
            ? $this->service->getLanguageDatatables()
            : view('admin.languages.index');
    }

    /**
     * @return View
     */
    public function create() : View
    {
        $locales = $this->service->getAvailableLocales();

        return view('admin.languages.create', compact('locales'));
    }

    /**
     * @param StoreLanguageRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLanguageRequest $request)
    {
        $language = $this->service->repository->saveLanguage($request->validated());

        return redirect()->route('admin.languages.show', $language->id);
    }

    /**
     * @param Language $language
     * @return View
     */
    public function show(Language $language)
    {
        return view('admin.languages.show', compact('language'));
    }

    /**
     * @param Language $language
     * @return Application|Factory|View
     */
    public function edit(Language $language) : View
    {
        $locales = $this->service->getAvailableLocales();

        return view('admin.languages.edit', compact('language', 'locales'));
    }

    /**
     * @param UpdateLanguageRequest $request
     * @param Language $language
     * @return RedirectResponse
     */
    public function update(UpdateLanguageRequest $request, Language $language) : RedirectResponse
    {
        $language = $this->service->repository->updateData($request->validated(), $language);

        return redirect()->route('admin.languages.show', $language->id);
    }

    /**
     * @param Language $language
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Language $language) : RedirectResponse
    {
        $language->delete();

        return back();
    }

    /**
     * @param MassDestroyLanguageRequest $request
     * @return Response
     */
    public function massDestroy(MassDestroyLanguageRequest $request) : Response
    {
        $this->service->repository->deleteIds($request->ids);

        return response()->noContent();
    }

}
