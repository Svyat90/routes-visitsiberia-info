<div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label for="{{ $name }}">
        {{ __("cruds.$namespace.fields.$name") }}
    </label>

    <div class="form-group col-md-12 col-sm-12 col-xs-12">
        <button
            class="btn btn-primary dim"
            id="add_{{ $name }}"
            type="button"
        >
            <i class="fa fa-plus"></i>&nbsp;&nbsp;{{ $label }}
        </button>

        <div id="{{ $name }}-list"></div>
    </div>

    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif

    <span class="help-block">{{ __("cruds.$namespace.fields.{$name}_helper") }}</span>
</div>

@section('scripts')
    @parent
    <script>
        $(function () {
            $("#" + 'add_{{ $name }}').on("click", function (e) {
                let idList = '{{ $name }}' + '-list';
                let idSelector = $("#" + idList);

                if ('{{ $name }}' === 'phones') {
                    renderPhone('{{ $name }}', idSelector);

                } else if('{{ $name }}' === 'link_phones') {
                    renderLinkPhone('{{ $name }}', idSelector);

                } else if('{{ $name }}' === 'addresses') {
                    renderAddress('{{ $name }}', idSelector);

                } else {
                    renderSmartLink('{{ $name }}', idSelector);
                }
            })
        });
    </script>
@endsection
