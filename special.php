<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
// this is needed because of legacy urls from special.php... redirect to matching page in new site. Should probably replace absolute URLs with relative PHP paths.
$pTitle = '';

if (isset($_GET['pageTitle'])) {
$pTitle = $_GET['pageTitle'];
}
if ($pTitle !== '') {
	header('Location: https://library.losrios.edu/databases/?db=' . $pTitle);
}
else {
	header('Location: https://library.losrios.edu/databases/');
}
exit;
