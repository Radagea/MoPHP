<?php

namespace App\App\Errors;

use Exception;

class MoError extends Exception {
    protected String $mess;

    public function __construct($mess) {
        $this->mess = $mess;
    }

    public function getError(): String {
        return $this->mess;
    }

    public function __toString() {
        
    }
}