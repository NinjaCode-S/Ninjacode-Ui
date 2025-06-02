@props([
    'id' => generateId(),
    'show' => false,
    'horizontal' => false,
    'class' => '',
])

<div @class(['collapse', 'collapse-horizontal' => $horizontal, $class]) id="{{ $id }}" {{ $attributes }}>
       {{ $slot }}
</div>
