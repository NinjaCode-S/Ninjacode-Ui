@props([
    'fluid' => false,
    'size' => null
])
@switch(@$framework)
    @case('uikit')
        @switch($size)
            @case('sm') @php($size = 'small') @break
            @case('md') @php($size = 'medium') @break
            @case('lg') @php($size = 'large') @break
        @endswitch
        @php($cls['container'] = $size ? 'uk-container uk-container-'  . $size :'uk-container')
        @break
    @default
        @php($cls['container'] = $size ? 'container-' . $size : 'container')
        @break
@endswitch
<div @class([$cls['container'], @$attributes['class']]) {{ $attributes }}>
    {{$slot}}
</div>

