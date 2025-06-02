@php($item = $cols)
@foreach($fields as $field)
    @if(gettype($field) === 'array')
        <td {{ gettype($field) === 'array' ? attributes_to_string(@$field['cell_attributes']) : null }}>
            @if(isset(${"cell_" . $field['key']}))
                @php($slot = ${"cell_" . $field['key']})
                <x-scoped-slot
                    :data="['field' => $field['key'], 'item' => $item, 'idx' => $k, 'value' => $item[$field['key']] ?? '']"
                    :slotContent="$slot"/>
            @else
                {{ $item[$field['key']] ?? '' }}
            @endif
        </td>
    @else
        <td>
            @if(isset(${"cell_" . $field}))
                @php($slot = ${"cell_" . $field})
                <x-scoped-slot
                    :data="['field' => $field['key'], 'item' => $item, 'idx' => $k, 'value' => $item[$field['key']] ?? '']"
                    :slotContent="$slot"/>
            @else
                {{ $item[$field] ?? '' }}
            @endif
        </td>
    @endif
@endforeach
