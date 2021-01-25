@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            @php
            $uriData = explode("?", request()->getRequestUri());
            $reviewId = end($uriData);
            @endphp
            {{ __('global.create') }} {{ __('cruds.replies.title_singular') }} #{{ $reviewId }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.replies.store") }}">
                <input name="review_id" type="hidden" value="{{ $reviewId }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label for="{{ $field = 'body' }}">
                            {{ __("cruds.replies.fields.$field") }}
                        </label>
                       <textarea
                           class="form-control {{ $errors->has($field) ? 'is-invalid' : '' }}"
                           name="{{ $field }}"
                           rows="5"
                           cols="25" >{!! old($field, '') !!}</textarea>
                    </div>
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
