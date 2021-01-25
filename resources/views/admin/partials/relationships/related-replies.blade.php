<div class="m-3">
    <div class="card">
        <div class="card-header">
            {{ __('cruds.replies.title_singular') }} {{ __('global.list') }}
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
                            {{ __('cruds.replies.fields.name') }}
                        </th>
                        <th>
                            {{ __('cruds.replies.fields.is_admin') }}
                        </th>
                        <th>
                            {{ __('cruds.replies.fields.body') }}
                        </th>
                        <th>
                            {{ __('cruds.replies.fields.created_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($replies as $key => $reply)
                        <tr data-entry-id="{{ $reply->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $reply->id }}
                            </td>
                            <td>
                                {{ $reply->name }}
                            </td>
                            <td>
                                {!! LabelHelper::boolLabel($reply->is_admin) !!}
                            </td>
                            <td>
                                {!! $reply->body !!}
                            </td>

                            <td>
                                {{ $reply->created_at }}
                            </td>
                            <td>
                                <form action="{{ route('admin.replies.destroy', $reply->id) }}"
                                      method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');"
                                      style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.delete') }}">
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
