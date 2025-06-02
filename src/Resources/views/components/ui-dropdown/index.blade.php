<div class="dropdown">
    <x-ui-btn @class(['dropdown-toggle']) type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ __($btn) }}
    </x-ui-btn>
    <ul class="dropdown-menu">
       {{ $slot }}
    </ul>
</div>
