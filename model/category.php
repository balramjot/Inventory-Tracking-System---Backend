<?php
class Category {
    private $id;
    private $name;
    private $status;

    public function __construct($id, $name, $status) {       
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }

    public function getname() {
        return $this->name;
    }

    public function setname($value) {
        $this->name = $value;
    }
  
    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($value) {
        $this->status = $value;
    }
}
?>