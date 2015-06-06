<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DO_Post
 *
 * @author Machine
 */
include_once 'mysqli_connect.php';
class DO_Post {

    public $postId;
    public $userId;
    public $sForumId;
    public $threadId;
    public $postContent;
    public $postDate;
    public $displayStatus;
    //contains database connection
    private $dbc;
    //contains any errors which then to be returned in a function body
    public $errors;

    public function addPost() {
        $this->StartConnection();
    }

    public function getPost() {
        $this->StartConnection();
    }

    public function loadThreadPostsIDs() {
        $this->StartConnection();
    }

    public function setPost() {
        $this->StartConnection();
    }

    public function hidePost() {
        $this->StartConnection();
    }

    public function showPost() {
        $this->StartConnection();
    }

    //public function (){}


    private function StartConnection() {
        if ($this->dbc == NULL) {
            $dbClass = new Database();
            $this->dbc = $dbClass->getConnection();
        }
    }

}
