<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="" for="{{ $name }}">
        {{ $label }}
    </label>

    <div style="padding-bottom: 4px">
        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ __('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ __('global.deselect_all') }}</span>
    </div>

    <select
        class="form-control select2 {{ $errors->has($name) ? 'is-invalid' : '' }}"
        name="{{ $name }}[]"
        id="{{ $name }}"
        multiple
    >

        @foreach($values as $value)
            <option value="{{ $value->id }}" {{ in_array($value->id, old($name, $selectedList)) ? 'selected' : '' }}>
                {{ $value->name }}
            </option>
        @endforeach

    </select>

    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>
