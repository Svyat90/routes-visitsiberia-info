<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="required" for="{{ $name }}">
        {{ __("cruds.$namespace.fields.$name") }}
    </label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
    >
        @foreach($values as $value)
            <option value="{{ $value }}" {{ $value == old($name) ? 'selected' : '' }}>{{ __("global.$value") }}</option>
        @endforeach
    </select>

    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif

    <span class="help-block">{{ __("cruds.$namespace.fields.{$name}_helper") }}</span>
</div>
