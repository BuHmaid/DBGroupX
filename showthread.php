<?php

include 'header.html';
include 'Header.php';
require_once   "mysqli_connect.php";
$db =  new Database();
$dbc = $db->getConnection();
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


//echo '<h3>SESSION ID IS '.$_SESSION["Id"].'</h3>';
              $q = "select content from post where threadId = $id";
//$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
       //      $dbc = mysqli_connect('localhost','root','','201100013');
            $r = mysqli_query($dbc, $q);
            $qs = "select subject from thread where threadId = $id";
            $rs = mysqli_query($dbc, $qs);
            $srow = mysqli_fetch_array($rs);
echo '<h2>'.$srow[0].'</h2>';
            while($row = mysqli_fetch_array($r)){
                echo '<p>'.$row[0].'</p>'; 
           }
           //action="showthread.php?id='.$id.'
echo '
    <form  method="post">
    
             <p><b>Reply:</p></b>

                <textarea  name="reply" style="width:405px; height:150px;"> </textarea>
<br></br>
                  <input name="submitted"  type ="submit" value ="Post" />
                  </form>';
if( isset($_POST['submitted']) )
{

$reply = trim($_POST['reply']);


$qq = "insert into post(content, datetime, threadId,  userId) values ('$reply', NOW(),$id, ".$_SESSION['Id'].")";
        $rr = mysqli_query($dbc, $qq);

         if($rr){ 
           
           echo    '<script type="text/javascript">
    alert("Post created!");
    history.back();
  </script>';
           echo $qq;
         }  
          else {
            echo '<p class="error"> Oh dear. There was an error</p>';
            echo '<p class = "error">' . mysqli_error($dbc) .'</p>';
            echo $qq;
          }
}
include 'footer.html';