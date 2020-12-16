@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.show') }} {{ __('cruds.pages.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.pages.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>{{ __("cruds.base.fields.id") }}</th>
                        <td>{{ $page->id }}</td>
                    </tr>
                        @foreach($page->getFillable() as $field)
                            <tr>
                                <th>
                                    {{ __("cruds.pages.fields.{$field}") }}
                                    @if(isTranslable($page, $field)) ({{ app()->getLocale() }}) @endif
                                </th>
                                <td>{!! $page->$field !!}</td>
                            </tr>
                        @endforeach

                        @include('admin.partials.item-action-table-dates', ['model' => $page])

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.pages.index') }}">
                        {{ __('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

