@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.create') }} {{ __('cruds.routes.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.routes.store") }}">
                @csrf
                <div class="row">

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'name', 'namespace' => 'routes'])

                    @include('admin.partials.components.multi-select.create', [
                       'label' => __('global.category_place_dictionary'),
                       'name' => 'dictionary_ids',
                       'values' => $placeList
                    ])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList
                    ])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.type_rest_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $typesList
                    ])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.whom_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $whomList
                    ])

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = 'routable_ids' }}">{{ __('global.route') }}</label>
                        <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ __('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                  style="border-radius: 0">{{ __('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has($name) ? 'is-invalid' : '' }}"
                                name="{{ $name }}[]"
                                id="{{ $name }}" multiple >
                            @foreach($routableList as $id => $routable)
                                <option value="{{ $id }}" {{ in_array($id, old($name, [])) ? 'selected' : '' }}>{{ $routable }}</option>
                            @endforeach
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                    </div>

                    @include('admin.partials.components.select.bool.create', ['name' => 'with_children', 'namespace' => 'routes'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'walking_route', 'namespace' => 'routes'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'available_for_invalids', 'namespace' => 'routes'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'can_by_car', 'namespace' => 'routes'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'active', 'namespace' => 'routes'])

                    @include('admin.partials.components.image.create-single', ['name' => 'image', 'namespace' => 'routes'])
                    @include('admin.partials.components.image.create-multiple', ['name' => 'image_gallery', 'namespace' => 'routes'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'page_desc', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'history_desc', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'features_desc', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'list_points', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'statistic_info_desc', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'life_hacks', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'what_take', 'namespace' => 'routes'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'more_info', 'namespace' => 'routes'])

                    @include('admin.partials.components.input.create-text', ['name' => 'site_link', 'namespace' => 'routes'])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_link'),
                        'name' => 'social_links',
                        'namespace' => 'routes'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                      'label' => __('global.add_address'),
                      'name' => 'addresses',
                      'namespace' => 'routes'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_phone'),
                        'name' => 'link_phones',
                        'namespace' => 'routes'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                      'label' => __('global.add_link'),
                      'name' => 'additional_links',
                      'namespace' => 'routes'
                    ])

                    @include('admin.partials.components.input.create-text', ['name' => 'email', 'namespace' => 'routes'])
                    @include('admin.partials.components.input.create-text', ['name' => 'lat', 'namespace' => 'routes'])
                    @include('admin.partials.components.input.create-text', ['name' => 'lng', 'namespace' => 'routes'])

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'location', 'namespace' => 'routes'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'contact_desc', 'namespace' => 'routes'])
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ __('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
