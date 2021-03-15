@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.create') }} {{ __('cruds.hotels.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.hotels.store") }}">
                @csrf
                <div class="row">

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'name', 'namespace' => 'hotels'])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.placement_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $placementList
                    ])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList
                    ])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.whom_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $whomList
                    ])

                    @include('admin.partials.components.select.bool.create', ['name' => 'recommended', 'namespace' => 'hotels'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'active', 'namespace' => 'hotels'])

                    @include('admin.partials.components.image.create-single', ['name' => 'image', 'namespace' => 'hotels'])
                    @include('admin.partials.components.image.create-multiple', ['name' => 'image_gallery', 'namespace' => 'hotels'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'description', 'namespace' => 'hotels'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'conditions_accommodation', 'namespace' => 'hotels'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'rooms_fund', 'namespace' => 'hotels'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'additional_services', 'namespace' => 'hotels'])

                    @include('admin.partials.components.select.bool.create', ['name' => 'have_food_point', 'namespace' => 'hotels'])

                    @include('admin.partials.components.select.list.create', [
                        'name' => 'conditions_payment',
                        'namespace' => 'hotels',
                        'values' => $conditionList
                    ])

                    @include('admin.partials.components.input.create-text', ['name' => 'site_link', 'namespace' => 'hotels'])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_link'),
                        'name' => 'aggregator_links',
                        'namespace' => 'hotels'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_link'),
                        'name' => 'social_links',
                        'namespace' => 'hotels'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_phone'),
                        'name' => 'phones',
                        'namespace' => 'hotels'
                    ])

                    @include('admin.partials.components.input.create-text', ['name' => 'lat', 'namespace' => 'hotels'])
                    @include('admin.partials.components.input.create-text', ['name' => 'lng', 'namespace' => 'hotels'])

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'location', 'namespace' => 'hotels'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'contact_desc', 'namespace' => 'hotels'])

                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ __('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
