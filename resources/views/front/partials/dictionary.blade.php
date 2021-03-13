@if($dictionary = DictionaryHelper::getFirst($model->dictionaries, $parentType))
    <p class="article__sign-bold">
        {{ ($base ?? false) ? $dictionary->parent->name : __('global.category') }}:
        <span href="#" class="article__link">
            {{ $dictionary->name }}
        </span>
    </p>
@endif
