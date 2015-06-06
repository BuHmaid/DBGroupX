<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DO_Forum
 *
 * @author Machine
 */
include_once 'mysqli_connect.php';

class DO_Forum {

//===================Parent Forum vars
    public $forumId;
    public $forumTitle;
    public $creationDate;
//===================sub-forum vars
    public $sfId;
    public $sfParentId;
    public $sfTitle;
    public $sfCreationDate;
    public $sfDisplayStatus;
    public $sfDescription;
    //contains database connection
    private $dbc;
    //contains any errors which then to be returned in a function body
    public $errors;

//===================Parent Forum Functionalities
    public function creatForum() {
        $this->StartConnection();
    }

    public function getForumDetails() {
        $this->StartConnection();
    }

    public function setForumDetails() {
        $this->StartConnection();
    }

    public function hideForum() {
        $this->StartConnection();
    }

    public function showForum() {
        $this->StartConnection();
    }

//public function(){}
//public function(){}
//===================Sub-Forum Functionalities
    public function creatSubForum() {
        $this->StartConnection();
    }

    public function getSubForumDetails() {
        $this->StartConnection();
    }

    public function setSubForumDetails() {
        $this->StartConnection();
    }

    public function hideSubForum() {
        $this->StartConnection();
    }

    public function showSubForum() {
        $this->StartConnection();
    }

//public function(){}


    private function StartConnection() {
        if ($this->dbc == NULL) {
            $dbClass = new Database();
            $this->dbc = $dbClass->getConnection();
        }
    }

}
