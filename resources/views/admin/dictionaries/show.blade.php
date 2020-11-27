@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dictionaries.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dictionaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>{{ trans("cruds.base.fields.id") }}</th>
                        <td>{{ $dictionary->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans("global.parent") }} ({{ app()->getLocale() }}) </th>
                        <td>
                            @if($dictionary->parent)
                                <a href="{{ route('admin.dictionaries.show', $dictionary->parent->id) }}">{{ columnTrans($dictionary->parent, 'name') }}</a>
                            @endif
                        </td>
                    </tr>

                    @foreach($dictionary->getFillable() as $field)
                        @if($field === 'hidden')
                            <tr>
                                <th>
                                    {{ trans("cruds.dictionaries.fields.{$field}") }}
                                </th>
                                <td>{!! \App\Helpers\LabelHelper::boolLabel($dictionary->{$field}) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>
                                    {{ trans("cruds.dictionaries.fields.{$field}") }}
                                    @if(isTranslable($dictionary, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{{ $dictionary->{$field} }}</td>
                            </tr>
                        @endif
                    @endforeach

                    @include('admin.partials._item_action_table_dates', ['model' => $dictionary])

                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dictionaries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

