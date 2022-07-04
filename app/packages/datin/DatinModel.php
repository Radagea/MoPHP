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
    
    /**
     * getArray
     * Gives back the DatinModel with an associative array
     * @return Array
     */
    public function getArray() : Array {
        $newArr = get_object_vars($this);
        unset($newArr['fieldNames']);
        unset($newArr['datin']);
        unset($newArr['class']);
        return $newArr;
    }
    
    
    /**
     * getThis
     *
     * @param  mixed $unicIdName
     * @return bool true if the query succesful 
     */
    public function getThis(String $unicIdName) : bool {
        $query = 'SELECT '.$this->makeQuery(). ' WHERE '.$unicIdName.'=? LIMIT 1';
        $stmt = $this->datin->prepare($query);
        $stmt->bindParam(1,$this->$unicIdName);
        $stmt->execute();
        if ($stmt->rowCount()<1) {
            return false;
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($this->fieldNames as $field) {
            $this->$field = $row[$field];
        }
        return true;
    }

    /**
     * getAll
     * 
     * @param  string $orderBy OPTIONAL! if you want to use SQL order you can write here the field and the direction
     * @return Array
     */
    public function getAll(String $orderBy = null) : Array {
        $query = 'SELECT '.$this->makeQuery();
        $query = $this->makeOrderBy($query,$orderBy);
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
    
    /**
     * getWhere
     *
     * @param  mixed $field The field name what you want to use in the WHERE statement
     * @param  String $orderBy [optional] if you want to use SQL order you can write here the field and the order direction
     * @return array return the queried array
     */
    public function getWhere(String $field, String $orderBy = null) : array {
        $query = 'SELECT '.$this->makeQuery().' WHERE '.$field.'=?';
        $query = $this->makeOrderBy($query,$orderBy);
        $stmt = $this->datin->prepare($query);
        $stmt->bindParam(1,$this->$field);
        $stmt->execute();
        $num = $stmt->rowCount();
        if ($num>0) {
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
        }
        return [];
    }

    private function makeOrderBy(String $query, String $orderBy = null) {
        if ($orderBy === null) {
            return $query;
        } 
        $query = $query.' ORDER BY '.$orderBy;
        return $query;
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