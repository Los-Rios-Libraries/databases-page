<?php

// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$category=$_GET['category'];
$alpha = $_GET['az'];
$format = $_GET['format'];
$query = $_GET['query'];
$referrer = $_SERVER['HTTP_REFERER'];
$college = $_GET['college'];
$newWins = $_COOKIE['newWindowLinks'];
// echo $referrer;

function setHomeLib($s){
	setcookie('homeLibrary', $s,  time() + (86400 * 10)); // cookie expires after 10 days. May want to lengthen it.
	
}
// most often people will be clicking from library website or libguides. So set the cookie that way if possible.
$ar = 'arc';
$cr = 'crc';
$fl = 'flc';
$sc = 'scc';
if ((strpos($referrer, $ar) > -1) || ($college === $ar) ) {
	setHomeLib($ar);
}
elseif ((strpos($referrer, $sc) > -1) || ($college === $sc) ) {
	setHomeLib($sc);
}
elseif ((strpos($referrer, $cr) > -1) || ($college === $cr) ) {
	setHomeLib($cr);
}
elseif ((strpos($referrer, $fl) > -1) || ($college === $fl) ) {
	setHomeLib($fl);
}


if (!isset($_COOKIE['homeLibrary'])) {
	// otherwise, look at IP address. They may be on campus, coming from databases or elsewhere.
	include('ipToHomeLibrary.php');
	
}
if (isset($_COOKIE['homeLibrary'])) {
	$homeLibrary = $_COOKIE['homeLibrary'];
}
else {
	$homeLibrary = 'unknown';
}

$alphaShowAll = '<div><a id="show-all" href="index.php?az">Show All</a></div>';
if (isset($format)) {
$formatPretty = str_replace('-', ' ', $format);
$formatPretty = ucwords($formatPretty);
 $metaTitle = $formatPretty . ' - ';
 $pageTitle = ': <span id="title-format">' .$formatPretty. '</span>';
}

elseif((isset($alpha)) && (!empty($alpha))) {
	$alphaPretty = ucwords($alpha);
 $metaTitle = $alphaPretty .' - ';
 $pageTitle = ': <span id="title-alpha">' .$alphaPretty . '</span>';
}
elseif (isset($category)) {
	$categoryPretty = str_replace('-', ' ', $category);
$categoryPretty = ucwords($categoryPretty);
 $metaTitle = $categoryPretty  .' - ';
 $pageTitle = ': <span id="title-cat">' .$categoryPretty . '</span>';
}
elseif (isset($query)) {
	$queryPretty = ucwords($query);
	$metaTitle = $queryPretty .' - ';
	$pageTitle = ': <span id="title-query">Search Results for ' .$queryPretty . '</span>';
}
else {
 $metaTitle = '';
 $pageTitle = '';
}
// copy file content into a string var
$json_file = file_get_contents('dbs.json');
// convert the string to a json object
$data = json_decode($json_file);

// copy the posts array to a php var
$dbs = $data->databases;

include_once('functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<meta charset="utf-8" >
 <meta name=viewport content="width=device-width, initial-scale=1">
<title><?php echo $metaTitle; ?> Research Databases - Los Rios Libraries</title>

<link rel="stylesheet" href="style.css" >
<link rel="stylesheet" href="res/jquery-ui.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
 

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44798235-8', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
	<a href="#main" id="skip">Skip to main content</a>
 <header>
  <nav id="head-nav">
<?php include 'search-form.php';
?>
<ul>
<li id="arc-link" class="headnav">
<a href="http://www.arc.losrios.edu/arclibrary.htm">ARC</a>
</li>
<li id="crc-link" class="headnav" >
<a href="http://www.crc.losrios.edu/library">CRC</a>
</li>
<li id="flc-link" class="headnav" >
<a href="http://www.flc.losrios.edu/libraries">FLC</a>
</li>
<li id="scc-link" class="headnav">
<a href="http://www.scc.losrios.edu/library">SCC</a>
</li>
</ul>
</nav>

 <h1><a href="index.php">Research  Databases</a><?php echo $pageTitle; ?></h1>
<div id="tagline">Los Rios Libraries</div>
 </header>
<nav id="nav">
 
 <div id="tabs">


<?php
if (!isset($alpha)) {

$subjectsClass = 'active-page';
$alphaClass = 'alternative';
$responMenuLabel = 'subjects';
$pageLabel = '<li class="active-page"><a href="index.php">Databases by Subject</a></li><li class="alternative"><a href="index.php?az">View Alphabetical List</a></li>';
echo "<div id=\"subject-nav\" class=\"nav\">\n";
echo "<h2 id=\"nav-label\" role=\"button\">Subject Areas</h2>\n";
echo "<ul id=\"main-nav\">\n";
echo "<li> \n";
echo "<a id=\"subject-all\" href=\"index.php\">Show All</a>\n"; 
echo "</li>\n";
// this will be the list that displays in the nav. Does not need to be every category listed in the json file.
$dbCats = array('General', 'Art History', 'Business', 'Communication', 'Controversial Topics', 'Criminal Justice', 'Current Events', 'Education', 'Environmental Science', 'Health &amp; Life Sciences', 'History', 'Literature', 'Music', 'Philosophy &amp; Religion', 'Political Science', 'Psychology', 'Sociology', 'Theatre &amp; Performing Arts' );
    
    $dbCatsNo = count($dbCats);
    for ($i = 0; $i < $dbCatsNo; $i++){
     makeNavLinks($dbCats[$i]); // located in functions.php
    }
    

echo "</ul>\n";
echo "</div>\n";

}
else {

$subjectsClass = 'alternative';
$responMenuLabel = 'A-Z';
$alphaClass = 'active-page';
$pageLabel = '<li class="active-page"><a href="index.php?az">Alphabetical List</a></li><li class="alternative"><a href="index.php">View by Subject</a></li>';
echo "<div id=\"alpha-nav\" class=\"nav\">\n";
echo "<h2 id=\"nav-label\" role=\"button\">A-to-Z</h2>\n";
echo "<ul id=\"main-nav\">\n";
echo "<li><a href=\"index.php?az=all\">All</a></li>\n";

     $azLinks = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
     $azLinksNo = count($azLinks);
     for ($j = 0; $j < $azLinksNo; $j++) {
      echo "<li class=\"alpha-nav\"><a href=\"index.php?az=" . $azLinks[$j] ."\">" . $azLinks[$j] ."</a></li>\n";
     }
 
 
 echo "</ul>\n";
echo "</div>\n";

}
?>
</div>
</nav>

 


<section id="main" tabindex="0">

  <nav>
  
 <!--   <button id="open-search"><img alt="" src="search-icon.png" height="32">Search</button> -->
  <ul id="primary-nav">
<?php echo $pageLabel; ?>

  </ul>
<p id="show-db-no" class="no-show" aria-hidden="false">Showing <span id="db-no"> </span> Databases</p>
 </nav>
<?php
// include 'search-form.php';
// echo "<button onclick=\"location.href='index.php';\">Subject Areas</button>\n";
// echo "<button onclick=\"location.href='index.php?az=all';\">A to Z</button>\n";

if (isset($category)) {
    dbsByCat($category);
    echo "<div><a id=\"show-all\" href=\"index.php\">Show All</a></div>\n";
// if necessary - responsive menu means it probably isn't    echo "<script>$(document).ready(function() {if ( $(window).width() < 739) {document.getElementById('main').scrollIntoView();}});</script>";
}
elseif (isset($alpha)) {
    if (($alpha === 'all') | (empty($alpha))) {
    

     for ($k = 0; $k < $azLinksNo; $k++) {
    
     dbsByAlpha($azLinks[$k], $format);
     
     }
     if ((isset($format)) || (isset($query))){
           echo $alphaShowAll; 
     }
    }

    else {
        dbsByAlpha($alpha);
        echo $alphaShowAll;
        
    }
}
    elseif (isset($query)) {
echo '<script>location.replace("' .$urlRoot .'index.php?az&query=' .$query .'")</script>';
 //    dbsByName($query);
     
    }
elseif (isset($format)) {
 $urlRoot = 'http://scc.losrios.edu/library/tools/databases/';
// dbsByFormat($format);
echo '<script>location.replace("' .$urlRoot .'index.php?az&format=' .$format .'")</script>';
}
else {

    for ($l = 0; $l < $dbCatsNo; $l++){
     $dbCatsEnc = strtolower($dbCats[$l]);
     $dbCatsEnc = str_replace(' ', '-', $dbCatsEnc);
     dbsByCat($dbCatsEnc);
     
     
    }


  
}
?>
</section>
<aside id="new-windows" style="
    
">
  <form><input type="checkbox" id="newwin-check" <?php echo $linkCheck; ?>> <label for="newwin-check">Open links in new windows</label></form>
</aside>
   <aside id="filters">
 
     <h2>Databases by type</h2>
    <div id="type-filter">
<?php
echo "<ul id=\"format-nav\">\n<li class=\"format-links\" id=\"all-formats\"><a href=\"index.php?az\">All Formats</a></li>\n";
$formats = array('Scholarly Journals', 'Ebooks', 'Magazines', 'Reports', 'Images', 'News', 'Encyclopedias', 'Reference', 'Streaming Audio', 'Trade Publications', 'Legal Research' );
for ($k = 0; $k < count($formats); $k++) {
	$formatEnc = strtolower($formats[$k]);
	$formatEnc = str_replace(' ', '-', $formatEnc);

     echo "<li class=\"format-links\"><a href=\"index.php?az&amp;format=" . $formatEnc ."\">" . $formats[$k] ."</a></li>\n";
     
}
echo "</ul></div>\n";
echo "</aside>\n";
echo "<aside id=\"library-help\">\n";
echo "<h2>From Your Library</h2>\n";
echo "<div class=\"hidden\">" . $homeLibrary . "</div>\n";
echo "<div id=\"library-help-content\">\n";

// echo 'home library is '.$homeLibrary;
// include('help/' .$homeLibrary . '.php');
echo "</div>\n";
?>
<div id="choose-library">
	<button>arc</button> <button>crc</button> <button>flc</button> <button>scc</button>
</div>
</aside>

<img id="loader" alt="loading" src="loader.gif" class="hidden">

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="res/jquery-ui.min.js"></script>
<script src="db-scripts.js">
 
</script>


</body>
</html>