@props(['icon'])


@if($icon && View::exists('components.svg.' . strtolower($icon)) || file_exists($global_components_path . 'ui-svg/'. strtolower($icon) . '.blade.php') )
    <x-dynamic-component :component="'ui-svg.'.strtolower($icon)" {{ $attributes }}/>
@endif
