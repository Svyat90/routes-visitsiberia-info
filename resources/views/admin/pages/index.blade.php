@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('cruds.pages.title_singular') }} {{ __('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-pages">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ __('cruds.base.fields.id') }}
                    </th>
                    <th>
                        {{ __('cruds.pages.fields.name') }} ({{ app()->getLocale() }})
                    </th>
                    <th>
                        {{ __('cruds.pages.fields.title') }} ({{ app()->getLocale() }})
                    </th>
                    <th>
                        {{ __('cruds.pages.fields.meta_title') }} ({{ app()->getLocale() }})
                    </th>
                    <th>
                        {{ __('cruds.pages.fields.meta_description') }} ({{ app()->getLocale() }})
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.pages.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'title', name: 'title'},
                    {data: 'meta_title', name: 'meta_title'},
                    {data: 'meta_description', name: 'meta_description'},
                    {data: 'actions', name: '{{ __('global.actions') }}'}
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-pages').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });

    </script>
@endsection
