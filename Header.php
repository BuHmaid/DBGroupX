  <?php


session_start();

$_DEBUG = true;
//$DEBUG=false;

if ($_DEBUG) {
ini_set('display errors', 1);
//ini_set('log_errors', 1);
//ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);


}
/*$inactive = 300;

if (isset($_SESSION['timeout'])) {
$session_life = time() - $_SESSION['timeout'];

if ($session_life > $inactive) {

session_destroy();
header("Location: logout.php");
}
}
$_SESSION['timeout'] = time();*/
  ?>

            
