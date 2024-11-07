@props([
  'id' => generateId(6),
  'pos' => 'end',
  'title' => '',
  'btnText' => 'Open Offcanvas',
  'minWidth' => null,
  'maxWidth' => null,
  'width' => null,
  'minHeight' => null,
  'maxHeight' => null,
  'height' => null,
  'headerBg' => 'white',
  'headerColor' => 'dark',
])
@php($btnAttributes = ['data-bs-toggle' => 'offcanvas', 'aria-controls' => $id, 'data-bs-target' => '#'.$id, 'role' => 'button'])
@isset($button)
    <x-scoped-slot
            :data="['btnAttributes' =>  array_to_attributes($btnAttributes), 'id' => $id, 'title' => $title, 'btnText' => $btnText]"
            :slot-content="$button"/>
@endisset

<div class="offcanvas offcanvas-{{ $pos }}" tabindex="-1" id="{{ $id }}" aria-labelledby="{{ $id }}Label"
        @style([
            'min-width: '. toPixels($minWidth) => $minWidth,
            'max-width: ' . toPixels($maxWidth) => $maxWidth,
            'width: ' . toPixels($width) => $width,
            'min-height: '. toPixels($minHeight) => $minHeight,
            'max-height: ' . toPixels($maxHeight) => $maxHeight,
            'height: ' . toPixels($height) => $height,
        ])>
    <div class="offcanvas-header bg-{{ $headerBg }} text-{{ $headerColor }}">
        @isset($header)
            <x-scoped-slot :data="['id' => $id, 'title' => $title, 'btnText' => $btnText]" :slot-content="$header"/>
        @else
            @if($title)
                <h5 class="offcanvas-title" id="{{ $id }}Label">{{ __($title) }}</h5>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        @endisset
    </div>
    <div class="offcanvas-body">
        {{ $slot }}
    </div>
    <div class="offcanvas-footer" id="{{ $id }}Footer">{{ $footer }}</div>
</div>
