@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('global.edit') }} {{ __('cruds.meals.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.meals.update", [$meal->id]) }}">
                <input name="id" type="hidden" value="{{ $meal->id }}"/>
                @method('PUT')
                @csrf

                <div class="row">
                    @include('admin.partials.components.translable.input.update-text', ['field' => 'name', 'namespace' => 'meals', 'model' => $meal])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.category_food_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $categoryList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.multi-select.update', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList,
                        'selectedList' => $dictionaryIds
                    ])

                    @include('admin.partials.components.select.bool.update', ['name' => 'have_breakfasts', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.select.bool.update', ['name' => 'have_business_lunch', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.select.bool.update', ['name' => 'delivery_available', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.select.bool.update', ['name' => 'recommended', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.select.bool.update', ['name' => 'active', 'namespace' => 'meals', 'model' => $meal])

                    @include('admin.partials.components.image.update-single', ['name' => 'image', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.image.update-multiple', ['name' => 'image_gallery', 'namespace' => 'meals', 'model' => $meal])

                    @include('admin.partials.components.translable.textarea.update', ['field' => 'description', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.translable.textarea.update', ['field' => 'working_hours', 'namespace' => 'meals', 'model' => $meal])

                    @include('admin.partials.components.input.update-text', ['name' => 'site_link', 'namespace' => 'meals', 'model' => $meal])

                    @include('admin.partials.components.multi-fields.update', [
                       'label' => __('global.add_link'),
                       'placeholderFirst' => __('global.input_title'),
                       'placeholderSecond' => __('global.input_url'),
                       'name' => 'aggregator_links',
                       'namespace' => 'meals',
                       'values' => $socialLinks
                   ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_link'),
                        'placeholderFirst' => __('global.input_title'),
                        'placeholderSecond' => __('global.input_url'),
                        'name' => 'social_links',
                        'namespace' => 'meals',
                        'values' => $aggregatorLinks
                    ])

                    @include('admin.partials.components.multi-fields.update', [
                        'label' => __('global.add_phone'),
                        'placeholderFirst' => __('global.input_phone'),
                        'name' => 'phones',
                        'namespace' => 'meals',
                        'values' => $phones
                    ])

                    @include('admin.partials.components.input.update-text', ['name' => 'lat', 'namespace' => 'meals', 'model' => $meal])
                    @include('admin.partials.components.input.update-text', ['name' => 'lng', 'namespace' => 'meals', 'model' => $meal])

                    @include('admin.partials.components.translable.input.update-text', ['field' => 'location', 'namespace' => 'meals', 'model' => $meal])
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
                @php $media = $meal->getFirstMedia($name = 'image'); @endphp
                @if($media)
                    var file = {!! json_encode($media) !!}
                        this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $media->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="{{ $name }}" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
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
                @php $media = $meal->getFirstMedia($name = 'image_history'); @endphp
                @if($media)
                    var file = {!! json_encode($media) !!}
                        this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, '{{ $media->getUrl('thumb') }}')
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="{{ $name }}" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
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
                    $('form').find('input[id="image_gallery_' + file.id + '"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @php $mediaList = $meal->getMedia('image_gallery'); @endphp
                @if($mediaList)
                    @foreach($mediaList as $media)
                        var file = {!! json_encode($media) !!}
                            this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, '{{ $media->getUrl('thumb') }}')
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" id="image_gallery_{{ $media->id }}" name="image_gallery[]" value="' + file.file_name + '">')
                        this.options.maxFiles = this.options.maxFiles - 1
                    @endforeach
                @endif
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
