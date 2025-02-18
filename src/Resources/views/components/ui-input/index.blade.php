@props([
	"type" => 'text'
])

@if(View::exists('components.input.' . strtolower($type)) || file_exists($global_components_path . 'input/'. strtolower($type) . '.blade.php'))
  @php $componentName = 'ui-input.' . strtolower($type); @endphp
  @php $notExists = false; @endphp
@else
  @php $componentName = 'ui-input.text'; @endphp
  @php $notExists = true; @endphp
@endif

<x-dynamic-component :component="$componentName" :type="$type" {{$attributes}}/>
@if($notExists)
  <div class="text-danger p-2">
    {{ __('The field type ":type" does not have form component ', ['type' => $type]) }}
  </div>
@endif
