<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DO_Thread
 *
 * @author 201101299
 */
include_once 'mysqli_connect.php';
class DO_Thread {

    public $threadId;
    public $subject;
    public $postDate;
    public $creatorId;
    public $threadStatus;
    public $subForumID;
    //contains database connection
    private $dbc;
    //contains any errors which then to be returned in a function body
    public $errors;

//retrives created thread detaisl
    public function getThreadDetails() {
        $this->StartConnection();
    }

//edits te details of a created thread
    public function setThreadDetails() {
        $this->StartConnection();
    }

    public function loadForumThreadsIDs() {
        $this->StartConnection();
    }

//creates a new thread
    public function createThread() {
        $this->StartConnection();
    }

    public function blockThread() {
        $this->StartConnection();
    }

    public function enableThread() {
        $this->StartConnection();
    }

//public function (){}
//public function (){}


    private function StartConnection() {
        if ($this->dbc == NULL) {
            $dbClass = new Database();
            $this->dbc = $dbClass->getConnection();
        }
    }

}
