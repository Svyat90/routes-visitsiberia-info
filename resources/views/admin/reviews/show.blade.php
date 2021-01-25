@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.reviews.title_singular') }} "{{ $review->name }}"
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $review->id }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.name") }}</th>
                        <td>{{ $review->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.phone") }}</th>
                        <td>{{ $review->phone }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.email") }}</th>
                        <td>{{ $review->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.rating") }}</th>
                        <td>{{ $review->rating }}/5</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.approved") }}</th>
                        <td>{!! LabelHelper::boolLabel($review->approved) !!}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.allow_comments") }}</th>
                        <td>{!! LabelHelper::boolLabel($review->allow_comments) !!}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.object") }}</th>
                        <td>{{ $review->reviewrateable_type }}</td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.object_id") }}</th>
                        @php
                            $namespace = strtolower(Str::plural(collect(explode("\\", $review->reviewrateable_type))->last()))
                        @endphp
                        <td><a href="{{ route('admin.' . $namespace . '.show', $review->reviewrateable_id) }}" >#{{ $review->reviewrateable_id }}</a></td>
                    </tr>
                    <tr>
                        <th>{{ __("cruds.reviews.fields.body") }}</th>
                        <td>{!! $review->body !!}</td>
                    </tr>

                    @include('admin.partials.item-action-table-dates', ['model' => $review])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.reviews.index') }}">
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
                <a class="nav-link" href="#related-replies" role="tab" data-toggle="tab">
                    {{ trans('cruds.replies.title') }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="related-replies">
                @includeIf('admin.partials.relationships.related-replies', ['replies' => $review->replies])
            </div>
        </div>
    </div>

@endsection

