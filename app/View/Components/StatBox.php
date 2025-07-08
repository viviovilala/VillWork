<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatBox extends Component
{
    public $icon;
    public $color;
    public $title;
    public $count;

    public function __construct($icon, $color, $title, $count)
    {
        $this->icon = $icon;
        $this->color = $color;
        $this->title = $title;
        $this->count = $count;
    }

    public function render()
    {
        return view('components.stat-box');
    }
}
