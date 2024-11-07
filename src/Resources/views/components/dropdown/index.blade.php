<div class="dropdown">
    <x-btn @class(['dropdown-toggle']) type="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ __($btn) }}
    </x-btn>
    <ul class="dropdown-menu">
       {{ $slot }}
    </ul>
</div>
