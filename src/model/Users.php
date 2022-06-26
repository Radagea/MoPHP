<?php

namespace App\Src\Model;

use App\App\Packages\Datin\DatinModel;

class Users extends DatinModel {
    protected Int $id;
    protected String $username;
    protected String $password;

    public function getId() : Int {
        return $this->id;
    }

    public function getUsername() : String {
        return $this->username;
    }

    public function getPassword() : String {
        return $this->password;
    }

    public function setId(Int $id) : Void {
        $this->id = $id;
    }

    public function setUsername(String $username) : Void {
        $this->username = $username;
    }

    public function setPassword(String $password) : Void {
        $this->password = $password;
    }

    protected function getTable(): String {
        return 'users';
    }
}