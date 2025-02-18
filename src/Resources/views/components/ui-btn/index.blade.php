@props([
    'href' => null,
    'type' => 'submit',
    'class' => null,
    'color' => 'primary',
    'size' => null,
    'active' => false,
])
@switch(@$framework)
    @case('uikit')
        @switch($size)
            @case('sm') @php($size = 'small') @break
            @case('lg') @php($size = 'large') @break
        @endswitch
        @php($cls['btn'] = 'uk-button')
        @php($cls['btn-color'] = 'uk-button-' . $color)
        @php($cls['btn-size'] = $size ? 'uk-button-' . $size : null)
        @php($cls['active'] = $active ? 'uk-active' : null)
        @break
    @default
        @php($cls['btn'] = 'btn')
        @php($cls['btn-color'] = 'btn-' . $color)
        @php($cls['btn-size'] = $size ? 'btn-' . $size : null)
        @php($cls['active'] =  $active ? 'active' : null)
        @break
@endswitch

@php($btnClass = [$cls['btn'], $cls['btn-color'], $cls['btn-size'], $cls['active']])

@if($href)
    <a href="{{ $href }}" @class(array_filter([...$btnClass, $class])) {{$attributes}} @if($active) aria-current="{{ $active }}" @endif >{{ $slot }}</a>
@else
    <button type="{{$type}}" @class(array_filter([...$btnClass, $class])) {{$attributes}} @if($active) aria-current="{{ $active }}" @endif>{{ $slot }}</button>
@endif
