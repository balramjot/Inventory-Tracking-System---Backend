<?php
class Part {
    private $id;
    private $category_id;
    private $part_name;
    private $part_no;
    private $description;
    private $quantity;
    private $image;
    private $date_time;
    private $status;

    public function __construct($id, $category_id, $part_name, $part_no, $description, $quantity, $image, $date_time, $status) {       
        $this->id = $id;
        $this->category_id = $category_id;
        $this->part_name = $part_name;
        $this->part_no = $part_no;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->date_time = $date_time;
        $this->status = $status;
    }

    public function getID() {
        return $this->id;
    }

    public function getCategoryID() {
        return $this->category_id;
    }

    public function getPartName() {
        return $this->part_name;
    }
    
    public function getPartNo() {
        return $this->part_no;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getDateTime() {
        $org_date = $this->date_time;
        $newDate = date("F d,Y", strtotime($org_date));
        return $newDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getImage() {
        return '../uploads/'.$this->image;
    }

    public function getImageName() {
        return $this->image;
    }
}
?>