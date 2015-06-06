<?php

include 'header.html';
include 'Header.php';
  echo '<h1> My Messages </h1>';
      
  include "mysqli_connect.php";
  
  $db = new Database();
  $dbc = $db->getConnection();
              $dbc = mysqli_connect('localhost','root','','201100013');
  $display = 15; 
  $pages;

if(isset($_GET['p']) ) 
{
    $pages=$_GET['p'];  
}
else
{
 
    $q = "select count(userid) from user";
    $r = mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($r, MYSQLI_NUM);
    $records=$row[0];
     
    if($records > $display ) 
      $pages=ceil($records/$display);  
    else
      $pages = 1;
}


if(isset($_GET['s']) )
   $start=$_GET['s'];  
else
    $start = 0;

  $q = "select messages.idMessages, messages.subject, messages.body, messages.date from user, messages where user.userId = messages.toId and user.userId = ".$_SESSION['Id']." order by date desc ";
  $r = mysqli_query($dbc, $q);
  
  if($r)
  {
    echo '<br />';

    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB"><td><b>View</b></td></td>
          <td><b><a>Subject</a></b></td><td><b><a>Body</a></b></td>
          <td><b><a>Date</a></b></td>
          </tr>';   

    $bg = '#eeeeee';
    while($row = mysqli_fetch_array($r))
    {

        
        $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
        
        echo '<tr bgcolor="' . $bg. '">
            <td><a href="show_message.php?id=' .$row[0]. '">View</a></td>
            <td>'.$row[1].'</td>
            <td>'.$row[2].'</td>
            <td>'.$row[3].'</td>
            
              </tr>';


    }
    echo '</table>';
  }
  else
  {
      echo '<p class="error">' . $q . '</p>';
      echo '<p class="error"> Oh dear. There was an error</p>';
      echo '<p class="error">' . mysqli_error($dbc) .'</p>';
  }
  
   mysqli_free_result($r);

 /*
   if($pages > 1)
   {
     echo '<br /><p>'  ;

     $currentpage = ($start/$display)+1;

     if($currentpage != 1)
     {
        echo '<a href="view_users.php?$s=' . ($start - $display) . '&p=' .$pages . '">&nbspPrevious&nbsp</a>'; 
     }

     for($i = 1; $i <= $pages; $i++)
     {
         if($i != $currentpage)
         {

             echo '<a href="view_users.php?s=' . (($display * ($i-1))) . '&p' 
                     . $pages . '">&nbsp' . $i . '&nbsp</a>';
         }

      
     }

     if($currentpage != $pages)
     {
         echo '<a href="view_users.php?s=' . ($start+$display) . '&p=' . $pages
                 . '">&nbspNext&nbsp</a>';
     }
     
     echo '</p>';
     
   }
   */
   
  $qq = "select requests.fromId from user, requests where user.userId = requests.toId and user.userId = ".$_SESSION['Id']." ";
  $rr = mysqli_query($dbc, $qq);
  
  if($rr)
  {
    echo '<br />';
    echo '<h2>Friend Requests</h2>';
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB"><td><b>View</b></td></td>
          <td><b><a>Title</a></b></td>
          </tr>';   

    $bg = '#eeeeee';
    while($rrow = mysqli_fetch_array($rr))
    {

        
        $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
        
        echo '<tr bgcolor="' . $bg. '">
            <td><a href="show_request.php?id=' .$rrow[0]. '">View</a></td>
                <td>Friend Request</td>
            
              </tr>';


    }
    echo '</table>';
  }
  else
  {
      echo '<p class="error">' . $q . '</p>';
      echo '<p class="error"> Oh dear. There was an error</p>';
      echo '<p class="error">' . mysqli_error($dbc) .'</p>';
  }
  
   mysqli_free_result($rr);
  include 'footer.html';
?>
