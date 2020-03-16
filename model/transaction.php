<?php
class Transaction {
    private $id;
    private $userid;
    private $username;
    private $partid;
    private $total_trans;
    private $status;
    private $statval;

    public function __construct($id, $userid, $username, $partid, $total_trans, $status) {       
        $this->id = $id;
        $this->userid = $userid;
        $this->username = $username;
        $this->partid = $partid;
        $this->total_trans = $total_trans;
        $this->status = $status;
    }

    public function getusername() {
        return $this->username;
    }
  
    public function getID() {
        return $this->id;
    }

    public function getuserid() {
        return $this->userid;
    }

    public function getpartid() {
        return $this->partid;
    }

    public function gettotal_trans() {
        return $this->total_trans;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($value) {
        $this->statval = $value;
    }

    public function getStatusval() {
        return $this->statval;
    }
}
?>