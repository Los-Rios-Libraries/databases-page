<?php
function cmp($a, $b) // http://stackoverflow.com/a/4282423
{
    return strcmp($a->name, $b->name);
}
function makeURL($root, $path,$proxy, $ssl) {
    $path = str_replace('&', '&amp;', $path);
    $pro = 'http';
    if ($ssl === true) {
        $pro = 'https';
    }
        if ($root !== '') {
         if ($proxy === 'ez') {
            $url = 'https://ezproxy.losrios.edu/login?url=' . $pro . '://' . $root . '/' . $path;
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
function writeDBInfo($db, $url) {
    global $trial;
    global $query;
    global $category;
    global $category;
    $formatList = implode(' ', $db -> type);
    $description = $db -> description;
    $expiration = '';
    $expirationNote = '';
    $date = '';    
    if (isset($db -> exp)) {
     $expiration = $db -> exp;
     if ($expiration === '') {
      $expirationNote = ' <strong>Open-ended access.</strong>';
     }
     else {
     

     $date = date_create($expiration);
     $expirationNote = ' <strong>Access expires ' . date_format($date, 'l, F j, Y') . '.</strong>';
     }     
    }
    $start = '';
    $startNote = '';
    if (isset($db -> start_date)) {
      $start = $db -> start_date;
      $date = date_create($start);
      $startNote = ' <span class="start-note"><strong>Access will begin on ' . date_format($date, 'l, F j, Y') . '.</span></strong>';
    }
    if (isset($db -> trial)) {
        $trialclass = 'trial';
    }
    else {
        $trialclass = '';
    }
    $dataCol = '';
    if (array_key_exists('col',$db)) {
        $dataCol = ' data-college="' . $db -> col . '" ';
    }
    $dataProx = '';
    if (array_key_exists('proxy', $db)) {
        $dataProx = ' data-proxy="'. $db -> proxy . '" ';
        
    }
    $dataExp = '';
    if ($expiration !== '') {
     $dataExp = ' data-expiration="' . $expiration . '" ';
    }
    $dataStart = '';
    if ($start  !== '') {
     $dataStart = ' data-startdate="' . $start . '" ';
    }
    $output =  '<li' . $dataCol . $dataExp . $dataStart .  ' class="db-entry active ' .$formatList . ' ' .$trialclass . ' ">' . "\r\n";
    $searchButton = "<button class=\"open-db-search\" title=\"Search this database\"><img height=\"16\" width=\"16\" src=\"search.png\" alt=\"search\"></button>\n";
    $name = $db -> name;
    if (preg_match('/Bloomsbury|Coronavirus|Country|Cq|Dailies|Digital Thea|Drama Online|Kanopy|Opposing|CollegeSource|Ethnologue|Health Reference|ProQuest|Global Env/', $name) === 1) {
        $searchButton = '';
    }
    $output .= $searchButton;
    $output .= "<h3><a " . $dataProx . " class=\"db-name\" href=\"" .$url ."\">" .$db-> name ."</a> <span class=\"vendor\">(" . $db -> vendor .")</span></h3>\n";
    $output .= "<p class=\"db-desc\">" . $description . $expirationNote . $startNote . "</p>\n";
    return $output;
}
function dbsByCat($dbcat) {
 global $dbs;
 global $category;
 $heading = str_replace('-', ' ', $dbcat);
 echo "<div id=\"" .$dbcat . "\" class=\"category\">\n";
 echo "<h2>" .$heading . "</h2>\n";
 if ($dbcat === 'temporary-access') {
  echo '<div style="padding:10px;">The following databases are being provided by vendors temporarily during the COVID-19 emergency.</div>';
 }
 echo "<ul>\n";
 foreach($dbs as $db) {
    $ssl = '';
    if (isset($db -> ssl)) {
        $ssl = $db -> ssl;
    }
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $ssl);
  if (in_array($dbcat, $db ->category)) {
   echo writeDBInfo($db, $url);
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
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $db->ssl);
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $query)> -1) {


      echo writeDBInfo($db, $url);
      
      
      }
      echo "</ul></div>\n";
      }
}

function dbsByAlpha($letter) {
 global $dbs;
// sort($dbs);
 usort($dbs, 'cmp');
 global $query;
 $query = strtolower($query);
 $query = preg_replace('/lexus|lex[iu]s(.*)/', 'lexisnexis', $query);
 $query = preg_replace('/j\s*stor.*/', 'jstor', $query);
 $queryParts = explode(' ', $query);
 global $alphaShowAll;
 echo "<div class=\"alpha category\"><h2>" .$letter . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
        $ssl = '';
    if (isset($db -> ssl)) {
        $ssl = $db -> ssl;
    }
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $ssl);
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $letter) === 0) {
     if ((isset($query)) && (!(empty($query)))) {
      $vendorLower = strtolower($db -> vendor);
      $altNames = implode(' ', $db -> altname);
      $altNames = str_replace('-', ' ', $altNames);
      $altNames = strtolower($altNames);

     $types = implode(' ', $db -> type);
     $types = str_replace('-', ' ', $types);
     $categories = implode(' ', $db -> category);
 //    echo '<p>altNames: ' . $altNames . '</p>';
 //(strpos($categories, $query > -1)) || (strpos($types, $query > -1))  many false positives..
        if (($dbLower === $query) || ($altNames === $query) ||( $categories === $query) || ($types === $query) ||($vendorLower === $query))  {
      echo writeDBInfo($db, $url);
      // need to figure out how to end it here
      }
      elseif ((strpos($dbLower, $queryParts[0]) > -1) || (strpos($altNames, $queryParts[0]) > -1) ||(strpos($categories, $queryParts[0]) > -1) || (strpos($types, $queryParts[0]) > -1) ||(strpos($vendorLower, $queryParts[0]) > -1))  {
      echo writeDBInfo($db, $url);
      }
     }
 
     else {
      echo writeDBInfo($db, $url);
      }
      }
      }
      echo "</ul></div>\n"; 
      }

function trialDbs() {
 
 global $dbs;
  echo "<ul>\n";
 foreach($dbs as $db) {
        $ssl = '';
    if (isset($db -> ssl)) {
        $ssl = $db -> ssl;
    }
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $ssl);
  if (array_key_exists('trial', $db)) {
   echo writeDBInfo($db, $url);
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