@props([
    'id' => generateId(),
    'alwaysOpen' => false,
    'flush' => false,
    'open' => false,
    'class' => null,
    'headerClass' => null,
    'bodyClass' => null,
    'items' => [],
])

<div @class(['accordion', $class]) id="{{ $id }}">
    @forelse($items as $k=>$item)
        @php($item_id = implode('-', [$id, $k]))
        <div @class(['accordion-item', 'accordion-flush' => $flush])>
            <h2 @class(['accordion-header', $headerClass])>
                <button @class(['accordion-button', 'collapsed' => $k !== $open])
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $item_id }}"
                        aria-expanded="{{ $k !== $open ? 'false' : 'true' }}"
                        aria-controls="{{ $item_id }}">
                    {!! $item['title'] !!}
                </button>
            </h2>
            <div id="{{ $item_id }}"
                 @class(['accordion-collapse', 'collapse', 'show' => $k === $open])
                 @if(!$alwaysOpen) data-bs-parent="#{{ $id }}" @endif>
                <div @class(['accordion-body', $bodyClass])>
                    {!! $item['content'] !!}
                </div>
            </div>
        </div>
    @empty
        {{ $noItems ?? '' }}
    @endforelse
</div>
