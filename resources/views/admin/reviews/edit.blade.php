@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.reviews.title_singular') }} #{{ $review->id }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.reviews.update", [$review->id]) }}">
                <input name="id" type="hidden" value="{{ $review->id }}"/>
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required"for="{{ $name = 'approved' }}">{{ __("cruds.reviews.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="0" {{ old($name, $review->$name) == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
                            <option value="1" {{ old($name, $review->$name) == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.reviews.fields.{$name}_helper") }}</span>
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
