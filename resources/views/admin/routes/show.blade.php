@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.routes.title_singular') }} "{{ $route->name }}"
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.routes.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $route->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.base.fields.slug") }}</th>
                        <td>{{ $route->slug }}</td>
                    </tr>

                    @foreach($route->getFillable() as $field)
                        @if(in_array($field, ['active', 'with_children', 'walking_route', 'available_for_invalids', 'can_by_car']))
                            <tr>
                                <th>
                                    {{ __("cruds.routes.fields.{$field}") }}
                                </th>
                                <td>{!! LabelHelper::boolLabel($route->$field) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>
                                    {{ __("cruds.routes.fields.{$field}") }}
                                    @if(isTranslable($route, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{!! $route->$field !!}</td>
                            </tr>
                        @endif
                    @endforeach

                    @foreach($socialLinks as $index => $social)
                        <tr>
                            <th>
                                {{ __("cruds.places.fields.social_links") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="{{ $social->url }}" target="_blank">{{ $social->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($additionalLinks as $index => $link)
                        <tr>
                            <th>
                                {{ __("cruds.places.fields.additional_links") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($phoneLinks as $index => $phone)
                        <tr>
                            <th>
                                {{ __("cruds.places.fields.link_phones") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="tel:{{ $phone->url }}" target="_blank">{{ $phone->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($addresses as $index => $address)
                        <tr>
                            <th>
                                {{ __("cruds.events.fields.addresses") }} #{{ $index + 1 }}
                            </th>
                            <td>{{ $address->title }}</td>
                        </tr>
                    @endforeach

                    @include('admin.partials.item-action-table-dates', ['model' => $route])

                    @include('admin.partials.show-media', ['name' => 'image', 'model' => $route, 'namespace' => 'routes'])
                    @include('admin.partials.show-media', ['name' => 'image_gallery', 'model' => $route, 'namespace' => 'routes'])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.routes.index') }}">
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
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="#related-places" role="tab" data-toggle="tab">--}}
{{--                    {{ trans('global.places') }}--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="related-dictionaries">
                @includeIf('admin.partials.relationships.related-dictionaries', ['namespace' => 'routes', 'entity_id' => $route->id, 'dictionaries' => $route->dictionaries])
            </div>
        </div>
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane" role="tabpanel" id="related-places">--}}
{{--                @includeIf('admin.partials.relationships.related-places', ['items' => $routableList])--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

@endsection

