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

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'name', 'namespace' => 'meals'])

                    @include('admin.partials.components.multi-select.create', [
                       'label' => __('global.category_food_dictionary'),
                       'name' => 'dictionary_ids',
                       'values' => $categoryList
                   ])

                    @include('admin.partials.components.multi-select.create', [
                        'label' => __('global.season_dictionary'),
                        'name' => 'dictionary_ids',
                        'values' => $seasonList
                    ])

                    @include('admin.partials.components.select.bool.create', ['name' => 'have_breakfasts', 'namespace' => 'meals'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'have_business_lunch', 'namespace' => 'meals'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'delivery_available', 'namespace' => 'meals'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'recommended', 'namespace' => 'meals'])
                    @include('admin.partials.components.select.bool.create', ['name' => 'active', 'namespace' => 'meals'])

                    @include('admin.partials.components.image.create-single', ['name' => 'image', 'namespace' => 'meals'])
                    @include('admin.partials.components.image.create-multiple', ['name' => 'image_gallery', 'namespace' => 'meals'])

                    @include('admin.partials.components.translable.textarea.create', ['field' => 'description', 'namespace' => 'meals'])
                    @include('admin.partials.components.translable.textarea.create', ['field' => 'working_hours', 'namespace' => 'meals'])

                    @include('admin.partials.components.input.create-text', ['name' => 'site_link', 'namespace' => 'meals'])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_link'),
                        'name' => 'aggregator_links',
                        'namespace' => 'meals'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_link'),
                        'name' => 'social_links',
                        'namespace' => 'meals'
                    ])

                    @include('admin.partials.components.multi-fields.create', [
                        'label' => __('global.add_phone'),
                        'name' => 'phones',
                        'namespace' => 'meals'
                    ])

                    @include('admin.partials.components.input.create-text', ['name' => 'lat', 'namespace' => 'meals'])
                    @include('admin.partials.components.input.create-text', ['name' => 'lng', 'namespace' => 'meals'])

                    @include('admin.partials.components.translable.input.create-text', ['field' => 'location', 'namespace' => 'meals'])

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
