@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.languages.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.languages.update", [$language->id]) }}">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="required" for="active">{{ trans('cruds.languages.fields.active') }}</label>
                        <select name="active" id="active" class="form-control">
                            <option value="0" {{ old('active', $language->active) === false ? 'selected' : '' }}>false</option>
                            <option value="1" {{ old('active', $language->active) === true ? 'selected' : '' }}>true</option>
                        </select>
                        @if($errors->has('active'))
                            <span class="text-danger">{{ $errors->first('active') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.languages.fields.active_helper') }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
