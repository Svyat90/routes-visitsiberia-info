<div class="form-group col-md-6 col-sm-6 col-xs-6">
    <label class="required" for="{{ $name }}">
        {{ __("cruds.$namespace.fields.$name") }}
    </label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
    >
        @foreach($values as $value)
            <option value="{{ $value }}" {{ $value == old($name, $model->$name) ? 'selected' : '' }}>{{ __("global.$value") }}</option>
        @endforeach
    </select>

    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif

    <span class="help-block">{{ __("cruds.$namespace.fields.{$name}_helper") }}</span>
</div>
