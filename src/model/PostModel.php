<?php

namespace App\Src\Model;

use App\App\Packages\Datin\DatinModel;

class PostModel extends DatinModel {
    protected Int $id;
    protected String $title;
    protected String $description;
    protected String $content;



    //ToString

    //setters,getters
    public function getId() : Int {
        return $this->id;
    }

    public function getTitle() : String {
        return $this->title;
    }

    public function getDescription() : String {
        return $this->description;
    }

    public function getContent() : String {
        return $this->content;
    }

    public function setId(Int $id) : Void {
        $this->id = $id;
    }

    public function setTitle(String $title) : Void {
        $this->title = $title;
    }

    public function setDescription(String $description) : Void {
        $this->description = $description;
    }

    public function setContent(String $content) : Void {
        $this->content = $content;
    }
    //Abstract method implementation
    protected function getTable(): String {
        return 'posts';
    }
}