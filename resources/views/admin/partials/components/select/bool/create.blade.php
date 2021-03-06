<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="required" for="{{ $name }}">{{ __("cruds.$namespace.fields.$name") }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control">
        <option value="1" {{ old($name) == "1" ? 'selected' : '' }}>{{ __('global.yes') }}</option>
        <option value="0" {{ old($name) == "0" ? 'selected' : '' }}>{{ __('global.no') }}</option>
    </select>
    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
    <span class="help-block">{{ __("cruds.$namespace.fields.{$name}_helper") }}</span>
</div>
