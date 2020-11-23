@if($model->created_at)
    <tr>
        <th>{{ trans("cruds.base.fields.created_at") }}</th>
        <td>{{ $model->created_at }}</td>
    </tr>
@endif

@if($model->updated_at)
    <tr>
        <th>{{ trans("cruds.base.fields.updated_at") }}</th>
        <td>{{ $model->updated_at }}</td>
    </tr>
@endif

@if($model->deleted_at)
    <tr>
        <th>{{ trans("cruds.base.fields.deleted_at") }}</th>
        <td>{{ $model->deleted_at }}</td>
    </tr>
@endif
