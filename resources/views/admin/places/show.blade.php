@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.places.title_singular') }} "{{ $place->name }}"
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.places.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $place->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.base.fields.slug") }}</th>
                        <td>{{ $place->slug }}</td>
                    </tr>

                    @foreach($place->getFillable() as $field)
                        @if($field === 'active')
                            <tr>
                                <th>
                                    {{ __("cruds.places.fields.{$field}") }}
                                </th>
                                <td>{!! LabelHelper::boolLabel($place->$field) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>
                                    {{ __("cruds.places.fields.{$field}") }}
                                    @if(isTranslable($place, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{!! $place->$field !!}</td>
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

                    @include('admin.partials.item-action-table-dates', ['model' => $place])

                    @include('admin.partials.show-media', ['name' => 'image', 'model' => $place, 'namespace' => 'places'])
                    @include('admin.partials.show-media', ['name' => 'image_gallery', 'model' => $place, 'namespace' => 'places'])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.places.index') }}">
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
                @includeIf('admin.partials.relationships.related-dictionaries', ['namespace' => 'places', 'entity_id' => $place->id, 'dictionaries' => $place->dictionaries])
            </div>
        </div>
    </div>

@endsection

