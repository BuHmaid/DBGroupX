<?php
include 'Header.php';

$page_title = 'View Profile';

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

     echo '<p class="error">No User id Parameter</p>';   
     
     include 'footer.html';
     
     exit();
}

echo '<h1>Profile Picture</h1>';


        $q = "select FileName from files2 where userId =".$id."";
$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
            $r = mysqli_query($dbc, $q);
           // if ($r){
            while($row = mysqli_fetch_array($r)){
                echo '<img src='.$row[0].' width="300" height="180">'; 
           }
 echo '<h2>About Me</h2>';
              $q = "select Bio, loc from user where userId =".$id."";
            $r = mysqli_query($dbc, $q);

            while($row = mysqli_fetch_array($r)){
                echo '<p>'.$row[0].'</p>'; 
                echo '<p>Location: '.$row[1].'</p><br></br>';
           }
           
           echo '<li><a href="message.php?id=' . $id.'">Send Message</a></li>';

include 'footer.html';
?>
