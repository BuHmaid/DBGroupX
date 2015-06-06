<?php
include 'Header.php';
include 'header.html';
$id=0;


if( isset($_GET['id']) )
{
    $id=$_GET['id'];  
}

elseif(isset($_POST['id']))
{
    $id=$_POST['id'];    
}
else
{

     echo '<p class="error">No message id Parameter</p>';   
     
     include 'footer.html';
     
     exit();
}
echo '<h1>Message:</h1>';
              $q = "select subject, body, fromId from messages where idMessages =".$id."";
              
$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
            $r = mysqli_query($dbc, $q);

            while($row = mysqli_fetch_array($r)){
                                    $qq = "select fname, lname from user where userId = ".$row[2]."";
                    $rr = mysqli_query($dbc, $qq);
                    $rrow = mysqli_fetch_array($rr);
                      echo '<p><b>From: </b><br></br>'.$rrow[0].' '.$row[1].'</p>';
                echo '<p><b>Subject: </b><br></br>'.$row[0].'</p>';
                echo '<p><b>Body: </b><br></br>'.$row[1].'</p>'; 
               // while ($rrow = mysqli_fetch_array($rr)){

                  
             //   }
                echo '<p><b><a href="message.php?id='.$row[2].'">Reply to this message</a></b></p>';
           }


include "footer.html";
?>