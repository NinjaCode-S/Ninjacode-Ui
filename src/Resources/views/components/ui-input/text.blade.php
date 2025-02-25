@props([
	"name" => '',
	"value" => '',
	"attrType" => 'text',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"id" => generateId(6),
	"class" => '',
	"groupTextPre" => null,
	"groupTextPreAttrs" => null,
	"groupTextPost" => null,
	"groupTextPostAttrs" => null,
])

@if($label)
    <label @class(['required' => $required]) for="{{ $id }}">{!! __($label) !!}</label>
@endif
<div class="input-group">
    @isset($groupTextPre)
        <span class="input-group-text" {!! $groupTextPreAttrs !!} >{{ $groupTextPre }}</span>
    @endisset
    <input @class(['form-control',$class]) type="{{ $attrType }}" name="{{ $name }}"
           @required(!!$required) value="{{ $value }}"
           placeholder="{{ $placeholder }}" id="{{ $id }}" {{ $attributes }}>
    @isset($groupTextPost)
        <span class="input-group-text" {!! $groupTextPostAttrs !!} >{{ $groupTextPost }}</span>
    @endisset
</div>
