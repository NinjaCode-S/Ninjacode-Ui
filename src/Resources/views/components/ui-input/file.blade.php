@props([
	"name" => '',
	"value" => '',
	"type" => 'string',
	"label" => "",
	"placeholder" => "",
	"required" => false,
	"btn" => false,
	"inline" => false,
	"variants" => [],
	"id" => generateId(),
	"class" => '',
])

@if($label)
    <label class="@if(!!$required) required @endif" for="{{ $id }}">{!! __($label) !!}</label>
@endif
<input @class(['form-control',$class])  type="file" name="{{ $name }}" @required(!!$required) value="{{ $value }}"
       placeholder="{{ $placeholder }}" id="{{ $id }}" {{ $attributes }}>
