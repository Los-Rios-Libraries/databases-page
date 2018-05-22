<?php
function fixCaps($f) {
 
 $f = str_replace('Cq ', 'CQ ', $f);
 $f = str_replace('Medline', 'MEDLINE', $f);
 $f = str_replace('Cinahl', 'CINAHL', $f);
 $f = str_replace('Ebook Collection', 'eBook Collection', $f);
 $f = str_replace('Eric', 'ERIC', $f);
 return $f;
 
}
// allow file to be retrieved via AJAX on remote server
$http_origin = $_SERVER['HTTP_ORIGIN'];

 if (strpos($http_origin, '.losrios.edu') !== false)
 {  
    header('Access-Control-Allow-Origin: ' . $http_origin); // make this available for AJAX within district
    
 }
 $file = file_get_contents('dbs.json');
 if ($file !== 'false') {
  if (!(isset($_GET['nocaps']))) { // default behavior is to restore upper case orthography for weird, which is not their in JSON file because it complicates sorting
   $file = fixCaps($file);
  }
  header('Content-Type: application/json'); // note, string replacements need to be done before this header is sent.
  echo $file;
 }
 else {
  echo 'error';
 }
 exit;
?>