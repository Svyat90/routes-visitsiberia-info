@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('cruds.vars.title_singular') }} {{ __('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-vars">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ __('cruds.base.fields.id') }}
                    </th>
                    <th>
                        {{ __("cruds.vars.fields.key") }}
                    </th>
                    <th>
                        {{ __('cruds.vars.fields.val_ru') }}
                    </th>
                    <th>
                        {{ __('cruds.vars.fields.val_en') }}
                    </th>
                    <th>
                        {{ __('cruds.base.fields.created_at') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let key = '{{ localeColumn('key') }}';
            let dtOverrideGlobals = {
                buttons: null,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.vars.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'key', name: 'key'},
                    {data: 'val_ru', name: 'val_ru'},
                    {data: 'val_en', name: 'val_en'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: '{{ __('global.actions') }}'}
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-vars').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });

    </script>
@endsection
