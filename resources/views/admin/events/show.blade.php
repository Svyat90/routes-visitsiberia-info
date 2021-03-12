@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.events.title_singular') }} "{{ $event->name }}"
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $event->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.base.fields.slug") }}</th>
                        <td>{{ $event->slug }}</td>
                    </tr>

                    @foreach($event->getFillable() as $field)
                        @if($field === 'active' || $field === 'have_camping')
                            <tr>
                                <th>
                                    {{ __("cruds.events.fields.{$field}") }}
                                </th>
                                <td>{!! LabelHelper::boolLabel($event->$field) !!}</td>
                            </tr>
                        @else
                            <tr>
                                <th>
                                    {{ __("cruds.events.fields.{$field}") }}
                                    @if(isTranslable($event, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{!! $event->$field !!}</td>
                            </tr>
                        @endif
                    @endforeach

                    @foreach($socialLinks as $index => $social)
                        <tr>
                            <th>
                                {{ __("cruds.events.fields.social_links") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="{{ $social->url }}" target="_blank">{{ $social->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($additionalLinks as $index => $link)
                        <tr>
                            <th>
                                {{ __("cruds.events.fields.additional_links") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($phoneLinks as $index => $phone)
                        <tr>
                            <th>
                                {{ __("cruds.events.fields.link_phones") }} #{{ $index + 1 }}
                            </th>
                            <td><a href="tel:{{ $phone->url }}" target="_blank">{{ $phone->title }}</a></td>
                        </tr>
                    @endforeach

                    @foreach($addresses as $index => $address)
                        <tr>
                            <th>
                                {{ __("cruds.events.fields.addresses") }} #{{ $index + 1 }}
                            </th>
                            <td>{{ $address->title }}</td>
                        </tr>
                    @endforeach

                    @include('admin.partials.item-action-table-dates', ['model' => $event])

                    @include('admin.partials.show-media', ['name' => 'image', 'model' => $event, 'namespace' => 'events'])
                    @include('admin.partials.show-media', ['name' => 'image_gallery', 'model' => $event, 'namespace' => 'events'])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.events.index') }}">
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
                @includeIf('admin.partials.relationships.related-dictionaries', ['namespace' => 'events', 'entity_id' => $event->id, 'dictionaries' => $event->dictionaries])
            </div>
        </div>
    </div>

@endsection

