@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.hotels.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.hotels.update", [$hotel->id]) }}">
                <input name="id" type="hidden" value="{{ $hotel->id }}"/>
                @method('PUT')
                @csrf

                <div class="row">

                    @include('admin.partials.components.translable.input.update-text', ['field' => 'name', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.placement_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $placementList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.whom_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $whomList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.select.bool.update', ['name' => 'recommended', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.select.bool.update', ['name' => 'active', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.image.update-single', ['name' => 'image', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.image.update-multiple', ['name' => 'image_gallery', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.translable.textarea.update', ['field' => 'description', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'conditions_accommodation', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'rooms_fund', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'additional_services', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.select.bool.update', ['name' => 'have_food_point', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.select.list.update', [
                        'name' => 'conditions_payment',
                        'namespace' => 'hotels',
                        'values' => $conditionList,
                        'model' => $hotel
                    ])

                    @include('admin.partials.components.input.update-text', ['name' => 'site_link', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.multi-fields.update', [
                       'label' => __('global.add_link'),
                       'placeholderFirst' => __('global.input_title'),
                       'placeholderSecond' => __('global.input_url'),
                       'name' => 'aggregator_links',
                       'namespace' => 'hotels',
                       'values' => $socialLinks
                   ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_link'),
                        'placeholderFirst' => __('global.input_title'),
                        'placeholderSecond' => __('global.input_url'),
                        'name' => 'social_links',
                        'namespace' => 'hotels',
                        'values' => $aggregatorLinks
                    ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_phone'),
                        'placeholderFirst' => __('global.input_phone'),
                        'name' => 'phones',
                        'namespace' => 'hotels',
                        'values' => $phones
                    ])

                    @include('admin.partials.components.input.update-text', ['name' => 'lat', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.input.update-text', ['name' => 'lng', 'namespace' => 'hotels', 'model' => $hotel])

                    @include('admin.partials.components.translable.input.update-text', ['field' => 'location', 'namespace' => 'hotels', 'model' => $hotel])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'contact_desc', 'namespace' => 'hotels', 'model' => $hotel])
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
