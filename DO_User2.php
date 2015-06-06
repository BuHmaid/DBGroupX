<?php


/**
 * Description of DO_User2
 *
 * @author 201101299
 */
include_once 'mysqli_connect.php';

class DO_User {

    //contains database connection
    private $dbc;
    //contains any errors which then to be returned in a function body
    public $errors;

    function getUserDetails() {
        $this->StartConnection();
    }

    function validateUserDetails() {
         $this->StartConnection();
    }
     function validateEmail() {
         $this->StartConnection();
    }

    function getUserName() {
        $this->StartConnection();
    }

    function getUserID() {
        $this->StartConnection();
    }

    function setUserDetails() {
        $this->StartConnection();
    }

//    function setUserName(){}

    private function StartConnection() {
        if ($this->dbc == NULL) {
            $dbClass = new Database();
            $this->dbc = $dbClass->getConnection();
        }
    }

}
