@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.create') }} {{ __('cruds.events.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.events.store") }}">
                @csrf
                <div class="row">

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'name', 'namespace' => 'events'])

{{--                    @include('admin.partials.components.multi-select.create', [--}}
{{--                       'label' => __('global.event_near_places_dictionary'),--}}
{{--                       'name' => 'place_ids',--}}
{{--                       'values' => $placeIds--}}
{{--                    ])--}}

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList
                    ])

                    @include('admin.partials.components.image.create-single', ['name' => 'image', 'namespace' => 'events'])
                    @include('admin.partials.components.image.create-multiple', ['name' => 'image_gallery', 'namespace' => 'events'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'page_desc', 'namespace' => 'events'])
                    @include('admin.partials.components.translable.input.create-text', ['field' => 'history_desc', 'namespace' => 'events'])

                    @include('admin.partials.components.select.bool.create', ['name' => 'have_camping', 'namespace' => 'events'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'active', 'namespace' => 'events'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'life_hacks', 'namespace' => 'events'])

                    @include('admin.partials.components.input.create-text', ['name' => 'site_link', 'namespace' => 'events'])

                    @include('admin.partials.components.multi-fields.create', [
                      'label' => __('global.add_address'),
                      'name' => 'addresses',
                      'namespace' => 'events'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_phone'),
                        'name' => 'link_phones',
                        'namespace' => 'events'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                      'label' => __('global.add_link'),
                      'name' => 'additional_links',
                      'namespace' => 'events'
                    ])

                    @include('admin.partials.components.input.create-text', ['name' => 'lat', 'namespace' => 'events'])
                    @include('admin.partials.components.input.create-text', ['name' => 'lng', 'namespace' => 'events'])

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'location', 'namespace' => 'events'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'contact_desc', 'namespace' => 'events'])

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
