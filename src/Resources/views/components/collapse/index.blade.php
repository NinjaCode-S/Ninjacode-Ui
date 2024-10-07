@props([
    'id' => generateId(),
    'items' => [],
    'class' => '',
    'horizontal' => false,
])

@foreach($items as $k=>$titem)
    @php($idk = implode('', [$id, $k]))
    @if(@$trigger)
        <x-scoped-slot :data="['id' => $idk, 'button' => @$titem['button']]" :slotContent="$trigger"/>
    @else
        <x-collapse.trigger target="#{{ $idk }}">{{ @$titem['button'] }}</x-collapse.trigger>
    @endif
@endforeach

@foreach($items as $k=>$citem)
    @php($idk = implode('', [$id, $k]))
    @if(@$item)
        <x-scoped-slot :data="['id' => $idk, 'content' => @$citem['content'], 'horizontal' => $horizontal]" :slotContent="$item"/>
    @else
        <x-collapse.item id="{{ $idk }}" @class([$class]) :horizontal="$horizontal">
            {!! @$citem['content'] !!}
        </x-collapse.item>
    @endif
@endforeach
