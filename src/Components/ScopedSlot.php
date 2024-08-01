<?php

namespace Ninjacode\UI\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\View;

class ScopedSlot extends Component
{
    public $slotContent;
    public $data = [];

    public function __construct($slotContent, $data = null)
    {
        $this->slotContent = $slotContent;
        $this->data = $data;
    }

    public function setAttributes($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $this->attributes[$key] = $value;
            }
        }
    }

    public function render()
    {
        $content = $this->slotContent;
        return function (array $data) use ($content) {
            return $content(array_merge($data ?? [],  $this->data ?? []));
        };
    }
}
