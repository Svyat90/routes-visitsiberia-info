@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('global.translations') }}
        </div>

        <div class="card-body">
            @foreach($files as $key => $file)
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="heading-{{ $key }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                    {{ $file->name }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse-{{ $key }}" class="collapse" aria-labelledby="heading-{{ $key }}" data-parent="#accordion">
                            <div class="card-body">
                                <form method="POST" name="{{ $file->name }}" action="{{ route("admin.translations.update") }}?path={{ $file->path }}" >
                                    <input name="path" value="{{ $file->path }}" type="hidden"/>
                                    @method('PUT')
                                    @csrf

                                    {!! \App\Helpers\LanguageHtmlHelper::renderTranslates($file->content) !!}

                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
