@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('cruds.reviews.title_singular') }} {{ __('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-events">
                <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ __('cruds.base.fields.id') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.name') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.phone') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.email') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.rating') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.approved') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.allow_comments') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.object') }}
                    </th>
                    <th>
                        {{ __('cruds.reviews.fields.object_id') }}
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ __('global.datatables.delete') }}';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.reviews.multi_destroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('{{ __('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ __('global.areYouSure') }}')) {
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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.reviews.index') }}",
                columns: [
                    {data: 'placeholder', name: 'placeholder'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'rating', name: 'rating'},
                    {data: 'approved', name: 'approved'},
                    {data: 'allow_comments', name: 'allow_comments'},
                    {data: 'object', name: 'object'},
                    {data: 'object_id', name: 'object_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'actions', name: '{{ __('global.actions') }}'}
                ],
                order: [[1, 'desc']],
                pageLength: 100,
            };
            $('.datatable-events').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });

    </script>
@endsection
