@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.events.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}">
                <input name="id" type="hidden" value="{{ $event->id }}"/>
                @method('PUT')
                @csrf

                @include('admin.partials.components.translable.input.update-text', ['field' => 'name', 'namespace' => 'events', 'model' => $event])

{{--                @include('admin.partials.components.multi-select.update', [--}}
{{--                   'label' => __('global.event_near_places_dictionary'),--}}
{{--                   'name' => 'place_ids',--}}
{{--                   'values' => $placeIds,--}}
{{--                   'selectedList' => $dictionaryIds--}}
{{--                ])--}}

                @include('admin.partials.components.multi-select.update', [
                    'label' => __('global.season_dictionary'),
                    'name' => 'dictionary_ids',
                    'values' => $seasonList,
                    'selectedList' => $dictionaryIds
                ])

                @include('admin.partials.components.image.update-single', ['name' => 'image', 'namespace' => 'events', 'model' => $event])
                @include('admin.partials.components.image.update-multiple', ['name' => 'image_gallery', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.translable.textarea.update', ['field' => 'page_desc', 'namespace' => 'events', 'model' => $event])
                @include('admin.partials.components.translable.input.update-text', ['field' => 'history_desc', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.select.bool.update', ['name' => 'have_camping', 'namespace' => 'events', 'model' => $event])
                @include('admin.partials.components.select.bool.update', ['name' => 'active', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.translable.textarea.update', ['field' => 'life_hacks', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.input.update-text', ['name' => 'site_link', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.multi-fields.update', [
                    'label' => __('global.add_address'),
                    'placeholderFirst' => __('global.add_address'),
                    'placeholderSecond' => __('global.add_address'),
                    'name' => 'addresses',
                    'namespace' => 'events',
                    'values' => $addresses
                ])

                @include('admin.partials.components.multi-fields.update', [
                    'label' => __('global.add_phone'),
                    'placeholderFirst' => __('global.input_title'),
                    'placeholderSecond' => __('global.input_phone'),
                    'name' => 'link_phones',
                    'namespace' => 'events',
                    'values' => $socialLinks
                ])

                @include('admin.partials.components.multi-fields.update', [
                    'label' => __('global.add_link'),
                    'placeholderFirst' => __('global.input_title'),
                    'placeholderSecond' => __('global.input_url'),
                    'name' => 'additional_links',
                    'namespace' => 'events',
                    'values' => $additionalLinks
                ])

                @include('admin.partials.components.input.update-text', ['name' => 'lat', 'namespace' => 'events', 'model' => $event])
                @include('admin.partials.components.input.update-text', ['name' => 'lng', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.translable.input.update-text', ['field' => 'location', 'namespace' => 'events', 'model' => $event])

                @include('admin.partials.components.translable.textarea.update', ['field' => 'contact_desc', 'namespace' => 'events', 'model' => $event])

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ __('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
