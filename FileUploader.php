<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload
 *
 * @author Jassim
 */
include 'header.html';
echo '<br />';
echo '<h1>Image Upload</h1>';

echo <<<_END
<br />
<form method='post' action='upload.php' enctype='multipart/form-data'>
Select File: <input type='file' name='filename' size='50' />
<input type='submit value='Upload' />
</form>
<br />
_END;

if (isset($_FILES['filename'])) {
    
    $name = "images//".$_FILES['filename']['name'];
    
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    
    if ($_FILES['filename']['error'] > 0) {
        echo "<p>There was an error</p>";
        echo $_FILES['filename']['error'];
    }else{
        $type = $_FILES['filename']['type'];
        $size = $_FILES['filename']['size'];
    }
}
class upload {
    //put your code here
    
}
include 'footer.html';