@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.dictionaries.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.dictionaries.store") }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}"
                                       href="#{{ $language->locale }}" role="tab" data-toggle="tab">
                                        {{ $language->locale }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach($languages as $language)
                                <div class="tab-pane {{ $loop->index === 0 ? 'show active' : '' }}" role="tabpanel"
                                     id="{{ $language->locale }}">
                                    <div class="m-3">
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="" for="{{ $name = 'name[' . $language->locale . ']' }}">
                                                {{ trans('cruds.dictionaries.fields.name') }}
                                            </label>
                                            <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                                                   type="text"
                                                   name={{ $name }}"
                                                   id={{ $name }}"
                                                   value="{{ old($name, '') }}">
                                            @if($errors->has($name))
                                                <span class="text-danger">{{ $errors->first($name) }}</span>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.dictionaries.fields.name_helper') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="required" for="hidden">{{ trans('cruds.dictionaries.fields.hidden') }}</label>
                        <select name="hidden" id="hidden" class="form-control">
                            <option value="0" {{ old('hidden', null) === "0" ? 'selected' : '' }}>false</option>
                            <option value="1" {{ old('hidden', null) === "1" ? 'selected' : '' }}>true</option>
                        </select>
                        @if($errors->has('hidden'))
                            <span class="text-danger">{{ $errors->first('hidden') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.dictionaries.fields.hidden_helper') }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="dictionary_id">{{ trans('global.parent') }}</label>
                        <select name="dictionary_id" id="dictionary_id"
                                class="form-control {{ $errors->has('dictionary_id') ? 'is-invalid' : '' }}">
                            <option value="0">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($dictionaryList as $id => $dictionary)
                                <option
                                    value="{{ $id }}" {{ $id === old('dictionary_id') ? 'selected' : '' }}>{{ $dictionary }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('dictionary_id'))
                            <span class="text-danger">{{ $errors->first('dictionary_id') }}</span>
                        @endif
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
