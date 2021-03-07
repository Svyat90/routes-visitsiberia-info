<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        @foreach($languages as $language)
            <li class="nav-item">
                <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}"
                   href="#{{ $language->locale . '-' . $field }}" role="tab" data-toggle="tab">
                    {{ $language->locale }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach($languages as $language)
            <div
                class="tab-pane {{ $loop->index === 0 ? 'show active' : '' }}"
                role="tabpanel"
                id="{{ $language->locale . '-' . $field }}"
            >
                <div class="m-3">
                    @php
                        $oldLocale = old($field);
                        $oldLocaleVal = $oldLocale[$language->locale] ?? null;
                    @endphp

                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label class="" for="{{ $name = $field . '[' . $language->locale . ']' }}">
                            {{ __("cruds.$namespace.fields.$field") }}
                        </label>

                        <input class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
                               type="text"
                               name="{{ $name }}"
                               id="{{ $name }}"
                               value="{{ $oldLocaleVal ?? $model->getTranslation($field, $language->locale) }}"
                        />

                        @if($errors->has($name))
                            <span class="text-danger">{{ $errors->first($name) }}</span>
                        @endif

                        <span class="help-block">{{ __("cruds.$namespace.fields.{$field}_helper") }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
