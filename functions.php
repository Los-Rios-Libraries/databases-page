<?php
function cmp($a, $b) // http://stackoverflow.com/a/4282423
{
    return strcmp($a->name, $b->name);
}
function makeURL($root, $path,$proxy, $ssl) {
    $path = str_replace('&', '&amp;', $path);
    $pro = 'http';
        if ($root !== '') {
        if($proxy === true) {
            if ($ssl === true) {
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
function writeDBInfo($db, $url) {
    global $trial;
    global $query;
    global $category;
    global $format;
    global $category;
    $formatList = implode(' ', $db -> type);
    $topPick = '';
    if (strpos($db->top, 'yes') !== false) {
        $topPick = 'top-pick';
    }
    $description = $db -> description;
    if (isset($db -> trial)) {
        $trialclass = 'trial';
    }
    else {
        $trialclass = '';
    }
    $dataCol = '';
    if ($db->col !== null) {
        $dataCol = ' data-college="' . $db -> col . '" ';
    }
    $output =  "<li" . $dataCol . " class=\"db-entry active " .$formatList . " " .$trialclass . " " . $topPick . "\">\n";
    $searchButton = "<button class=\"open-db-search\" title=\"Search this database\"><img height=\"16\" width=\"16\" src=\"search.png\" alt=\"search\"></button>\n";
    $name = $db -> name;
    if (preg_match('/Auto|Artstor|Lexis|Country|CQ|INTELECOM|Opposing|Safari|ScienceDirect|Statista|CollegeSource/', $name) === 1) {
        $searchButton = '';
    }
    $output .= $searchButton;
    $output .= "<h3><a class=\"db-name\" href=\"" .$url ."\">" .$db-> name ."</a> <span class=\"vendor\">(" . $db -> vendor .")</span></h3>\n";
    $output .= "<p class=\"db-desc\">" . $description . "</p>\n";
    if ((isset($format)) || (isset($query)) || (isset($category))) {
        $output .= "<dl class=\"internal-links\">\n";
        if (!isset($category)) {
            $output .= "<dt class=\"cat-list\">Categories:</dt> ";
            $dbCategories = $db -> category;
            for ($m = 0; $m < count($dbCategories); $m++) {
                $dbCategory = $dbCategories[$m];
                $viewCategory = str_replace('-', ' ', $dbCategory);
                $viewCategory = ucwords($viewCategory);
                $dbCategory = str_replace('&amp;', '%26amp%3B', $dbCategory);
                $catURL = 'index.php?category=' .$dbCategory ;
                $catString = '<dd class="db-cat"><a class="desc-category" href="' .$catURL .'">' . $viewCategory . '</a></dd>';
                $output .= $catString;
            }
        }
        $output .= "<dt class=\"format-list\">Types:</dt>\n";
        $dbFormats = $db -> type;
        for ($n = 0; $n < count($dbFormats); $n++) {
            $dbFormat = $dbFormats[$n];
            $viewFormat = str_replace('-', ' ', $dbFormat);
            $viewFormat = ucwords($viewFormat);
            $dbFormat = str_replace('&amp;', '%26amp%3B', $dbFormat);
            $formatURL = 'index.php?az&amp;format=' .$dbFormat ;
            $formatString = '<dd class="db-format"><a class="desc-format" href="' .$formatURL .'">' . $viewFormat . '</a></dd>';
            $output .= $formatString;
        };
        $output .= "</dl>\n";
    }
    $output .= "</li>\n";
    return $output;
}
function dbsByCat($dbcat) {
 global $dbs;
 global $category;
 $heading = str_replace('-', ' ', $dbcat);
 echo "<div id=\"" .$dbcat . "\" class=\"category\">\n";
 echo "<h2>" .$heading . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $db->ssl);
  if (in_array($dbcat, $db ->category)) {
   echo writeDBInfo($db, $url);
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
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $db->ssl);
  if (in_array($format, $db ->type)) {
//   include('writeDBInfo.php');
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
 global $format;
 global $query;
 global $alphaShowAll;
 echo "<div class=\"alpha category\"><h2>" .$letter . "</h2>\n";
 echo "<ul>\n";
 foreach($dbs as $db) {
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $db->ssl);
  $dbLower = strtolower($db -> name);
  if (strpos($dbLower, $letter) === 0) {
   if (isset($format)) {
    if (in_array($format, $db -> type)) {
     echo writeDBInfo($db, $url);
     
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
  $url = makeURL($db->urlRoot, $db->urlPath, $db->proxy, $db->ssl);
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