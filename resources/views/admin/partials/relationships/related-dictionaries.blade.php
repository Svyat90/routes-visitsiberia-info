<div class="m-3">
    <div class="card">
        <div class="card-header">
            {{ __('cruds.dictionaries.title') }} {{ __('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-accessCategories">
                    <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __('cruds.base.fields.id') }}
                        </th>
                        <th>
                            {{ __('cruds.dictionaries.fields.name') }}
                        </th>
                        <th>
                            {{ __('cruds.dictionaries.fields.type') }}
                        </th>
                        <th>
                            {{ __('cruds.dictionaries.fields.hidden') }}
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
                    @foreach($dictionaries as $dictionary)
                        <tr data-entry-id="{{ $dictionary->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dictionary->id }}
                            </td>
                            <td>
                                {!! LabelHelper::dictionaryLabel($dictionary) !!}
                            </td>
                            <td>
                                {{ $dictionary->type }}
                            </td>
                            <td>
                                {!! LabelHelper::boolLabel($dictionary->hidden) !!}
                            </td>
                            <td>
                                {{ $dictionary->created_at }}
                            </td>
                            <td>
                                <form action="{{ route('admin.dictionaries.detach', ['entity' => $namespace, 'entity_id' => $entity_id, 'dictionary_id' => $dictionary->id]) }}"
                                      method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');"
                                      style="display: inline-block;">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.disconnect') }}">
                                </form>
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
            $('.datatable-accessCategories:not(.ajaxTable)').DataTable({buttons: dtButtons})
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
