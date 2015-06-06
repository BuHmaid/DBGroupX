<?php

/**
 * Description of DBconnection
 *
 * @author 201101299
 */
class Database {

    public $dbc = null;
    //@home
    //private $host = '192.168.1.15', $user = '201101299', $password = 'polytechnic', $database = 'a201101299';

    //@poly
    //private $host = 'studev2', $user = '201101299', $password = 'polytechnic', $database = '201101299';
  //  private $host = 'studev2', $user = '201100013', $password = 'polytechnic', $database = '201100013';
        private $host = 'localhost', $user = 'root', $password = '', $database = '201100013'; 
    public function getConnection() {
        if ($this->dbc == NULL)
            $this->dbc = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (mysqli_connect_errno()) {
            printf("(DBconnection php)failed to connect: %s\n", mysqli_connect_error());
            die('b0ther');
        }
        return $this->dbc;
    }

    public function closeConnection() {

        if ($this->dbc != NULL)
            mysqli_close($this->dbc);
    }

}
