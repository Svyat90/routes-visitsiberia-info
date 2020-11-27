@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.dictionaries.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.dictionaries.update", [$dictionary->id]) }}">
                <input name="type" type="hidden" value="{{ $dictionary->type }}"/>
                @method('PUT')
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
                                                   value="{{ old($name, columnTrans($dictionary, 'name')) }}">
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
                            <option value="0" {{ old('hidden', $dictionary->hidden) === false ? 'selected' : '' }}>false</option>
                            <option value="1" {{ old('hidden', $dictionary->hidden) === true ? 'selected' : '' }}>true</option>
                        </select>
                        @if($errors->has('hidden'))
                            <span class="text-danger">{{ $errors->first('hidden') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.dictionaries.fields.hidden_helper') }}</span>
                    </div>

                    @if($dictionary->parent && $dictionary->parent->type === \App\Services\DictionaryService::TYPE_SEASON)
                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                            <label class="required" for="date_range">{{ trans('cruds.dictionaries.fields.date_range') }}</label>
                            <input
                                class="form-control daterange {{ $errors->has('date_range') ? 'is-invalid' : '' }}"
                                type="text"
                                name="date_range"
                                id="date_range"
                                value="{{ old('date_range', $dictionary->date_range_from  ? $dictionary->date_range_from->format('d/m/Y') . ' - ' . $dictionary->date_range_to->format('d/m/Y') : '') }}"
                            />
                            @if($errors->has('date_range'))
                                <span class="text-danger">{{ $errors->first('date_range') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.dictionaries.fields.date_range_helper') }}</span>
                        </div>
                    @endif

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="dictionary_id">{{ trans('global.parent') }}</label>
                        <select class="form-control {{ $errors->has('roles') ? 'is-invalid' : '' }}"
                                name="dictionary_id"
                                id="dictionary_id">
                            <option value="0">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($dictionaryList as $id => $dictionaryItem)
                                <option value="{{ $id }}" {{ ($id == old('dictionary_id', $dictionary->parent_id)) ? 'selected' : '' }}>{{ $dictionaryItem }}</option>
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
            let dateRangeInput = $('input[name="date_range"]');

            dateRangeInput.daterangepicker({
                autoUpdateInput: false,
                opens: 'left'
            });

            dateRangeInput.on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            dateRangeInput.on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>
@endsection
