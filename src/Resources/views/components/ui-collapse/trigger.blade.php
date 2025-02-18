@php($attr = array_to_attributes([
    'data-bs-toggle' => 'collapse',
    'data-bs-target' => $target,
    'aria-expanded' => 'false',
    'aria-controls' => substr($target, 1)
]))

@if(@$button)
    <x-scoped-slot :data="['target' => $target, 'attributes' => $attr]" :slotContent="$button"/>
@else
    <x-ui-btn type="button" data-bs-toggle="collapse" :attributes="$attr">
        {{ $slot }}
    </x-ui-btn>
@endif
