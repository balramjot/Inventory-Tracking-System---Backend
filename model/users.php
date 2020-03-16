<?php
class Users {
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $id;
    private $date_time;
    private $status;

    public function __construct($first_name, $last_name, $email, $password, $id, $date_time, $status) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->id = $id;
        $this->date_time = $date_time;
        $this->status = $status;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($value) {
        $this->first_name = $value;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($value) {
        $this->last_name = $value;
    }

    public function getemail() {
        return $this->email;
    }

    public function setemail($value) {
        $this->email = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getDateTime() {
        $org_date = $this->date_time;
        $newDate = date("F d,Y", strtotime($org_date));
        return $newDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($value) {
        $this->status = $value;
    }
}
?>