@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.dictionaries.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.dictionaries.update", [$dictionary->id]) }}">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="required" for="name_ru">{{ trans('cruds.dictionaries.fields.name') }} (ru)</label>
                        <input class="form-control {{ $errors->has('name_ru') ? 'is-invalid' : '' }}" type="text"
                               name="name_ru"
                               id="name_ru" value="{{ old('name_ru', $dictionary->name_ru) }}">
                        @if($errors->has('name_ru'))
                            <span class="text-danger">{{ $errors->first('name_ru') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.dictionaries.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="name_en">{{ trans('cruds.dictionaries.fields.name') }} (en)</label>
                        <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text"
                               name="name_en"
                               id="name_en" value="{{ old('name_en', $dictionary->name_en) }}">
                        @if($errors->has('name_en'))
                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.dictionaries.fields.name_helper') }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="required" for="hidden">{{ trans('cruds.dictionaries.fields.hidden') }}</label>
                        <select name="hidden" id="hidden" class="form-control">
                            <option value="0" {{ old('hidden', $dictionary->hidden) === false ? 'selected' : '' }}>false</option>
                            <option value="1" {{ old('hidden', $dictionary->hidden) === true ? 'selected' : '' }}>true</option>
                        </select>
                        @if($errors->has('hidden'))
                            <span class="text-danger">{{ $errors->first('hidden') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.dictionaries.fields.hidden_helper') }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="dictionary_id">{{ trans('global.parent') }}</label>
                        <select class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                                name="dictionary_id"
                                id="dictionary_id">
                            <option value="0">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($dictionaryList as $id => $dictionaryItem)
                                <option value="{{ $id }}" {{ $id === old('dictionary_id', $dictionary->parent_id) ? 'selected' : '' }}>{{ $dictionaryItem }}</option>
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

@section('scripts')
    <script>
        $(function () {
            $('#datetimepicker').datetimepicker({
                minDate: moment().startOf('minute').add(180, 'm'),
            });
        });
    </script>
@endsection
