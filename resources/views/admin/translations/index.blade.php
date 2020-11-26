@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.settings.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-settings">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.settings.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.settings.fields.key') }}
                        </th>
                        <th>
                            {{ trans('cruds.settings.fields.val') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr data-entry-id="{{ $setting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $setting->id }}
                            </td>
                            <td>
                                {{ $setting->key }}
                            </td>
                            <td>
                                {{ $setting->val }}
                            </td>
                            <td>

                                @can('setting_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.settings.edit', $setting->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            $.extend(true, $.fn.dataTable.defaults, {
                order: [[1, 'desc']],
                pageLength: 100,
            });
            $('.datatable-settings:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })
    </script>
@endsection
