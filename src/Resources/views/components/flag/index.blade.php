@props([
    'lang' => 'ru',
    'label' => null,
    'labelClass' => null,
    'width' => 24,
])

<div class="d-flex align-items-center">
    <x-dynamic-component :component="'flag.'.$lang" :width="$width" {{ $attributes }}/>
    @if($label)
        <div @class([$labelClass ?: 'ms-2 fs-5'])>{{ $label }}</div>
    @endif
</div>
