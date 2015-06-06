<?php

include 'header.html';
include 'Header.php';
  echo '<h1> Users </h1>';
      
  include "mysqli_connect.php";
  
  $db = new Database();
  $dbc = $db->getConnection();
  
  $display = 15; 
  $pages;

$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

switch ($sort) 
{
    case 'ln':
        $orderby = 'LName ASC';
        break;
    case 'fn':
        $orderby = 'FName ASC';
        break;
  /*  case 'rd':
        $orderby = 'RegDate ASC';
        break;
    case 'em'   :
        $orderby = 'Email ASC';
        break;
    default:
        $orderby = 'RegDate ASC';
        break;*/
}


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

 $q = "select * from subForum";

  $r = mysqli_query($dbc, $q);
  
  if($r)
  {
    echo '<br />';
    //display a table of results
    echo '<table align="center" cellspacing = "2" cellpadding = "4" width="75%">';
    echo '<tr bgcolor="#87CEEB">
          <td><b>View</b></td>
          
          <td><b><a href="view_users.php?sort=fn">Name</a></b></td>
          <td><b><a href="view_users.php?sort=ln">Forum ID</a></b></td>';   
    
    $bg = '#eeeeee';
    
    while($row = mysqli_fetch_array($r))
    {
        $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
        
        echo '<tr bgcolor="' . $bg. '">
            <td><a href="subForum.php?id=' .$row[0]. '">View</a></td>
            <td>'.$row[1].'</td>
            <td>'.$row[2].'</td>
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
   //$db->close();
   
   //makes links to other pages if required
 
   if($pages > 1)
   {
     echo '<br /><p>'  ;
     
     //find out what page we are on
     $currentpage = ($start/$display)+1;
     
     //need a previous button if not first page
     if($currentpage != 1)
     {
        echo '<a href="view_users.php?$s=' . ($start - $display) . 
                '&p=' .$pages . '&sort='.$sort.'">&nbspPrevious&nbsp</a>'; 
     }
     
     //create the numbered pages
     for($i = 1; $i <= $pages; $i++)
     {
         if($i != $currentpage)
         {
             //the 's' paramater is used in the link to determine which the value
             // in the LIMIT clause used in the select statement near the top of the page
             echo '<a href="view_users.php?s=' . (($display * ($i-1))) . '&p' 
                     . $pages . '&sort='.$sort.'">&nbsp' . $i . '&nbsp</a>';
         }
          //&nbsp is a character to insert a whitespace
      
     }
     
     //if not last page create next button
     if($currentpage != $pages)
     {
         echo '<a href="view_users.php?s=' . ($start+$display) . '&p=' . $pages
                 . '&sort='.$sort.'">&nbspNext&nbsp</a>';
     }
     
     echo '</p>';
     
   }
  include 'footer.html';
?>
