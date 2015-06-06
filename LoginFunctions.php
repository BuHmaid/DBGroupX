<?php


function absolute_url($page = 'index.php')
{

    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    
    return $url;
}

function checkLogin($email = '', $password = '')
{
  $errors = array();
    
  if(empty($email))
    $errors[] = 'You must enter an email';
 
  if(empty($password))
    $errors[] = 'You must enter a password';
 
  if(empty($errors))
  {

     include 'mysqli_connect.php';
         
      $db = new Database();
      $dbc = $db->getConnection();

      $q = "select UserId, Email, FName, LName from user where Email = '$email' and Password = '$password'";

      $r = mysqli_query($dbc, $q);
                
      if($r)
      {
          if(mysqli_affected_rows($dbc) != 0)
          {
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
            return array(true, $row);
          }
          else
          {
            $errors[] = 'The two passwords do not match';
          }
      }
      else{
        echo '<p class="error"> There was a databse error</p>';
        echo '<p class = "error">' . mysqli_error($dbc) .'</p>';
      }

  }
  
  return array(false, $errors);
      
}
?>
