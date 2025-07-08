<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FiturBox extends Component
{
    public $route;
    public $icon;
    public $title;
    public $desc;
    public $color;

    public function __construct($route, $icon, $title, $desc, $color)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->title = $title;
        $this->desc = $desc;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.fitur-box');
    }
}
