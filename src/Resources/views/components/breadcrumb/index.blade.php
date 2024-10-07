@props([
    'home_item' => [
        'href' =>  route('home') ,
        'title' => __('Home'),
    ],
    'items' => [],
    'divider' => null,
])
<nav aria-label="breadcrumb" @if($divider) style="--bs-breadcrumb-divider: '{{ $divider }}';" @endif>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            @if(@$home)
                <x-scoped-slot :data="['item' => $home_item]" :slotContent="$home"/>
            @else
                <a href="{{ $home_item['href'] }}">{{ $home_item['title'] }}</a>
            @endif
        </li>
        @foreach($items as $br_item)
            @if($loop->last)
                <li @class(['breadcrumb-item', 'active']) aria-current="page">
                    @if(@$lastItem)
                        <x-scoped-slot :data="['item' => $br_item]" :slotContent="$lastItem"/>
                    @else
                        {{ $br_item['title'] }}
                    @endif
                </li>
            @else
                <li @class(['breadcrumb-item'])>
                    @if(@$item)
                        <x-scoped-slot :data="['item' => $br_item]" :slotContent="$item"/>
                    @else
                        <a href="{{ $br_item['href'] }}">{{ $br_item['title'] }}</a>
                    @endif
                </li>
            @endif
        @endforeach
    </ol>
</nav>
