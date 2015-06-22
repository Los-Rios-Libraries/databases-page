<?php
function dbsByCat($dbcat) {
 global $dbs;
 $heading = str_replace('-', ' ', $dbcat);
 echo "<div id=\"" .$dbcat . "\" class=\"category\">\n";
 echo "<h2>" .$heading . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  include('makeURL.php'); // wasn't clear to me  how to make this works as a function, so including instead.
  if (in_array($dbcat, $db ->category)) {
   include('writeDBInfo.php');
   }
   }
   echo "</ul>\n";
   echo "</div>\n";
}
function dbsByFormat($format) { // not really needed - we are redirecting to get better layout
 global $dbs;
 echo "<div id=\"format\" class=\"format category\"><h2>" .$format ."</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  include('makeURL.php');
  if (in_array($format, $db ->type)) {
   include('writeDBInfo.php');
  }
 }
 echo "</ul>\n";
 echo "</div>\n";
 
}
function dbsByName($name) {

 $query = strtolower($name);
  global $dbs;

 global $format;
 echo "<div id=\"search-results\" class=\"category\">\n";
  echo "<ul>\n";
  foreach($dbs as $db) {
  include('makeURL.php');
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $query)> -1) {


      include('writeDBInfo.php');
      
      
      }
      echo "</ul></div>\n";
      }
}

function dbsByAlpha($letter) {
 global $dbs;
 sort($dbs);
 global $format;
 global $query;
 global $alphaShowAll;
 echo "<div class=\"alpha category\"><h2>" .$letter . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  include('makeURL.php');
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $letter) === 0) {
   if (isset($format)) {
    if (in_array($format, $db -> type)) {
     include ('writeDBInfo.php');
     
     }
     }
     elseif (isset($query)) {
      $vendorLower = strtolower($db -> vendor);
      $query = strtolower($query);
//      $types = implode(' ', $db -> type);
//      $categories = implode(' ', $db -> category);
 //(strpos($categories, $query > -1)) || (strpos($types, $query > -1))  many false positives...     
      
      if ((strpos($dbLower, $query) > -1) || (strpos($vendorLower, $query) > -1))  {
      include('writeDBInfo.php');
      }
      
     }
  
     else {
      include('writeDBInfo.php');
      }
      }
      }
      echo "</ul></div>\n";
      }


function makeNavLinks($term) {
 $encTerm = strtolower($term);
 $encTerm = str_replace(' ', '-', $encTerm);
 $encTerm = urlencode($encTerm);
 echo "<li>\n";
 echo "<a href=\"index.php?category=".$encTerm ."\">" .$term . "</a></li>";
}
?>