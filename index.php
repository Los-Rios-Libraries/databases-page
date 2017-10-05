<?php

/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
// Use HTTP Strict Transport Security to force client to use secure connections only
$use_sts = true;

// iis sets HTTPS to 'off' for non-SSL requests
if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} elseif ($use_sts) {
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    // we are in cleartext at the moment, prevent further execution and output
    die();
}
if (isset($_GET['category'])) {
	$category=$_GET['category'];
}
if (isset($_GET['az'])) {
	$alpha = $_GET['az'];
}
if (isset($_GET['format'])) { // are we still using this--is it needed any longer?
	$format = $_GET['format'];
}
if (isset($_GET['query'])) {
	$query = $_GET['query'];
	$query = urldecode($query);
	$query = str_replace('&', '&amp;', $query);
}
// $referrer = $_SERVER['HTTP_REFERER']; this is not working
if (isset($_GET['college'])) {
	$college = $_GET['college'];
	// most often people will be clicking from library website or libguides. So set the cookie that way if possible.
	$ar = 'arc';
	$cr = 'crc';
	$fl = 'flc';
	$sc = 'scc';
	if ($college === $ar) {
		setHomeLib($ar);
	}
	elseif ($college === $sc) {
		setHomeLib($sc);
	}
	elseif ($college === $cr) {
		setHomeLib($cr);
	}
	elseif ($college === $fl) {
		setHomeLib($fl);
	}
}
elseif (isset($_COOKIE['homeLibrary'])) {
	$homeLibrary = $_COOKIE['homeLibrary'];
}
else {
	$homeLibrary = 'unknown';
}

if (isset($_COOKIE['newWindowLinks'])) {
	$newWins = $_COOKIE['newWindowLinks'];
}
if (isset($_GET['profile'])) {
	$profile = $_GET['profile'];
}
// echo $referrer;

function setHomeLib($s){
	setcookie('homeLibrary', $s,  time() + (86400 * 10), '/', 'losrios.edu'); // cookie expires after 10 days. May want to lengthen it.
	
}


/*
// our ips are not working out so well...
elseif (!isset($_COOKIE['homeLibrary'])) {
	// otherwise, look at IP address. They may be on campus, coming from databases or elsewhere.
	include('ipToHomeLibrary.php');
	
}
*/

$alphaShowAll = '<div><a id="show-all" href="index.php?az">Show All</a></div>' . "\n";
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
elseif ((isset($query)) && (!(empty($query)))) {
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
include_once('head.php');
?>


<title><?php echo $metaTitle; ?> Research Databases - Los Rios Libraries</title>
</head>
<body>
	<a href="#main" id="skip">Skip to main content</a>
<?php
include_once('header.php');
?>
<!-- 
<div id="problem-notification" style="width:80%; margin:10px auto;">text here</div>
-->
<nav id="nav">
 
 <div id="tabs">


<?php
$activeClass = 'class="active-page"';
$altClass = 'class="alternative"';
$showDB = '<p id="show-db-no" class="no-show" aria-hidden="false">Showing <span id="db-no"> </span> Databases</p>';
if (!isset($alpha)) {
$responMenuLabel = 'subjects';
$pageLabel = '<li ' . $activeClass . '><a href="index.php">Browse by Category</a></li><li ' . $altClass . '><a href="index.php?az">Browse by Title</a></li>';
echo "<div id=\"subject-nav\" class=\"nav\">\n";
echo "<h2 id=\"nav-label\" role=\"button\">Categories</h2>\n";
echo "<ul id=\"main-nav\">\n";
/*
// no longer needed because of Show All buttons
echo "<li> \n";
echo "<a id=\"subject-all\" href=\"index.php\">Show All</a>\n"; 
echo "</li>\n";
*/
// this will be the list that displays in the nav. Does not need to be every category listed in the json file.
$dbCats = array('General', 'Art', 'Business', 'Communication', 'Controversial Topics', 'Criminal Justice &amp; Law', 'Ebooks', 'Education', 'Encyclopedias, Dictionaries, Reference', 'Environmental Science', 'Geography', 'Health &amp; Medicine', 'History', 'Literature', 'Music', 'News', 'Philosophy &amp; Religion', 'Political Science', 'Psychology', 'Sociology', 'Theatre &amp; Performing Arts', 'Video' );
    
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
// $alphaClass = 'active-page';
$pageLabel = '<li ' . $altClass .  '><a href="index.php">Browse by Category</a></li><li ' . $activeClass .'><a href="index.php?az">Browse by Title</a></li>';
echo "<div id=\"alpha-nav\" class=\"nav\">\n";
echo "<h2 id=\"nav-label\" role=\"button\">A-to-Z</h2>\n";
echo "<ul id=\"main-nav\">\n";
// echo "<li><a href=\"index.php?az=all\">All</a></li>\n";

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
 </nav>
<?php
echo $showDB . "\n";
// include 'search-form.php';
// echo "<button onclick=\"location.href='index.php';\">Subject Areas</button>\n";
// echo "<button onclick=\"location.href='index.php?az=all';\">A to Z</button>\n";

if (isset($category)) {
    dbsByCat($category);
    echo "<div><a id=\"show-all\" href=\"index.php\">Show All</a></div>\n";
// if necessary - responsive menu means it probably isn't    echo "<script>$(document).ready(function() {if ( $(window).width() < 739) {document.getElementById('main').scrollIntoView();}});</script>";
}
elseif ((isset($alpha)) && (!isset($format)) ) {
    if (($alpha === 'all') || (empty($alpha))) {

     for ($k = 0; $k < $azLinksNo; $k++) {
    
     dbsByAlpha($azLinks[$k]);
     
     }
     if ((isset($format)) || ((isset($query)) && (!(empty($query))))){
           echo $alphaShowAll;
	         echo '<div id="alt-search" class="special">';
        echo 'It looked like you were searching for a database so we searched this page for it. If that&apos;s not what you wanted, <a href="https://0-search-ebscohost-com.lasiii.losrios.edu/login.aspx?authtype=ip&amp;groupid=main&amp;profile=eds&amp;direct=true&amp;site=eds-live&amp;bquery=' . $query . '">search for <span id="check-search-query">' . $query . '</span> in OneSearch</a>.';
      echo "</div>\n";
     }
    }

    else {
        dbsByAlpha($alpha);
        echo $alphaShowAll;
        
    }
}
    elseif ((isset($query)) && (!(empty($query)))){
echo '<script>location.replace("' .$urlRoot .'index.php?az&query=' .$query .'")</script>';
 //    dbsByName($query);
     
    }
elseif (isset($format)) {
// $urlRoot = 'http://www.library.losrios.edu/resources/databases/';
 dbsByFormat($format);
 echo $alphaShowAll;
// echo '<script>location.replace("' .$urlRoot .'index.php?az&format=' .$format .'")</script>';
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
<?php
include_once('asides.php');
include_once('footer.php');
?>
<img id="loader" alt="loading" src="loader.gif" class="hidden">

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="res/jquery-ui.min.js"></script>
  <!-- <script src="db-scripts.js?0421"> 
 
</script>      -->
<script src="db-scripts.min.js?1004"></script>


</body>
</html>