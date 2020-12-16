<a class="btn btn-xs btn-primary" href="{{ route('admin.' . $entityName . '.show', $row->id) }}">
    {{ trans('global.view') }}
</a>

<a class="btn btn-xs btn-info" href="{{ route('admin.' . $entityName . '.edit', $row->id) }}">
    {{ trans('global.edit') }}
</a>
