<?php

include "header.html";
include_once "DO_Files.php";
include_once "Header.php";
require_once   "mysqli_connect.php";
$db =  new Database();
$dbc = $db->getConnection();
?>

<h1>Home</h1>

<p>Welcome! This your profile!</p>
<?php

echo '<h1>Profile</h1>';
         //  $q = "select FileName from files2 where userId =".$_SESSION['Id']."";
//$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
       //    $dbc = mysqli_connect('localhost','root','','201100013');
          //  $r = mysqli_query($dbc, $q);

         //   while($row = mysqli_fetch_array($r)){
             //   echo '<img src='.$row[0].' width="300" height="180">'; 
           //}

//echo
 <<<_END
<br />
<form method='post' action='home.php' enctype='multipart/form-data'>
Set picture: <input type='file' name='filename' size='50' />
<input type='submit' value='Upload' />
</form>
<br />
_END;

if (isset($_FILES['filename'])) {
 	
    $name = "images//" . $_FILES['filename']['name'];
   
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    
    if ($_FILES['filename']['error'] > 0) {
        echo "<p>There was an error</p>";
        echo $_FILES['filename']['error'];
    } else {
        $type = $_FILES['filename']['type'];
        $size = $_FILES['filename']['size'];
 
         $file = new DO_File();
         $file->FileName = $name;
         $file->FileSize = $size;
         $file->Type = $type;

        if ($file->save()) {

            $fileId = $file->getFileIdFromName();
            
            if ($fileId) {
   
                    
                    echo "<h1> Thankyou </h1><p>Image stored successfully</p>";
                    echo "<p>Uploaded image '$name'</p><br /><img src='$name' height='200' width='200'/>";
                    
            }
            else
                echo '<p class="error">Error retrieving file information</p>';
        }
        else {
            echo '<p class="error"> Oh dear. There was a databse error</p>';
        }
    }
}

echo '<h2>Your Bio</h2>';
              $q = "select Bio from user where userId =".$_SESSION['Id']."";
//$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
            //  $dbc = mysqli_connect('localhost','root','','201100013');
            $r = mysqli_query($dbc, $q);

            while($row = mysqli_fetch_array($r)){
                echo '<p>'.$row[0].'</p>'; 
           }
echo '<p>Update your bio:</p>
<form action="home.php" method="post">
<input type="text" name="Bio" style="width:400px; height:150px;">

                  <input name="submitted" type ="submit" value ="Save" />
                  </form>';
if( isset($_POST['submitted']) )
{
  
$bio = trim($_POST['Bio']);


        $bio = mysqli_real_escape_string($dbc, $bio);
        $q = "update user set Bio = '".$bio."' where userId = ".$_SESSION['Id']."";

        $r = mysqli_query($dbc, $q);
               

         
         if($r){
           echo "<p>Description saved!</p>";
         }  
          else {
            echo '<p class="error"> Oh dear. There was an error</p>';
            echo '<p class = "error">' . mysqli_error($dbc) .'</p>';
          }
}
include "footer.html";
?>
