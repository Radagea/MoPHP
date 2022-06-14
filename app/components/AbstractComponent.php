<?php

namespace App\App\Components;

use App\App\View\CompView;

abstract class AbstractComponent {
    abstract public function returnComponent() : CompView;
}