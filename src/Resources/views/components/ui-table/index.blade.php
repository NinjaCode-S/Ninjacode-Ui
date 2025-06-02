@props([
    'id' => generateId(),
    'items' => [],
    'fields' => [],
    'footer' => false,
    'card' => false,
    'responsive' => false,
    'nowrap' => false,
    'striped' => false,
    'stripedColumns' => false,
    'dark' => false,
    'hover' => false,
    'bordered' => false,
    'small' => false,
    'opened' => [],
])
@switch(@$framework)
    @case('uikit')
        @php($cls['table'] = 'uk-table')
        @php($cls['table-responsive'] = 'uk-overflow-auto')
        @php($cls['table-card'] = 'table-card')
        @php($cls['table-params'] = [
            'uk-table-nowrap' => $nowrap,
            'uk-table-striped' => $striped,
            'uk-table-striped-columns' => $stripedColumns,
            'uk-background-secondary uk-light' => $dark,
            'uk-table-hover' => $hover,
            'uk-table-bordered' => $bordered,
            'uk-table-small' => $small,
    ])
        @break
    @default
        @php($cls['table'] = 'table')
        @php($cls['table-responsive'] = 'table-responsive')
        @php($cls['table-card'] = 'table-card')
        @php($cls['table-params'] = [
                'table-nowrap' => $nowrap,
                'table-striped' => $striped,
                'table-striped-columns' => $stripedColumns,
                'table-dark' => $dark,
                'table-hover' => $hover,
                'table-bordered' => $bordered,
                'table-small' => $small,
        ])
        @break
@endswitch

<div @class([$cls['table-responsive'] => $responsive, $cls['table-card'] => $card])>
    <table @class([$cls['table'], ...$cls['table-params']])>
        <thead>
        @isset($headTop)
            {!! $headTop !!}
        @endif
        @isset($searchable)
            <tr>
                @foreach($fields as $field)
                    <th>
                        <x-scoped-slot :data="['field' => $field]" :slotContent="$searchable"/>
                    </th>
                @endforeach
            </tr>
        @endif
        <tr>
            @foreach($fields as $field)
                <th {{ gettype($field) === 'array' ? array_to_attributes(@$field['head_attributes']) : null }}>
                    @if(gettype($field) === 'array')
                        @if(isset(${"head_" . $field['key']}))
                            @php($slot = ${"head_" . $field['key']})
                            <x-scoped-slot :data="['field' => __(keyToTitle($field['key'])) ]" :slotContent="$slot"/>
                        @else
                            {!! __(keyToTitle($field['label'] ?? $field['key'])) !!}
                        @endif
                    @else
                        @if(isset(${"head_" . $field}))
                            @php($slot = ${"head_" . $field})
                            <x-scoped-slot :data="['field' => __(keyToTitle($field['key'])) ]" :slotContent="$slot"/>
                        @else
                            {!! __(keyToTitle($field)) !!}
                        @endif
                    @endif
                    @isset($sortable)
                        <x-scoped-slot :data="['field' => $field]" :slotContent="$sortable"/>
                    @endisset
                </th>
            @endforeach
        </tr>
        @isset($headBottom)
            {!! $headBottom !!}
        @endif
        </thead>
        <tbody>
        @forelse($items as $k=>$item)
            <tr>
                @foreach($fields as $field)
                    @if(gettype($field) === 'array')
                        <td {{ gettype($field) === 'array' ? array_to_attributes(@$field['cell_attributes']) : null }}>
                            @if(isset(${"cell_" . $field['key']}))
                                @php($slot = ${"cell_" . $field['key']})
                                @if(gettype($item) === 'object')
                                    <x-scoped-slot
                                        :data="['field' =>  $field['key'], 'item' => $item, 'idx' => $k, 'value' => $item->{$field['key']} ?? '']"
                                        :slotContent="$slot"/>
                                @else
                                    <x-scoped-slot
                                        :data="['field' =>  $field['key'], 'item' => $item, 'idx' => $k, 'value' => $item[$field['key']] ?? '']"
                                        :slotContent="$slot"/>
                                @endif
                            @else
                                @if(gettype($item) === 'object')
                                    {!! $item->{$field['key']} ?? '' !!}
                                @else
                                    {!! $item[$field['key']] ?? '' !!}
                                @endif
                            @endif
                        </td>
                    @else
                        <td>
                            @if(isset(${"cell_" . $field}))
                                @php($slot = ${"cell_" . $field})
                                @if(gettype($item) === 'object')
                                    <x-scoped-slot
                                        :data="['field' => $field, 'item' => $item, 'idx' => $k, 'value' => $item->{$field} ?? '']"
                                        :slotContent="$slot"/>
                                @else
                                    <x-scoped-slot
                                        :data="['field' => $field, 'item' => $item, 'idx' => $k, 'value' => $item[$field] ?? '']"
                                        :slotContent="$slot"/>
                                @endif
                            @else
                                @if(gettype($item) === 'object')
                                    {!! $item->{$field} ?? '' !!}
                                @else
                                    {!! $item[$field] ?? '' !!}
                                @endif
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
            @isset($rowDetails)
                <tr data-row-details="{{ $id . '-' . $k }}" @style(['display: none' => !in_array($k, $opened)])>
                    <td colspan="{{ count($fields) }}">
                        <x-scoped-slot :data="['item' => $item, 'test' => 1]" :slotContent="$rowDetails"/>
                    </td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="100" class="text-center"> {{ $empty ?? __('No Data') }}</td>
            </tr>
        @endforelse
        @isset($simple)
            {{$simple}}
        @endisset
        </tbody>
        @if($footer && count($items) > 0)
            <tfoot>
            @isset($footTop)
                {!! $footTop !!}
            @endif
            <tr>
                @foreach($fields as $field)
                    <th {{ gettype($field) === 'array' ? array_to_attributes(@$field['head_attributes']) : null }}>
                        @if(gettype($field) === 'array')
                            @if(isset(${"head_" . $field['key']}))
                                @php($slot = ${"head_" . $field['key']})
                                <x-scoped-slot :data="['field' => __(keyToTitle($field['key'])) ]"
                                               :slotContent="$slot"/>
                            @else
                                {!! __(keyToTitle($field['label'] ?? $field['key'])) !!}
                            @endif
                        @else
                            @if(isset(${"head_" . $field}))
                                @php($slot = ${"head_" . $field})
                                <x-scoped-slot :data="['field' => __(keyToTitle($field['key'])) ]"
                                               :slotContent="$slot"/>
                            @else
                                {!! __(keyToTitle($field)) !!}
                            @endif
                        @endif
                    </th>
                @endforeach
            </tr>
            @isset($footBottom)
                {!! $footBottom !!}
            @endif
            </tfoot>
        @endif
    </table>
</div>


