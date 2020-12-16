<?php

namespace App\Services;

use App\Helpers\DatatablesHelper;
use App\Repositories\PageRepository;
use Yajra\DataTables\Facades\DataTables;

class PageService
{

    /**
     * @var PageRepository
     */
    public PageRepository $repository;

    /**
     * DictionaryService constructor.
     *
     * @param PageRepository $repository
     */
    public function __construct(PageRepository $repository)
    {
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
            ->editColumn('title', fn ($row) => $row->title)
            ->editColumn('meta_title', fn ($row) => $row->meta_title)
            ->editColumn('meta_description', fn ($row) => $row->meta_description)
            ->editColumn('created_at', fn ($row) => $row->created_at)
            ->addColumn('actions', fn ($row) => DatatablesHelper::renderActionsRow($row, 'pages', false))
            ->rawColumns(['actions', 'placeholder'])
            ->make(true);
    }

}
