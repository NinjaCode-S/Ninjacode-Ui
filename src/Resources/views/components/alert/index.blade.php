@props([
    'type' => 'primary',
    'dismissible'=> false,
])
@php($attr = array_to_attributes(['data-bs-dismiss' => 'alert', 'aria-label' => 'Close']))


<div @class(['alert', 'alert-' . $type, 'alert-dismissible fade show' => $dismissible, 'd-flex align-items-center' => !!@$icon]) role="alert">
    @if(@$icon)
        {{ @$icon }}
        <div>
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif

    @if($dismissible)
        @if(@$close)
            <x-scoped-slot :data="['type' => $type, 'attributes' => $attr]" :slotContent="$close"/>
        @else
            <button type="button" class="btn-close" {{ $attr }}></button>
        @endif
    @endif
</div>
