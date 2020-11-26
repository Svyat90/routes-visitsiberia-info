@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.languages.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.languages.store") }}">
                @csrf

                <div class="row">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="locale">{{ trans('cruds.languages.fields.locale') }}</label>
                        <select name="locale" id="locale" class="form-control {{ $errors->has('locale') ? 'is-invalid' : '' }}">
                            <option value="0">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($locales as $locale)
                                <option value="{{ $locale }}" {{ $locale === old('locale') ? 'selected' : '' }}>{{ $locale }}</option>
                            @endforeach
                        </select>
                        <span class="help-block">Link with all local codes: <a target="_blank" href="https://www.science.co.il/language/Locale-codes.php">https://www.science.co.il/language/Locale-codes.php</a></span>
                        @if($errors->has('locale'))
                            <span class="text-danger">{{ $errors->first('locale') }}</span>
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
