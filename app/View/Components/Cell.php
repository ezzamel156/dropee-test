<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Cell extends Component
{
    public $cell;
    public $index;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cell, $index)
    {
        $this->cell = $cell;        
        $this->index = $index;        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.cell');
    }
}
