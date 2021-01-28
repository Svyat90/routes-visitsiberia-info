<button class="page-nav__off" id="add-btn">
    <span class="material-icons page-nav__icon-add route-item-add" data-id="{{ $entity->id }}" data-type="route-{{ $namespace }}" >add</span>
</button>
<button class="page-nav__off d-none active" id="added-btn">
    <span class="material-icons page-nav__icon-add route-item-added" data-id="{{ $entity->id }}" data-type="route-{{ $namespace }}" >done</span>
</button>
