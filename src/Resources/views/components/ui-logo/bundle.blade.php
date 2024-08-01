@if(\View::exists('components.logo.bundle'))
    <x-dynamic-component component="logo.bundle" {{ $attributes }}/>
@else
    <a href="#" class="logo logo-dark">
        <span class="logo-sm"><x-ui-logo.icon height="44" {{$attributes}}/></span>
        <span class="logo-lg"><x-ui-logo height="44" {{$attributes}}/> </span>
    </a>
    <a href="#" class="logo logo-light">
        <span class="logo-sm"><x-ui-logo.icon height="44" {{$attributes}}/></span>
        <span class="logo-lg"><x-ui-logo height="44" {{$attributes}}/> </span>
    </a>
@endif
