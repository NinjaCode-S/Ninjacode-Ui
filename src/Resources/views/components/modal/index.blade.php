@props([
    'id' => generateId(6),
    'class' => '',
    'pos' => 'centered',
    'title' => '',
    'noClose' => false,
    'noBody' => false,
    'headerBg' => 'white',
    'headerColor' => 'dark',
    'btnText' => 'Open Modal',
])
@php($btnAttributes = ['data-bs-toggle' => 'modal', 'aria-controls' => $id, 'data-bs-target' => '#'.$id, 'role' => 'button'])
@isset($button)
    <x-scoped-slot
        :data="['btnAttributes' =>  array_to_attributes($btnAttributes), 'id' => $id, 'title' => $title, 'btnText' => $btnText]"
        :slot-content="$button"/>
@endisset


<div @class([$class, 'modal fade']) id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label"
     aria-hidden="true" {{$attributes}}>
    <div @class(['modal-dialog','modal-dialog-' .$pos])>
        <div class="modal-content">
            <div class="modal-header bg-{{ $headerBg }} text-{{ $headerColor }}">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                @if(!$noClose)
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                @endif
            </div>

            <div @class(['modal-body' => !$noBody])>
                {{$slot}}
            </div>
        </div>
    </div>
</div>
