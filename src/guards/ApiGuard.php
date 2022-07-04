<?php

namespace App\Src\Guards;

use App\App\Guards\AbstractNavigationGuard;

class ApiGuard extends AbstractNavigationGuard {
    public function checkPermission() {
        echo "Ez egy API Guard tessék vele játszadozni";
    }
}