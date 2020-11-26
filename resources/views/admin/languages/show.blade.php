@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.languages.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.languages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans("cruds.base.fields.id") }}</th>
                        <td>{{ $language->id }}</td>
                    </tr>

                    @foreach($language->getFillable() as $field)
                        @if($field === 'active')
                            <tr>
                                <th>{{ trans("cruds.languages.fields.{$field}") }}</th>
                                <td>{!! \App\Helpers\LabelHelper::boolLabel($language->{$field}) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>{{ trans("cruds.languages.fields.{$field}") }}</th>
                                <td>{{ $language->{$field} }}</td>
                            </tr>
                        @endif
                    @endforeach

                    @include('admin.partials._item_action_table_dates', ['model' => $language])

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.languages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

