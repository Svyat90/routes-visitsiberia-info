@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.create') }} {{ __('cruds.places.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.places.store") }}">
                @csrf
                <div class="row">
                    @include('admin.partials.components.translable.input.create-text', ['field' => 'name', 'namespace' => 'places'])

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

                    @include('admin.partials.components.select.bool.create', ['name' => 'with_children', 'namespace' => 'places'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'active', 'namespace' => 'places'])

                    @include('admin.partials.components.image.create-single', ['name' => 'image', 'namespace' => 'places'])
                    @include('admin.partials.components.image.create-multiple', ['name' => 'image_gallery', 'namespace' => 'places'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'page_desc', 'namespace' => 'places'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'history_desc', 'namespace' => 'places'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'life_hacks', 'namespace' => 'places'])

                    @include('admin.partials.components.input.create-text', ['name' => 'site_link', 'namespace' => 'places'])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_link'),
                        'name' => 'social_links',
                        'namespace' => 'places'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_phone'),
                        'name' => 'link_phones',
                        'namespace' => 'places'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                      'label' => __('global.add_link'),
                      'name' => 'additional_links',
                      'namespace' => 'places'
                    ])

                    @include('admin.partials.components.input.create-text', ['name' => 'lat', 'namespace' => 'places'])
                    @include('admin.partials.components.input.create-text', ['name' => 'lng', 'namespace' => 'places'])

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'location', 'namespace' => 'places'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'contact_desc', 'namespace' => 'places'])

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

@section('scripts')
@endsection
