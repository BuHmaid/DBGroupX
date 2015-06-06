$<?php

/**
 * Description of DO_Files
 *
 * @author malcolm.mckenzie
 */
include 'header.php';

include_once "mysqli_connect.php";

class DO_File extends Database {

    private $tableName = 'files2';
    //attributes to represent table columns
    public $idFiles = 0;
    public $FileName;
    public $Type;
    public $FileSize;

    //variable to store validation errors
    public $errorMsg;

    //public $dbc=null;

    public function DO_Files() {
        $this->getDBConnection();
    }

    public function get($fileId) {
        if ($this->getDBConnection()) {

            $q = 'SELECT * FROM files2 WHERE idFiles=' . $fileId;
            $r = mysqli_query($this->dbc, $q);

            if ($r) {
                $row = mysqli_fetch_array($r);

                $this->idFiles = $row['idFiles'];
                $this->FileName = $row['FileName'];
                $this->Type = $row['Type'];
                $this->FileSize = $row['FileSize'];
                return true;
            }
            else
                $this->displayError($q);
        }
        else
            echo '<p class="error">Could not connect to database</p>';

        return false;
    }

    public function save() {
                $this->dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');

        if ($this->getConnection()) {
            //escape any special characters
            $this->FileName = mysqli_real_escape_string($this->dbc, $this->FileName);
           
            $this->Type = mysqli_real_escape_string($this->dbc, $this->Type);



            if ($this->idFiles== null) {
                $q = 'INSERT INTO files2(FileName, Type, FileSize, userId) values' .
                       "('" . $this->FileName . "','" . $this->Type . "'," . $this->FileSize . ",'" .$_SESSION['Id']."')";
            
                //$q = "INSERT INTO user(FileName) values('".$this->FileName."')";
            } else {
                $q = "update files2 set FileName='" . $this->FileName . "', Type='" . $this->Type .
                        "',FileSize=" . $this->FileSize . " where idFiles = '" . $this->idFiles . "'";
          //  $q = 'update user set FileName='.$this->FileName.' where userId = '.$_SESSION['Id'];
                }

            $r = mysqli_query($this->dbc, $q);

            if (!$r) {
                $this->displayError($q);
                return false;
            }

            return true;
        } else {
            echo '<p class="error">Could not connect to database</p>';
            return false;
        }

        return true;
    }

//end of function

    public function delete() {
        if ($this->getDBConnection()) {
            $q = "DELETE FROM files2 WHERE idFiles=" . mysql_escape_string($this->idFiles);
            $r = mysqli_query($this->dbc, $q);

            if (!$r) {
                $this->displayError($q);
                return false;
            }

            return true;
        } else {
            echo '<p class="error">Could not connect to database</p>';
            return false;
        }
    }

    public function getFileIdFromName()
    {
        if ($this->idFiles== null){
           $q = "select idFiles from files2 where Filename ='" . $this->FileName . "'";

            $r = mysqli_query($this->dbc, $q);
            if ($r) {
                while ($row = mysqli_fetch_array($r)) {
                    $this->idFiles = $row[0];
                    return $this->idFiles;
                }
            }
            else 
                return false;
        }
        else
            return $this->idFiles;
    }
    
    public function validateFields() {

        return $errors;
    }

    public function isValid() {
        //declare array to hold any errors messages  
        $errors = array();

        if (empty($this->FileName))
            $errors[] = 'You must enter file name';

     
        return $errors;
    }

  
    private function displayError($q) {
        echo '<p class="error">' . $q . '</p>';
        echo '<p class="error">A database error occurred</p>';
        echo '<p class="error">' . mysqli_error($this->dbc) . '</p>';
    }

}


?>
