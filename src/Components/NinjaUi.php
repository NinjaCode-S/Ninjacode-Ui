<?php

namespace Ninjacode\UI\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class NinjaUi extends Component
{

    public function __construct($framework = 'bootstrap')
    {
        View::composer('*', function ($view) use ($framework) {
            $view->with('framework', $framework);
        });
    }

    public function render()
    {
        return function (array $data) {
            return '' . $data['slot'];
        };
    }
}
