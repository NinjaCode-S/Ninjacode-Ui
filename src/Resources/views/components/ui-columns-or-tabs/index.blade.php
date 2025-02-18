@props([
    'cols' => [],
    'max' => 4,
    'id' => 'nav-tab-' . generateId(3),
    'columns' => 'columns',
    'item' => null,
    'name' => null,
])
@if(count($cols) <= $max)
    <div class="row row-cols-md-{{count($cols)}}">
        @foreach($cols as $col)
            @isset($item)
                <div class="col">
                    @if(count($cols) === $max)
                        <div class="text-center my-3">
                            <div class="bg-primary-subtle d-inline-flex px-3 py-2 rounded-5 align-items-center">
                                @isset($name)
                                    <x-scoped-slot :data="['item' => $col]" :slotContent="$name"/>
                                @endisset
                            </div>
                        </div>
                    @endif
                    <x-scoped-slot :data="['item' => $col]" :slotContent="$item"/>
                </div>
            @endisset
        @endforeach

    </div>
@else
    <div>
        <ul class="arrow-navtabs bg-light mb-3 nav nav-pills nav-primary" id="{{ $id }}"
            role="tablist" {{ $attributes }}>
            @isset($item)
                @foreach($cols as $col)
                    <li @class(['nav-item']) role="presentation">
                        <button @class(['nav-link', 'active' => $loop->first])  id="{{ $id . $loop->index }}-tab" data-bs-toggle="pill"
                                data-bs-target="#{{ $id . $loop->index }}" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">
                            @isset($name)
                                <x-scoped-slot :data="['item' => $col]" :slotContent="$name"/>
                            @endisset
                        </button>
                    </li>
                @endforeach
            @endisset
        </ul>
    </div>
    <div class="content">
        <div class="tab-content" id="{{ $id }}">
            @isset($item)
                @foreach($cols as $col)
                    <div @class(['tab-pane fade', 'show active' => $loop->first]) id="{{ $id . $loop->index }}" role="tabpanel">
                        <x-scoped-slot :data="['item' => $col]" :slotContent="$item"/>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
@endif
