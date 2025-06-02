@props([
    'color' => 'primary',
    'class' => null,
])


@switch(@$framework)
    @case('uikit')
        @php($cls['badge'] = 'uk-badge')
        @php($cls['color'] = 'uk-background-' . $color)
        @break
    @default
        @php($cls['badge'] = 'badge')
        @php($cls['color'] = 'text-bg-' . $color)
        @break
@endswitch

<span @class([$cls['badge'], $cls['color'], $class]) {{ $attributes }}>{{ $slot }}</span>
