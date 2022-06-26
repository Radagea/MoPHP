<?php

namespace App\App\Packages\Datin;

use App\App\App;
use PDO;

class Datin {
    private String $type;
    private String $username;
    private String $port;
    private String $password;
    private String $host;
    private String $database;

    public PDO $conn;

    private static Datin $instance;

    private function __construct(){}

    private function loadDatas() {
        $settings = App::getApp()->getDatabaseSettings();
        $this->type = $settings['type'];
        $this->username = $settings['username'];
        $this->password = $settings['password'];
        $this->host = $settings['host'];
        $this->port = $settings['port'];
        $this->database = $settings['databaseName'];
    }

    private function makeConn() : Void {
        try {
            $this->conn = new PDO($this->type.':host='.$this->host.';dbname='.$this->database,$this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Connection Error'.$e ->getMessage();
        }
    }

    public static function get() : PDO {
        if (!isset(self::$instance)) {
            self::$instance = new Datin();
            self::$instance -> loadDatas();
            self::$instance -> makeConn();
        }

        return self::$instance->conn;
    }

}