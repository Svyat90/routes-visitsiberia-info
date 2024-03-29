<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="" for="{{ $name }}">
        {{ __("cruds.$namespace.fields.$name") }}
    </label>

    <div
        class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}"
        id="{{ $name }}">
    </div>

    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif

    <span class="help-block">{{ __("cruds.$namespace.fields.{$name}_helper") }}</span>
</div>

@section('scripts')
    @parent
    <script>
        arrDropZones['{{ $name }}' + 'DropZone'] = new Dropzone("#{{ $name }}", {
            url: '{{ route('admin.media.upload') }}',
            maxFilesize: 50, // MB
            maxFiles: 20,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 50
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function (file, response) {
                $('form').append('<input type="hidden" name="{{ $name }}[]" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="{{ $name }}[]"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    let message = response // dropzone sends it's own error messages in string
                } else {
                    let message = response.errors.file
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
