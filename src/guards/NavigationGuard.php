<?php

namespace App\Src\Guards;

use App\App\Guards\AbstractNavigationGuard;

class NavigationGuard extends AbstractNavigationGuard {

    public function checkPermission() {
        if ($this->getData('authIsRequired')) {
            $this->redirect('/');
        }
    }

}