<?php

/**
 * Description of _session
 * @author 201101299
 */
//start session
if (!isset($_SESSION)) {
    session_start();
}


// set timeout period in seconds
$session_period = 1800; // 30 minutes
// check  if $_SESSION['timeout'] is set. it is to be sat to the current time.
if (isset($_SESSION['timeout'])) {

    //check how long has past sience the session started
    $session_life = time() - $_SESSION['timeout'];

    if ($session_life > $session_period) {
        //destroy current seesion and  logout page
        session_destroy();
        header("Location: logout.php");
    }
}

//set the timeout session variable
$_SESSION['timeout'] = time();
?>