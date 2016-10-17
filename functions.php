<?php
function cmp($a, $b) // http://stackoverflow.com/a/4282423
{
    return strcmp($a->name, $b->name);
}
function makeURL($root, $path,$proxy, $ssl) {
    $path = str_replace('&', '&amp;', $path);
    $pro = 'http';
        if ($root !== '') {
        if($proxy === 'yes') {
            if ($ssl === 'yes') {
                $root = str_replace('.', '-', $root);
                $pro = 'https';
            }
            $url = $pro . '://0-' .$root . '.lasiii.losrios.edu/' .$path;
        }   
        else {
            $url = $pro . '://' .$root .'/'.$path;
        }
    }
    else {
        $url = $path;
    }
    return $url;
}

function dbsByCat($dbcat) {
 global $dbs;
 global $category;
 $heading = str_replace('-', ' ', $dbcat);
 echo "<div id=\"" .$dbcat . "\" class=\"category\">\n";
 echo "<h2>" .$heading . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy);
  if (in_array($dbcat, $db ->category)) {
   include('writeDBInfo.php');
   }
   }
   echo "</ul>\n";
   echo "</div>\n";
}
function dbsByFormat($format) { 
 global $dbs;
// sort($dbs);
 usort($dbs, 'cmp');
 $formatHead = str_replace('-', ' ', $format);
 echo "<div id=\"format\" class=\"format category\"><h2>" .$formatHead ."</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy);
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
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy);
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $query)> -1) {


      include('writeDBInfo.php');
      
      
      }
      echo "</ul></div>\n";
      }
}

function dbsByAlpha($letter) {
 global $dbs;
// sort($dbs);
 usort($dbs, 'cmp');
 global $format;
 global $query;
 global $alphaShowAll;
 echo "<div class=\"alpha category\"><h2>" .$letter . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy);
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $letter) === 0) {
   if (isset($format)) {
    if (in_array($format, $db -> type)) {
     include ('writeDBInfo.php');
     
     }
     }
     elseif ((isset($query)) && (!(empty($query)))) {
      $vendorLower = strtolower($db -> vendor);
      $altNames = implode(' ', $db -> altname);
      $altNames = str_replace('-', ' ', $altNames);
      $altNames = strtolower($altNames);
      $query = strtolower($query);
      $query = preg_replace('/lexus|lex[iu]s(.*)/', 'lexisnexis', $query);
       $query = preg_replace('/j\s*stor.*/', 'jstor', $query);
     $types = implode(' ', $db -> type);
     $types = str_replace('-', ' ', $types);
     $categories = implode(' ', $db -> category);
 //    echo '<p>altNames: ' . $altNames . '</p>';
 //(strpos($categories, $query > -1)) || (strpos($types, $query > -1))  many false positives...     
      if ((strpos($dbLower, $query) > -1) || (strpos($altNames, $query) > -1) ||(strpos($categories, $query) > -1) || (strpos($types, $query) > -1) ||(strpos($vendorLower, $query) > -1))  {
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

function trialDbs() {
 
 global $dbs;
  echo "<ul>\n";
 foreach($dbs as $db) {
  include('makeURL.php'); // wasn't clear to me  how to make this works as a function, so including instead.
  if (array_key_exists('trial', $db)) {
   include('writeDBInfo.php');
   }
   }
   echo "</ul>\n";
}
function makeNavLinks($term) {
 $encTerm = strtolower($term);
 $encTerm = str_replace(' ', '-', $encTerm);
 $encTerm = urlencode($encTerm);
 echo "<li>\n";
 echo "<a href=\"index.php?category=".$encTerm ."\">" .$term . "</a></li>";
}
?>