<?php


// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

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
$college = '';
if (isset($_GET['college'])) {
 $cols = ['arc', 'crc', 'flc', 'scc'];
  for ($i = 0; $i < count($cols); $i++) {
   if ($_GET['college'] === $cols[$i]) {  // expects parameter e.g. /?college=arc
  	$college = $cols[$i];
  break;
	}
}

}
else {
 include_once('../resources/shared/components/detect-library.php');
if ($college === '') {
 $college = detect_library();
}
}
if ($college === '') {
 parse_str($_SERVER['QUERY_STRING'], $params);
 $query_str = '';
 if (count($params) > 0) {
  foreach($params as $key => $value) {
   $query_str .= '&' . $key . '=' . $value;
  }
 }
 $choose_library_url = array(
               '?college=arc'. $query_str, '?college=crc' . $query_str, '?college=flc' . $query_str, '?college=scc' . $query_str
               );
  $currentPageTitle = 'Research Databases';
	include_once('../resources/shared/components/choose-library.php');
 exit;
}
function setCollegeParams($col) { // set current college parameters
	$arr = array(
	array(
		'college' => 'arc',
		'fullName' => 'American River College',
		'homepage' => 'https://www.arc.losrios.edu/student-resources/library/',
  'chatWidget' => 'd05703ccd4c26fdae51ae0d0f5df25e1'
	),
	array(
		'college' => 'crc',
		'fullName' => 'Cosumnes River College',
		'homepage' => 'https://crc.losrios.edu/student-resources/library/',
  'chatWidget' => '46725c6c901e366cccd1c3598f4ece18'
		
	),
	array(
		'college' => 'flc',
		'fullName' => 'Folsom Lake College',
		'homepage' => 'https://flc.losrios.edu/student-resources/library/',
  'chatWidget' => '7470fe5975ab434abfdbef6de53f6206'
	),
	array(
		'college' => 'scc',
		'fullName' => 'Sacramento City College',
		'homepage' => 'https://www.scc.losrios.edu/library/',
  'chatWidget' => '3ed10430124d950ef2b216a68e1b18ba'
	)
	);
	for ($i = 0; $i < count($arr); $i++) {
		if ($arr[$i]['college'] === $col) {
			$homePage = $arr[$i]['homepage'];
			$fullName = $arr[$i]['fullName'];
   $chatWidget = $arr[$i]['chatWidget'];
			//break;
		}
	}
	return array(
				 'homePage' => $homePage,
				 'fullName' => $fullName,
     'chatWidget' => $chatWidget
				);
}
if ($college !== '') {
 $homePage = setCollegeParams($college)['homePage'];
 $chatWidget = setCollegeParams($college)['chatWidget'];
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

$alphaShowAll = '<div><a id="show-all" href="index.php?az" class="btn btn-outline-primary">Show All</a></div>' . "\n";
if (isset($format)) {
$formatPretty = str_replace('-', ' ', $format);
$formatPretty = ucwords($formatPretty);
 $metaTitle = $formatPretty . ' - ';
 $currentPageTitle = ': <span id="title-format">' .$formatPretty. '</span>';
}

elseif((isset($alpha)) && (!empty($alpha))) {
	$alphaPretty = ucwords($alpha);
 $metaTitle = $alphaPretty .' - ';
 $currentPageTitle = ': <span id="title-alpha">' .$alphaPretty . '</span>';
}
elseif (isset($category)) {
	$categoryPretty = str_replace('-', ' ', $category);
$categoryPretty = ucwords($categoryPretty);
 $metaTitle = $categoryPretty  .' - ';
 $currentPageTitle = ': <span id="title-cat">' .$categoryPretty . '</span>';
}
elseif ((isset($query)) && (!(empty($query)))) {
	$queryPretty = ucwords($query);
	$metaTitle = $queryPretty .' - ';
	$currentPageTitle = ': <span id="title-query">Search Results for ' .$queryPretty . '</span>';
}
else {
 $metaTitle = '';
 $currentPageTitle = '';
}
// copy file content into a string var
$json_file = file_get_contents('dbs.json');
// convert the string to a json object
$data = json_decode($json_file);

// copy the posts array to a php var
$dbs = $data->databases;
$pageTitle = $metaTitle . 'Research Databases - Los Rios Libraries';
include_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
$injectHeadContent = '';
include_once('../resources/shared/components/head.php');

?>
<style>
 #header h1 {font-size:2rem;}
 #main {background:#e9e9e9;}
 #nav-label {font-size:1.5rem;}
 #trial-dbs ul {padding-left:0;}
 #trial-dbs h2 {font-size:1.1rem;}
 .db-entry h3 {font-size:1.2rem;}
 .db-desc {font-size: 0.9rem; color:#212529;}
 #trial-dbs h3 {font-size:1.1rem;}
 #trial-dbs .badge {display:none;}
 #trial-dbs .vendor {color:#212529;}
 #trial-dbs .btn-link {text-decoration:underline;}
 .open-db-search,.search-btn {fill:#adadad;}
 .open-db-search svg, .search-btn svg {width:20px;}
 .exp-note, start-note {font-weight:600;}

</style>
	</head>
<body data-college="<?php echo $college; ?>">
    <svg  class="defs-only" style="transform:scale(-1,1);display:none;" xmlns="http://www.w3.org/2000/svg" fit="" focusable="false" >
    <symbol id="magnifyingglass" >
      <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
    </symbol>
       
    </svg>
<svg class="defs-only" style="display:none;" xmlns="http://www.w3.org/2000/svg" fit="" focusable="false">
 <symbol id="hamburger-menu">
  <rect width="100" height="20"></rect><rect y="30" width="100" height="20"></rect><rect y="60" width="100" height="20"></rect>
 </symbol>
</svg>
<?php
if (!isset($_GET['framed'])) {
include_once('../resources/shared/components/nav-links.php');

}
?>

<!-- 
<div id="problem-notification" style="width:80%; margin:10px auto;">text here</div>
-->
<div id="header-container" class="container">
		<div class="page-header" id="header">
			<div class="container">

				<h1><?php echo $metaTitle . 'Research Databases'; ?></h1>

			</div>
		</div>
	</div>
<div class="container">



 



<?php

$nav_menu = '<div class="col-lg-3">' . "\r\n";
$nav_menu .= '<nav id="nav">' . "\r\n";
$nav_menu .= '<div id="tabs">' . "\r\n";
$activeClass = 'active';
$altClass = '';
$showDB = '<p id="show-db-no" class="d-none">Showing <span id="db-no"> </span> Databases</p>';

if (!isset($alpha)) {
$responMenuLabel = 'subjects';
$pageLabel = '<li class="nav-item"><a class="nav-link font-weight-bold" href="index.php">Browse by Category</a></li><li class="nav-item"><a class="nav-link btn btn-link" href="index.php?az">Browse by Title</a></li>';
$nav_menu .= '<div id="subject-nav">' . "\r\n";
$nav_menu .= '<h2 data-toggle="collapse" data-target="#main-nav" id="nav-label" class="bg-primary p-2 m-0 text-white" role="button">';
$nav_menu .= '<svg viewBox="-5 0 10 8" width="20" class="d-lg-none align-baseline"><line y2="8" stroke="#fff" stroke-width="10" stroke-dasharray="2 1"/></svg>' . "\r\n";
$nav_menu .= 'Categories</h2>' . "\r\n";
$nav_menu .= '<ul id="main-nav" class="nav flex-column border collapse show">' . "\r\n";
/*
// no longer needed because of Show All buttons
echo "<li> \n";
echo "<a id=\"subject-all\" href=\"index.php\">Show All</a>\n"; 
echo "</li>\n";
*/
// this will be the list that displays in the nav. Does not need to be every category listed in the json file.
$dbCats = array('General', 'Art', 'Business', 'Communication', 'Controversial Topics', 'Criminal Justice &amp; Law', 'Ebooks', 'Education', 'Encyclopedias, Dictionaries, Reference', 'Environmental Science', 'Geography', 'Health &amp; Medicine', 'History', 'Literature', 'Music', 'News', 'Philosophy &amp; Religion', 'Political Science', 'Psychology', 'Sociology', 'Theatre &amp; Performing Arts', 'Video' );
    
    $dbCatsNo = count($dbCats);
    for ($i = 0; $i < count($dbCats); $i++){
     $nav_menu .= makeNavLinks($dbCats[$i]); // located in functions.php
    }
    

$nav_menu .=  "</ul>\n";
$nav_menu .=  "</div>\n";

}
else {

$subjectsClass = 'alternative';
$responMenuLabel = 'A-Z';
// $alphaClass = 'active-page';
$pageLabel = '<li class="nav-item"><a class="nav-link btn btn-link" href="index.php">Browse by Category</a></li><li class="nav-item"><a class="nav-link font-weight-bold" href="index.php?az">Browse by Title</a></li>';
$nav_menu .=  "<div id=\"alpha-nav\" >\n";
$nav_menu .=  '<h2 data-toggle="collapse" data-target="#main-nav" id="nav-label" class="bg-primary p-2 m-0 text-white text-center" role="button">';
$nav_menu .= '<svg viewBox="-5 0 10 8" width="20" class="align-baseline d-lg-none"><line y2="8" stroke="#fff" stroke-width="10" stroke-dasharray="2 1"/></svg>' . "\r\n";
$nav_menu .= 'A-to-Z</h2>' . "\r\n";
$nav_menu .=  '<ul id="main-nav" class="nav border flex-column collapse show">' ."\r\n";
// echo "<li><a href=\"index.php?az=all\">All</a></li>\n";

     $azLinks = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
     $azLinksNo = count($azLinks);
     for ($j = 0; $j < count($azLinks); $j++) {
      $nav_menu .= '<li class="alpha-nav nav-item border-bottom"><a class="nav-link text-uppercase text-center" href="index.php?az=' . $azLinks[$j] .'">' . $azLinks[$j] .'</a></li>' . "\r\n";
     }
 
 
$nav_menu .=  "</ul>\n";
$nav_menu .=  "</div>\n";


}
$nav_menu .= '</div>';
$nav_menu .= '</nav>';

?>
 <div class="row">
  <div class="col-lg-3">
   <?php
   include_once('search-form.php');
   
   ?>
  </div>
  <div class="col-md-6">
     <nav>
  
  <ul id="primary-nav" class="nav nav-pills">
<?php echo $pageLabel; ?>

  </ul>
 </nav>
  </div>
  <div class="col-md-3" id="new-windows">

  <form><input type="checkbox" id="newwin-check"> <label for="newwin-check">Open links in new windows</label></form>

  </div>
 </div>
<div class="row">
<?php echo $nav_menu ?>
 </div>
	<div class="col-lg-6 col-md-8">
		



<section id="main" tabindex="0" class="p-2">
<?php
if (isset($_GET['loggedin'])) {
	echo '<div id="logged-in" class="proxy-dialog alert alert-success" role="alert" style="display:none;" >';
	echo '<p>You are now signed in to library databases</p>';
	echo '</div>';
	
}
elseif (isset($_GET['loggedout'])) {
	echo '<div id="logged-in" class="proxy-dialog alert alert-success" role="alert" style="display:none;" >';
	echo '<p>You are now signed out of library databases</p>';
	echo '</div>';
	
}


if (isset($_GET['db'])) { // funky redirects when mediation is needed
 include_once('db.php');
}

else { // normal db display



if (isset($category)) {
    dbsByCat($category);
    echo '<div><a id="show-all" href="index.php" class="btn btn-outline-primary">Show All</a></div>' . "\r\n";
// if necessary - responsive menu means it probably isn't    echo "<script>$(document).ready(function() {if ( $(window).width() < 739) {document.getElementById('main').scrollIntoView();}});</script>";
}
elseif ((isset($alpha)) && (!isset($format)) ) {
    if (($alpha === 'all') || (empty($alpha))) {

     for ($k = 0; $k < count($azLinks); $k++) {
    
     dbsByAlpha($azLinks[$k]);
     
     }
     if ((isset($format)) || ((isset($query)) && (!(empty($query))))){
           echo $alphaShowAll;
	         echo '<div id="alt-search" class="p-3 bg-white">';
        echo 'It looked like you were searching for a database so we searched this page for it. If that&apos;s not what you wanted, <a href="https://library.losrios.edu/onesearch/?query=' . $query . '">search for <span id="check-search-query">' . $query . '</span> in OneSearch</a>.';
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


}
?>
</section>
	</div>
	<div class="col-lg-3 col-md-4">
<?php
if (!(isset($_GET['db']))) {
 include_once('asides.php');
}

?>
</div>
</div>
</div>

	<?php
	include_once('../resources/shared/components/footer.php');
	?>

<img id="loader" alt="loading" src="loader.gif" style="display:none;">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <?php
 echo '<script src="'. $componentsDir . '/js/bootstrap.bundle.min.js"></script>';
 ?>
<script src="db-scripts.js?0422">

</script>    


<script>
	showNote({
	 message: 'Due to scheduled maintenance, access to databases may be interrupted the morning of Friday, May 25.',
	 start: '2018-05-18',
	 end: '2018-05-25'  
	 });
</script>

</body>
</html>