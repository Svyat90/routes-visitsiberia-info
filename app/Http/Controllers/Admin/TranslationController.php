<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\LanguageFileHelper;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Translation\EditTranslationRequest;
use App\Http\Requests\Translation\UpdateTranslationRequest;
use App\Services\TranslationService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TranslationController extends AdminController
{
    /**
     * @var TranslationService
     */
    private TranslationService $service;

    /**
     * TranslationController constructor.
     * @param TranslationService $service
     */
    public function __construct(TranslationService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @param EditTranslationRequest $request
     * @return Application|Factory|View
     */
    public function edit(EditTranslationRequest $request) : View
    {
        $files = $this->service->getFilesWithContent($request->path);

        return view('admin.translations.edit', compact('files'));
    }

    /**
     * @param UpdateTranslationRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateTranslationRequest $request) : RedirectResponse
    {
        LanguageFileHelper::updateLanguageFile($request->data, $request->path);

        return redirect()
            ->back()
            ->with([
                'message' => trans('global.success_update')
            ]);
    }

}
