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

                    @foreach($hotel->getFillable() as $field)
                        @if(in_array($field, ['active', 'recommended']))
                            <tr>
                                <th>
                                    {{ __("cruds.hotels.fields.{$field}") }}
                                </th>
                                <td>{!! LabelHelper::boolLabel($hotel->$field) !!}</td>
                            </tr>
                        @elseif($field === 'conditions_payment')
                            <tr>
                                <th>
                                    {{ __("cruds.hotels.fields.{$field}") }}
                                </th>
                                <td>{{ __("global.{$hotel->$field}") }}</td>
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

                    @foreach($socialLinks as $index => $social)
                        <tr>
                            <th>
                                {{ __("cruds.hotels.fields.social_links") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="{{ $social->url }}" target="_blank">{{ $social->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($aggregatorLinks as $index => $aggregator)
                        <tr>
                            <th>
                                {{ __("cruds.hotels.fields.aggregator_links") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="{{ $aggregator->url }}" target="_blank">{{ $aggregator->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($phones as $index => $phone)
                        <tr>
                            <th>
                                {{ __("cruds.hotels.fields.phones") }} #{{ $index + 1 }}
                            </th>
                            <td>{{ $phone->title }}</td>
                        </tr>
                    @endforeach

                    @include('admin.partials.item-action-table-dates', ['model' => $hotel])

                    @include('admin.partials.show-media', ['name' => 'image', 'model' => $hotel, 'namespace' => 'hotels'])
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
                @includeIf('admin.partials.relationships.related-dictionaries', ['namespace' => 'hotels', 'entity_id' => $hotel->id, 'dictionaries' => $hotel->dictionaries])
            </div>
        </div>
    </div>

@endsection

