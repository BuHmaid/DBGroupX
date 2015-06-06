<?php
include 'Header.php';
include 'header.html';
$id=0;
$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');

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

     echo '<p class="error">No request id Parameter</p>';   
     
     include 'footer.html';
     
     exit();
}
echo '<h1>Friend Request</h1>';
    $qq = "select fname, lname from user where userId =".$id."";
            $rr = mysqli_query($dbc, $qq);
$rrow = mysqli_fetch_array($rr);

    $q = "select FileName from files2 where userId =".$id."";

            $r = mysqli_query($dbc, $q);

            while($row = mysqli_fetch_array($r)){
                echo '
    <form   method="post">
    
               <p><b>Accept friend request from '.$rrow[0].' '.$rrow[1].'?</b>
               <br></br>
               <img src='.$row[0].' width="200" height="120">
                        <br></br>'; 
                
           }
echo '<input name="submitted"  type ="submit" value ="Add friend" />
    <input name="deleted" type="submit" value="Delete request"/>
                  </form>';
if( isset($_POST['submitted']) )
{


        
        $q = "insert into friendship( userId,friendId) values (".$_SESSION['Id']." ,$id)";
$qqq = "delete from requests where fromId = ".$id." and toId = ".$_SESSION['Id']."";
$qqqq = "insert into messages(subject, body, fromId, toId, date) values ('Friend Request Update','Friend request accepted','".$_SESSION['Id']."',$id,NOW())"; 
        $r = mysqli_query($dbc, $q);
               $rrr = mysqli_query($dbc, $qqq);
$qqqq = mysqli_query($dbc, $qqqq);
         
         if($r){
           
           echo    '<script type="text/javascript">
    alert("Added to friends!");
    history.back();
  </script>';
         }  
          else {
            echo '<p class="error"> Oh dear. There was an error</p>';
            echo '<p class = "error">' . mysqli_error($dbc) .'</p>';
          }
}
if (isset($_POST['deleted'])){
            $q = "delete from requests where fromId = ".$id." and toId = ".$_SESSION['Id'];

        $r = mysqli_query($dbc, $q);
               

         
         if($r){
           
           echo    '<script type="text/javascript">
    alert("Request deleted!");
    history.back();
  </script>';
}}
include 'footer.html';
?>