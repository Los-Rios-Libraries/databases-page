<?php
include 'location.php';
$path = "";
if ((isset($oncampus)) && (!isset($_GET['offcampus'])) ){
    $URLbase = "http://library.artstor.org/";
//    header ('Location: ' .$URLbase . $path);

}
else {
 //   $problemDB = 'artstor';
// include 'problems/shell.php';
    $URLbase = "http://0-library.artstor.org.lasiii.losrios.edu/";
//		$message = "offcampus";
}
// 
//echo $message;
header ('Location: ' .$URLbase . $path);

?>

