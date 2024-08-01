@props(['icon'])


@if($icon && View::exists('components.svg.' . strtolower($icon)) || file_exists($global_components_path . 'svg/'. strtolower($icon) . '.blade.php') )
    <x-dynamic-component :component="'svg.'.strtolower($icon)" {{ $attributes }}/>
@endif
