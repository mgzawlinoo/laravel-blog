<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{

    public $title;
    public $route;
    public $linkText;
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $route, $linkText, $icon = null)
    {
        $this->title = $title;
        $this->route = $route;
        $this->linkText = $linkText;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
