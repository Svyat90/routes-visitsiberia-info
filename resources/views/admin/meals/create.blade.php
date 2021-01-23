@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('global.create') }} {{ __('cruds.meals.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.meals.store") }}">
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
                                        @foreach($meal->getTranslatable() as $field)
                                            @php $oldLocale = old($field); @endphp

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                    @if (in_array($field, ['page_desc', 'helpful_info', 'history_desc', 'contact_desc']))
                                                        <div class="form-group">
                                                            <label for="{{ $name = $field . '[' . $language->locale . ']' }}">
                                                                {{ __("cruds.meals.fields.$field") }}
                                                            </label>
                                                            <textarea class="form-control tinymceTextarea {{ $errors->has($name) ? 'is-invalid' : '' }}"
                                                                      name="{{ $name }}" id="{{ $name }}">{!! $oldLocale[$language->locale] ?? "" !!}</textarea>
                                                            @if($errors->has($name))
                                                                <span class="text-danger">{{ $errors->first($name) }}</span>
                                                            @endif
                                                            <span class="help-block">{{ __("cruds.meals.fields.{$field}_helper") }}</span>
                                                        </div>
                                                    @else
                                                        <label class="" for="{{ $name = $field . '[' . $language->locale . ']' }}">
                                                            {{ __('cruds.meals.fields.' . $field) }}
                                                        </label>
                                                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                                                               type="text"
                                                               name="{{ $name }}"
                                                               id="{{ $name }}"
                                                               value="{{ $oldLocale[$language->locale] ?? "" }}" />
                                                        @if($errors->has($name))
                                                            <span class="text-danger">{{ $errors->first($name) }}</span>
                                                        @endif
                                                        <span
                                                            class="help-block">{{ __("cruds.meals.fields.{$field}_helper") }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'active' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="0" {{ old($name, null) == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
                            <option value="1" {{ old($name, null) == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'recommended' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="0" {{ old($name, null) == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
                            <option value="1" {{ old($name, null) == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'have_breakfasts' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="0" {{ old($name, '') == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
                            <option value="1" {{ old($name, '') == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'have_business_lunch' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="0" {{ old($name, '') == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
                            <option value="1" {{ old($name, '') == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'delivery_available' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="0" {{ old($name, '') == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
                            <option value="1" {{ old($name, '') == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'cost' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-control">
                            <option value="$" {{ old($name, '') == "$" ? 'selected' : '' }}>$</option>
                            <option value="$$" {{ old($name, '') == "$$" ? 'selected' : '' }}>$$</option>
                            <option value="$$$" {{ old($name, '') == "$$$" ? 'selected' : '' }}>$$$</option>
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'lat' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, '') }}" />
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="required" for="{{ $name = 'lng' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, '') }}" />
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="" for="{{ $name = 'site_link' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, '') }}" />
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="" for="{{ $name = 'social_links' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, '') }}" />
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="" for="{{ $name = 'aggregator_links' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, '') }}" />
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                        <label class="" for="{{ $name = 'phones' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ old($name, '') }}" />
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = 'dictionary_ids' }}">{{ __('global.dictionaries') }}</label>
                        <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                              style="border-radius: 0">{{ __('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                  style="border-radius: 0">{{ __('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has($name) ? 'is-invalid' : '' }}"
                                name="{{ $name }}[]"
                                id="{{ $name }}" multiple >
                            @foreach($dictionaryChildren as $id => $dictionary)
                                <option value="{{ $id }}" {{ in_array($id, old($name, [])) ? 'selected' : '' }}>{{ $dictionary }}</option>
                            @endforeach
                        </select>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="required" for="{{ $name = 'image' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="{{ $name }}">
                        </div>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = 'image_history' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <div class="needsclick dropzone {{ $errors->has($name) ? 'is-invalid' : '' }}" id="{{ $name }}">
                        </div>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
                    </div>

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = 'image_gallery' }}">{{ __("cruds.meals.fields.$name") }}</label>
                        <div class="needsclick dropzone {{ $errors->has($name) ? 'is-invalid' : '' }}" id="{{ $name }}">
                        </div>
                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif
                        <span class="help-block">{{ __("cruds.meals.fields.{$name}_helper") }}</span>
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
    <script>
        $(function () {
            $('#datetimepicker').datetimepicker({
                minDate: moment().startOf('minute').add(180, 'm'),
            });
        });

        let imageDropZone = new Dropzone("#image", {
            url: '{{ route('admin.media.upload') }}',
            maxFilesize: 50, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 50
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function (file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        })

        let imageHistoryDropZone = new Dropzone("#image_history", {
            url: '{{ route('admin.media.upload') }}',
            maxFilesize: 50, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 50
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function (file, response) {
                $('form').find('input[name="image_history"]').remove()
                $('form').append('<input type="hidden" name="image_history" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image_history"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        })

        let imageGalleryDropZone = new Dropzone("#image_gallery", {
            url: '{{ route('admin.media.upload') }}',
            maxFilesize: 50, // MB
            maxFiles: 10,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 50
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function (file, response) {
                $('form').find('input[name="image_gallery"]').remove()
                $('form').append('<input type="hidden" name="image_gallery[]" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="file"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response // dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        })

    </script>
@endsection
