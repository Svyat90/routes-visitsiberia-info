@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.routes.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.routes.update", [$route->id]) }}">
                <input name="id" type="hidden" value="{{ $route->id }}"/>
                @method('PUT')
                @csrf

                <div class="row">

                    @include('admin.partials.components.translable.input.update-text', ['field' => 'name', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.multi-select.update', [
                       'label' => __('global.category_place_dictionary'),
                       'name' => 'dictionary_ids',
                       'values' => $placeList,
                       'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.type_rest_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $typesList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.whom_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $whomList,
                        'selectedList' => $dictionaryIds
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
                                <option value="{{ $id }}" {{ in_array($id, old($name, $routableIds)) ? 'selected' : '' }}>{{ $routable }}</option>
                            @endforeach
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                    </div>

                    @include('admin.partials.components.select.bool.update', ['name' => 'with_children', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.select.bool.update', ['name' => 'walking_route', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.select.bool.update', ['name' => 'available_for_invalids', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.select.bool.update', ['name' => 'can_by_car', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.select.bool.update', ['name' => 'active', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.image.update-single', ['name' => 'image', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.image.update-multiple', ['name' => 'image_gallery', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.translable.textarea.update', ['field' => 'page_desc', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'history_desc', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'features_desc', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'list_points', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'statistic_info_desc', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'life_hacks', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'what_take', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'more_info', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.input.update-text', ['name' => 'site_link', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_link'),
                        'placeholderFirst' => __('global.input_title'),
                        'placeholderSecond' => __('global.input_url'),
                        'name' => 'social_links',
                        'namespace' => 'routes',
                        'values' => $socialLinks
                    ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_address'),
                        'placeholderFirst' => __('global.add_address'),
                        'placeholderSecond' => __('global.add_address'),
                        'name' => 'addresses',
                        'namespace' => 'routes',
                        'values' => $addresses
                    ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_phone'),
                        'placeholderFirst' => __('global.input_title'),
                        'placeholderSecond' => __('global.input_phone'),
                        'name' => 'link_phones',
                        'namespace' => 'routes',
                        'values' => $linkPhones
                    ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_link'),
                        'placeholderFirst' => __('global.input_title'),
                        'placeholderSecond' => __('global.input_url'),
                        'name' => 'additional_links',
                        'namespace' => 'routes',
                        'values' => $additionalLinks
                    ])

                    @include('admin.partials.components.input.update-text', ['name' => 'email', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.input.update-text', ['name' => 'lat', 'namespace' => 'routes', 'model' => $route])
                    @include('admin.partials.components.input.update-text', ['name' => 'lng', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.translable.input.update-text', ['field' => 'location', 'namespace' => 'routes', 'model' => $route])

                    @include('admin.partials.components.translable.textarea.update', ['field' => 'contact_desc', 'namespace' => 'routes', 'model' => $route])
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
