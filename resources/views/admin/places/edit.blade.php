@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.places.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.places.update", [$place->id]) }}">
                <input name="id" type="hidden" value="{{ $place->id }}"/>
                @method('PUT')
                @csrf

                @include('admin.partials.components.translable.input.create-text', ['field' => 'name', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.multi-select.create', [
                   'label' => __('global.category_place_dictionary'),
                   'name' => 'dictionary_ids',
                   'values' => $placeList,
                   'selectedList' => $dictionaryIds
                ])

                @include('admin.partials.components.multi-select.create', [
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

                @include('admin.partials.components.select.bool.update', ['name' => 'with_children', 'namespace' => 'places', 'model' => $place])
                @include('admin.partials.components.select.bool.update', ['name' => 'active', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.image.update-single', ['name' => 'image', 'namespace' => 'places', 'model' => $place])
                @include('admin.partials.components.image.update-multiple', ['name' => 'image_gallery', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.translable.textarea.update', ['field' => 'page_desc', 'namespace' => 'places', 'model' => $place])
                @include('admin.partials.components.translable.textarea.update', ['field' => 'history_desc', 'namespace' => 'places', 'model' => $place])
                @include('admin.partials.components.translable.textarea.update', ['field' => 'life_hacks', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.input.update-text', ['name' => 'site_link', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.multi-fields.update', [
                    'label' => __('global.add_link'),
                    'placeholderFirst' => __('global.input_title'),
                    'placeholderSecond' => __('global.input_url'),
                    'name' => 'social_links',
                    'namespace' => 'places',
                    'values' => $socialLinks
                ])

                @include('admin.partials.components.multi-fields.update', [
                    'label' => __('global.add_phone'),
                    'placeholderFirst' => __('global.input_title'),
                    'placeholderSecond' => __('global.input_phone'),
                    'name' => 'link_phones',
                    'namespace' => 'places',
                    'values' => $linkPhones
                ])

                @include('admin.partials.components.multi-fields.update', [
                    'label' => __('global.add_link'),
                    'placeholderFirst' => __('global.input_title'),
                    'placeholderSecond' => __('global.input_url'),
                    'name' => 'additional_links',
                    'namespace' => 'places',
                    'values' => $additionalLinks
                ])

                @include('admin.partials.components.input.update-text', ['name' => 'lat', 'namespace' => 'places', 'model' => $place])
                @include('admin.partials.components.input.update-text', ['name' => 'lng', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.translable.input.update-text', ['field' => 'location', 'namespace' => 'places', 'model' => $place])

                @include('admin.partials.components.translable.textarea.update', ['field' => 'contact_desc', 'namespace' => 'places', 'model' => $place])

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ __('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
