<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="" for="{{ $name }}">
        {{ __("cruds.$namespace.fields.$name") }}
    </label>

    <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
           type="text"
           name="{{ $name }}"
           id="{{ $name }}"
           value="{{ old($name, $model->$name) }}" />

    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif

    <span class="help-block">{{ __("cruds.$namespace.fields.{$name}_helper") }}</span>
</div>
