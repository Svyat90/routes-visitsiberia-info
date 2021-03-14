<div class="m-3">
    <div class="card">
        <div class="card-header">
            {{ __('cruds.replies.title_singular') }} {{ __('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-access-places">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __('cruds.base.fields.id') }}
                        </th>
                        <th>
                            {{ __('cruds.replies.fields.name') }}
                        </th>
                        <th>
                            {{ __('global.active') }}
                        </th>
                        <th>
                            {{ __('global.type') }}
                        </th>
                        <th>
                            {{ __('cruds.base.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr data-entry-id="{{ $item->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ RouteHelper::namespace($item) }}
                            </td>
                            <td>
                                {!! LabelHelper::boolLabel($item->active) !!}
                            </td>
                            <td>
                                {{ $item->created_at }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ RouteHelper::showAdmin($item) }}">
                                    {{ __('global.view') }}
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ RouteHelper::editAdmin($item) }}">
                                    {{ __('global.edit') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 25,
            });
            $('.datatable-access-places:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
