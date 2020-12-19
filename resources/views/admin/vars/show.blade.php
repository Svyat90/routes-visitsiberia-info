@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.vars.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.vars.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ trans("cruds.base.fields.id") }}</th>
                        <td>{{ $var->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans("cruds.vars.fields.key") }}</th>
                        <td>{{ $var->key }}</td>
                    </tr>

                    @foreach($var->getFillable() as $field)
                        <tr>
                            <th>
                                {{ trans("cruds.vars.fields.{$field}") }}
                            </th>
                            <td>{{ $var->{$field} }}</td>
                        </tr>
                    @endforeach

                    @include('admin.partials.item-action-table-dates', ['model' => $var])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.vars.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

