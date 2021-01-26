@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.meals.title_singular') }} "{{ $meal->name }}"
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.meals.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $meal->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.base.fields.slug") }}</th>
                        <td>{{ $meal->slug }}</td>
                    </tr>

                    @foreach($meal->getFillable() as $field)
                        @if (in_array($field, ['active', 'recommended', 'have_breakfasts', 'have_business_lunch', 'delivery_available']))
                            <tr>
                                <th>
                                    {{ __("cruds.meals.fields.{$field}") }}
                                </th>
                                <td>{!! LabelHelper::boolLabel($meal->$field) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>
                                    {{ __("cruds.meals.fields.{$field}") }}
                                    @if(isTranslable($meal, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{!! $meal->$field !!}</td>
                            </tr>
                        @endif
                    @endforeach

                    @include('admin.partials.item-action-table-dates', ['model' => $meal])

                    @include('admin.partials.show-media', ['name' => 'image', 'model' => $meal, 'namespace' => 'meals'])
                    @include('admin.partials.show-media', ['name' => 'image_history', 'model' => $meal, 'namespace' => 'meals'])
                    @include('admin.partials.show-media', ['name' => 'image_gallery', 'model' => $meal, 'namespace' => 'meals'])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.meals.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            {{ trans('global.relatedData') }}
        </div>
        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
            <li class="nav-item">
                <a class="nav-link" href="#related-dictionaries" role="tab" data-toggle="tab">
                    {{ trans('global.dictionaries') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="related-dictionaries">
                @includeIf('admin.partials.relationships.related-dictionaries', ['namespace' => 'meals', 'entity_id' => $meal->id, 'dictionaries' => $meal->dictionaries])
            </div>
        </div>
    </div>

@endsection

