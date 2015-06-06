<?php
include 'headerlogin.html';
?>


<h1>User Registration</h1>

<form action="register.php" method="post">
    <fieldset>
        <p><b>Enter username</b>
            <input type="text" name="username" size="20" value=""/>
        <p><b>Enter First Name</b>
            <input type="text" name="FName" size="20" value="" />
        <p><b>Enter Last Name</b>
            <input type="text" name="LName" size="20" value="" />
        <p><b>Enter Email</b>
            <input type="email" name="Email" size="50" value="" />
        <p><b>Enter Password</b>
            <input type="password" name="Password" size="10" value="" />
        <p><b>Location</b>
            <input type ="text" name="Location" size="20" value="" />
        <div align="center">
            <input type ="submit" value ="Register" />
        </div>  
        <input type="hidden" name="submitted" value="1" />
    </fieldset>
</form>    

<?php
//$dbc=mysqli_connect('studev2','201100013','polytechnic','201100013');
          //    $dbc = mysqli_connect('localhost','root','','201100013');
if (isset($_POST['submitted'])) {
    $username ='';
    $fn = '';
    $ln = '';
    $Email = '';
    $Password = '';
    $loc = '';
    
    $errors = array();

    if (empty($_POST['FName']))
        $errors[] = 'You must enter first name';
    else
        $fn = trim($_POST['FName']);

    if (empty($_POST['LName']))
        $errors[] = 'You must enter last name';
    else
        $ln = trim($_POST['LName']);

    if (empty($_POST['Email']))
        $errors[] = 'You must enter email';
    else
        $Email = trim($_POST['Email']);

    if (empty($_POST['Password']))
        $errors[] = 'You must enter password';
    else
        $Password = trim($_POST['Password']);
    if (empty($_POST['Location']))
        $errors[] = 'You must enter location';
    else
        $loc = trim($_POST['Location']);
    if (empty($_POST['username']))
        $errors[] = 'You must enter username';
    else 
        $username = trim($_POST['username']);

    if (empty($errors)) {

        include 'mysqli_connect.php';

        $db = new Database();
        $dbc = $db->getConnection();
        $username = mysqli_real_escape_string($dbc, $username);
        $fn = mysqli_real_escape_string($dbc, $fn);
        $ln = mysqli_real_escape_string($dbc, $ln);
        $Email = mysqli_real_escape_string($dbc, $Email);
        $Password = mysqli_real_escape_string($dbc, $Password);
        $loc = mysqli_real_escape_string($dbc, $loc);
        

        $q = "insert into user(FName, LName, Email, RegDate, Password, loc, username)" . " values('$fn','$ln','$Email', NOW(), '$Password', '$loc', '$username')";

        $r = mysqli_query($dbc, $q);



        if ($r) {
            echo "<h1> Thankyou </h1><p>$fn $ln you are now registered</p>";
        } else {
            echo '<p class="error"> Oh dear. There was an error</p>';
            echo '<p class = "error">' . mysqli_error($dbc) . '</p>';
        }
    } else {
        echo '<p class="error"> Error </p>';

        foreach ($errors as $msg)
            echo " - $msg<br /> ";
    }
}


include 'footer.html';
?>