@props([
	"type" => 'text'
])


@if(View::exists('components.input.' . strtolower($type)))
  @php($componentName = 'input.' . strtolower($type))
  @php($notExists = false)
@elseif(file_exists($global_components_path . 'ui-input/'. strtolower($type) . '.blade.php'))
  @php($componentName = 'ui-input.' . strtolower($type))
  @php($notExists = false)
    @else
      @php($componentName = 'ui-input.text')
      @php($notExists = true)
    @endif

    @isset($componentName)
      @dump($componentName)
      <x-dynamic-component :component="$componentName" :type="$type" {{$attributes}}>
        {{ $slot }}
      </x-dynamic-component>
      @if($notExists)
        <div class="text-danger p-2">
          {{ __('The field type ":type" does not have form component ', ['type' => $type]) }}
        </div>
      @endif
    @endisset
