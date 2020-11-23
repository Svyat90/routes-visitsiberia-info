@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.dictionaries.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.dictionaries.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.dictionaries.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-dictionaries">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.base.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.dictionaries.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.dictionaries.fields.hidden') }}
                    </th>
                    <th>
                        {{ trans('cruds.base.fields.created_at') }}
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
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.dictionaries.mass_destroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                            .done(function () {
                                location.reload()
                            })
                    }
                }
            }
            dtButtons.push(deleteButton)

            let name = '{{ localeColumn('name') }}';

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ Request()->dictionary_id ? route('admin.dictionaries.index.child', Request()->dictionary_id) : route('admin.dictionaries.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: name, name: name},
                    {data: 'hidden', name: 'hidden'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: '{{ trans('global.actions') }}'}
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-dictionaries').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });

    </script>
@endsection
