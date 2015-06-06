<body>
<?php
/*if($_DEBUG)
{
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
    error_reporting(E_ALL);
}*/


include "headerlogin.html";
include "Header.php";
$page_title = 'User Login';


echo '<div id="content" style="text-align:center" ><h1>User Login</h1></div>';


if (isset($_POST['submitted'])) {

    require_once('LoginFunctions.php');
   list($check, $data) = checkLogin($_POST['Email'], $_POST['Password']);


    if ($check) {
       $_SESSION['FName'] = $data['FName'];
        $_SESSION['LName'] = $data['LName'];
        $_SESSION['Id'] = $data['UserId'];
       
        $url = absolute_url('home.php'); 
        header("Location: $url");
        exit();
    } else {
        $errors = $data;
    }
}


if (!empty($errors)) {
    echo '<p class="error"> The following errors occurred: <br />';

    foreach ($errors as $err) {
        echo "$err <br />";
    }

    echo '</p>';
}

echo '<form action="index.php" method="post">
            <div style="text-align:center">
        <p>
           <p>E-mail   <input type="text" name="Email" /></p>
           <p>Password    <input type="password" name="Password" /></p>
        </p>
        
        <p><input type="submit" name="submit" value="Login" /></p>
        <a href="register.php">Not a member? Join us now!</a> 
         <input type ="hidden" name="submitted" value="TRUE">
         </div>
         </form>';



include "footer.html";
?>

</body>