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

        <div id="{{ $name }}-list">
            @foreach($values as $value)
                @if($name === 'phones')
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input name="{{ $name }}[title][{{ $value->id }}]" value="{{ $value->title }}" class="form-control" type="text" placeholder="{{ $placeholderFirst ?? '' }}" />
                        </div>
                        <input type="hidden" name="{{ $name }}[type][{{ $value->id }}]" value="{{ $value->type }}">
                    </div>
                @else
                    <div class="row" style="margin-top: 15px;">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input name="{{ $name }}[url][{{ $value->id }}]" value="{{ $value->url }}" class="form-control" type="text" placeholder="{{ $placeholderFirst ?? '' }}" />
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input name="{{ $name }}[title][{{ $value->id }}]" value="{{ $value->title }}" class="form-control" type="text" placeholder="{{ $placeholderSecond ?? '' }}" />
                        </div>
                        <input type="hidden" name="{{ $name }}[type][{{ $value->id }}]" value="{{ $value->type }}">
                    </div>
                @endif
            @endforeach
        </div>
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

                } else {
                    renderSmartLink('{{ $name }}', idSelector);
                }
            })
        });
    </script>
@endsection
