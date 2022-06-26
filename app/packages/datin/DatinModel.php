<?php

namespace App\App\Packages\Datin;

use PDO;

abstract class DatinModel {

    private Array $fieldNames;
    protected PDO $datin;
    private String $class;


    public function __construct() {
        $this->fieldNames = get_class_vars(get_class($this));
        unset($this->fieldNames["fieldNames"]);
        unset($this->fieldNames['datin']);
        unset($this->fieldNames['class']);
        $this->fieldNames = array_keys($this->fieldNames);
        $this->datin = Datin::get();
        $this->class = get_class($this);
    }

    public function getAll() : Array {
        $query = 'SELECT '.$this->makeQuery();
        $stmt = $this->datin->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        $array = array();
        if ($num>0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $class = $this->class;
                $obj = new $class();
                foreach ($this->fieldNames as $field) {
                    $obj->$field = $row[$field];
                }
                array_push($array,$obj);
            }
        }
        return $array;
    }

    public function getWhere(String $field) : array {
        $query = 'SELECT '.$this->makeQuery().' WHERE '.$field.'=?';
        $stmt = $this->datin->prepare($query);
        $stmt->bindParam(1,$this->$field);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num>0) {
            if ($num>1) {
                $dataArray = array();
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $class = $this->class;
                    $obj = new $class();
                    foreach ($this->fieldNames as $field) {
                        $obj->$field = $row[$field];
                    }
                    array_push($dataArray,$obj);
                }
                return $dataArray;
            } else {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                foreach ($this->fieldNames as $field) {
                    $this->$field = $row[$field];
                }
                return [$this];
            }
        }
        return [];
    }


    private function makeQuery() : String {
        $query = '';
        for ($i=0; $i < $len = count($this->fieldNames) ; $i++) { 
            if ($this->fieldNames[$i] === $this->fieldNames[$len-1]) {
                $query = $query.''.$this->fieldNames[$i];
            } else {
                $query = $query.''.$this->fieldNames[$i].',';
            }
        }
        $query = $query.' FROM '.$this->getTable();
        return $query;
    }

    /**
     * getTable
     * If you want to use DatinModel you shuld implement this method to give back the table for the model in the database
     * @return String it should return the model database table
     */
    abstract protected function getTable() : String;
}