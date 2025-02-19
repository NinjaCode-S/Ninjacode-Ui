<?php

namespace Ninjacode\UI\Components;

use Illuminate\View\Component;

class UiTabItem extends Component
{
  public string $name;

  public function __construct($name = '')
  {
    $this->name = $name;
  }

  public function render()
  {
    return view('ui::components.tabs.item');
  }
}
