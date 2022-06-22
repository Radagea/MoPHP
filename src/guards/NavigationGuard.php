<?php

namespace App\Src\Guards;

use App\App\Guards\AbstractNavigationGuard;

class NavigationGuard extends AbstractNavigationGuard {

    public function checkPermission() {
        if ($this->get('authIsRequired')) {
            $this->redirect('/');
        }
    }

}