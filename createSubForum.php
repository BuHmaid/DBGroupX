<?php

include 'header.html';
include 'Header.php';
include 'mysqli_connect.php';
//$dbc = mysqli_connect('localhost','root','','201100013');
$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
echo '<h1>Create Sub-Forum</h1>
    <form  method="post">
    
               <p><b>Sub-forum name:</b>
               
                <input type="text" name="name" size="34" value="" /></p>
                

                  <input name="submitted"  type ="submit" value ="Send" />
                  </form>';
if (isset($_POST['submitted'])) {

    $name = trim($_POST['name']);
    $q = "insert into subForum(subForumName) values ('$name')";

    $r = mysqli_query($dbc, $q);

    if ($r) {

        echo '<script type="text/javascript">
    alert("Subforum created!");
    history.back();
  </script>';
    } else {
        echo '<p class="error"> Oh dear. There was an error</p>';
        echo '<p class = "error">' . mysqli_error($dbc) . '</p>';
             
    }
}
include 'footer.html';
?>