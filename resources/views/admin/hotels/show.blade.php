@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.hotels.title_singular') }} "{{ $hotel->name }}"
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.hotels.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $hotel->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.base.fields.slug") }}</th>
                        <td>{{ $hotel->slug }}</td>
                    </tr>

                    @foreach($hotel->getFillable() as $field)
                        @if(in_array($field, ['active', 'recommended', 'delivery_available', 'have_business_lunch', 'have_breakfasts']))
                            <tr>
                                <th>
                                    {{ __("cruds.hotels.fields.{$field}") }}
                                </th>
                                <td>{!! LabelHelper::boolLabel($hotel->$field) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>
                                    {{ __("cruds.hotels.fields.{$field}") }}
                                    @if(isTranslable($hotel, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{!! $hotel->$field !!}</td>
                            </tr>
                        @endif
                    @endforeach

                    @include('admin.partials.item-action-table-dates', ['model' => $hotel])

                    @include('admin.partials.show-media', ['name' => 'image', 'model' => $hotel, 'namespace' => 'hotels'])
                    @include('admin.partials.show-media', ['name' => 'image_history', 'model' => $hotel, 'namespace' => 'hotels'])
                    @include('admin.partials.show-media', ['name' => 'image_gallery', 'model' => $hotel, 'namespace' => 'hotels'])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.hotels.index') }}">
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
{{--                @includeIf('admin.partials.relationships.related-categories', ['categories' => $hotel->categories])--}}
            </div>
        </div>
    </div>

@endsection

