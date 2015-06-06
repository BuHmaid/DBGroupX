<?php

include_once 'header.html';
include "Header.php";
require_once   "mysqli_connect.php";
$db =  new Database();
$dbc = $db->getConnection();

$id = 0;
//$dbc = mysqli_connect('localhost','root','','201100013');
//$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
if (isset($_GET['subForumId'])) {
    $id = $_GET['subForumId'];
} elseif (isset($_POST['subForumId'])) {
    $id = $_POST['subForumId'];
} else {

    echo '<p class="error">No User id Parameter</p>';

    include 'footer.html';

    exit();
}
echo '<h1>Create Thread</h1>
    <form  method="post" >
    
               <p><b>Enter subject:</b>
               
                <input type="text" name="subject" size="34" value="" /></p>
                
                <p><b>Thread body:</b></p>

                <textarea  name="body" style="width:405px; height:150px;"> </textarea>
               
<br></br>
                  <input name="submitted"  type ="submit" value ="Create Thread" />
                  </form>';
if (isset($_POST['submitted'])) {

    $body = trim($_POST['body']);
  
    $subject = trim($_POST['subject']);
    $q = "insert into thread(Subject, userId, subForumId, date) values ('$subject'," . $_SESSION['Id'] . " ,$id, NOW())";
   
    $r = mysqli_query($dbc, $q);
    //$qtid = "select threadId from thread where Subject = '$subject' and userId = ".$_SESSION['Id']." and subForumId = $id";
    $qtid = "select threadId from thread where userId = " . $_SESSION['Id'] . " order by date desc limit 1";
    $rid = mysqli_query($dbc, $qtid);
    $row = mysqli_fetch_array($rid);

    $qq = "insert into post(content, datetime,threadId, userId) values ('$body', NOW(), $row[0], " . $_SESSION['Id'] . ")";


    $rr = mysqli_query($dbc, $qq);
    
    if ($rr) {

        echo '<script type="text/javascript">
    alert("Thread created!");
    history.back();
  </script>';
    } else {
        echo '<p class="error"> Oh dear. There was an error</p>';
        echo '<p class = "error">' . mysqli_error($dbc) . '</p>';
    }
}
include 'footer.html';
?>