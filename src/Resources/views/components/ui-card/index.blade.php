@props([
    'body' => true,
    'headerCls' => '',
    'bodyCls' => '',
    'color' => null,
])
@switch(@$framework)
  @case('uikit')
    @php($cls['card'] = 'uk-card')
    @php($cls['color'] = $color ? 'uk-card-' . ($color ?? 'default') : null)
    @php($cls['card-header'] = 'uk-card-header')
    @php($cls['card-body'] = 'uk-card-body')
    @php($cls['card-footer'] = 'uk-card-footer')
    @break
  @default
    @php($cls['card'] = 'card')
    @php($cls['color'] = $color ? 'text-bg-' . ($color ?? 'primary') : null)
    @php($cls['card-header'] = 'card-header')
    @php($cls['card-body'] = 'card-body')
    @php($cls['card-footer'] = 'card-footer')
    @break
@endswitch

<div @class([$cls['card'], $cls['color'], @$attributes['class']])  {{ $attributes }}>
  @isset($header)
    <div @class([$headerCls, $cls['card-header']]) {{ $header->attributes }}>
      {{ $header }}
    </div>
  @endisset
  @if($body)
    <div @class([$cls['card-body'] => $body, $bodyCls])>
      {{$slot}}
    </div>
  @else
    {{$slot}}
  @endif
  @isset($footer)
    <div @class([$headerCls, $cls['card-footer']]) {{ $footer->attributes }}>
      {{ $footer }}
    </div>
  @endisset
</div>

