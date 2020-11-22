<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $xShow;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($xShow)
    {
        $this->xShow = $xShow;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
