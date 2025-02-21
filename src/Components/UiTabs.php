<?php

namespace Ninjacode\UI\Components;

use Illuminate\View\Component;

class UiTabs extends Component
{
  public string $id;
  public string $tabs;
  public mixed $active;
  public array $classes;

  public function __construct($active, $classes = [])
  {
    $this->tabs = \uniqid('tabs');
    $this->active = $active;
    $this->id = $this->tabs;
    $this->classes = $classes;

    view()->composer('ui::components.ui-tabs.item', function ($view) {
      $view->with([
        'tabs' => $this->tabs,
        'active' => $this->active,
      ]);
    });
  }

  public function render()
  {
    return view('ui::components.ui-tabs.index');
  }
}
