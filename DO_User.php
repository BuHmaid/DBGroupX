<?php

include 'header.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DO_User
 *
 * @author malcolm.mckenzie
 */
include_once "mysqli_connect.php";

class DO_User extends Database {

    private $tableName = 'User';
    //attributes to represent table columns
    public $userId = 0;
    public $firstName;
    public $lastName;
    public $email;
    public $regDate;
    public $password;
    //variable to store validation errors
    public $errorMsg;

    //public $dbc=null;

    public function DO_User() {
        $this->getDBConnection();
    }

    public function get($userId) {
        if ($this->getDBConnection()) {

            $q = 'SELECT * FROM users WHERE UserId=' . $userId;
            $r = mysqli_query($this->dbc, $q);

            if ($r) {
                $row = mysqli_fetch_array($r);

                $this->userId = $row['UserId'];
                $this->firstName = $row['FName'];
                $this->lastName = $row['LName'];
                $this->email = $row['Email'];
                $this->regDate = $row['RegDate'];
                $this->email = $row['Email'];
                $this->password = $row['Password'];
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
        if ($this->getDBConnection()) {
            //escape any special characters
            $this->firstName = mysqli_real_escape_string($this->dbc, $this->firstName);
            $this->lastName = mysqli_real_escape_string($this->dbc, $this->lastName);
            $this->email = mysqli_real_escape_string($this->dbc, $this->email);
            $this->password = mysqli_real_escape_string($this->dbc, $this->password);

            if ($this->userId == null) {
                $q = 'INSERT INTO users(FName, LName, Email, RegDate, Password) values' .
                        "('" . $this->firstName . "','" . $this->lastName . "','" . $this->email . "',NOW(),'" . $this->password . "')";
            } else {
                $q = "update users set FName='" . $this->firstName . "', LName='" . $this->lastName .
                        "',Email='" . $this->email . "', Password='" . $this->password . "' where userid = '" . $this->userId . "'";
            }


            //   $q = "call SaveUser2($this->userId,'$this->firstName','$this->lastName','$this->email','$this->password')";

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
            $q = "DELETE FROM users WHERE userId=" . mysql_escape_string($this->userId);
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

    public function validateFields() {

        return $errors;
    }

    public function isValid() {
        //declare array to hold any errors messages  
        $errors = array();

        if (empty($this->firstName))
            $errors[] = 'You must enter first name';

        if (empty($this->lastName))
            $errors[] = 'You must enter last name';

        if (empty($this->email))
            $errors[] = 'You must enter email';
        else {
            if (!$this->validEmail())
                $errors[] = 'This email address is already registered';
        }

        if (empty($this->password))
            $errors[] = 'You must enter password';

        return $errors;
    }

    public function validEmail() {
        if ($this->getDBConnection()) {
            $q = "SELECT userid FROM users WHERE Email='" . mysqli_escape_string($this->dbc, $this->email) . "'";
            $r = mysqli_query($this->dbc, $q);

            if ($r) {
                while ($row = mysqli_fetch_array($r)) {
                    $id = $row[0];

                    //we have found a record that has this email - if it is not the current user the the email
                    //must be registered to someone else
                    if ($id != $this->userId)
                        return false;
                }
            } else {
                $this->displayError($q);
                return false;
            }
        } else {
            echo '<p class="error">Could not connect to database</p>';
            return false;
        }

        return true;
    }

    public function getUserFullName() {
        
        if ($this->getDBConnection()) {

            $q = "SELECT CONCAT(FName, ' ', LName) from users where UserId = $this->userId";

            $r = mysqli_query($this->dbc, $q);
            
            if($r){
              $row = mysqli_fetch_array($r);
              return $row[0];
            }
            else {
                $this->displayError($q);
                return false;
            }
        }
        
        return false;
    }

    private function displayError($q) {
        echo '<p class="error">' . $q . '</p>';
        echo '<p class="error">A database error occurred</p>';
        echo '<p class="error">' . mysqli_error($this->dbc) . '</p>';
    }

}

//end of class decl
?>
