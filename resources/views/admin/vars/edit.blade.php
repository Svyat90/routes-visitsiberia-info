@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.vars.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.vars.update", [$var->id]) }}">
                <input name="id" type="hidden" value="{{ $var->id }}"/>
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = 'val_ru' }}">
                            {{ __("cruds.vars.fields.$name") }}
                        </label>
                        <input class="required form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, $var->$name) }}" required>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span
                            class="help-block">{{ __("cruds.vars.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = 'val_en' }}">
                            {{ __("cruds.vars.fields.$name") }}
                        </label>
                        <input class="required form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, $var->$name) }}" required>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span
                            class="help-block">{{ __("cruds.vars.fields.{$name}_helper") }}</span>
                    </div>

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
