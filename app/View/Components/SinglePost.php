<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SinglePost extends Component
{
    public $a;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->a = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.single-post');
    }
}
