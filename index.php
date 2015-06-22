<?php
$category=$_GET['category'];
$alpha = $_GET['az'];
$format = $_GET['format'];
$query = $_GET['query'];
$categoryPretty = str_replace('-', ' ', $category);
$categoryPretty = ucwords($categoryPretty);
$alphaPretty = ucwords($alpha);

$formatPretty = str_replace('-', ' ', $format);
$formatPretty = ucwords($formatPretty);
$alphaShowAll = '<div><a id="show-all" href="index.php?az">Show All</a>';
if (isset($format)) {
 $metaTitle = $formatPretty . ' - ';
 $pageTitle = ': ' .$formatPretty;
}

elseif((isset($alpha)) && (!empty($alpha))) {
 $metaTitle = $alphaPretty .' - ';
 $pageTitle = ': ' .$alphaPretty;
}
elseif (isset($category)) {
 $metaTitle = $categoryPretty  .' - ';
 $pageTitle = ': ' .$categoryPretty;
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
<meta charset="utf-8" >
 <meta name=viewport content="width=device-width, initial-scale=1">
<title><?php echo $metaTitle; ?> Research Databases - Los Rios Libraries</title>
<!--
<link rel="stylesheet" href="res/jquery-ui.min.css">

 <link rel="stylesheet" href="res/slicknav.min.css" /> 
 <link rel="stylesheet" href="res/sm-core-css.css" />
 <link rel="stylesheet" href="res/jquery.sidr.dark.css" />-->
<link rel="stylesheet" href="style.css" >
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
 

<!-- <script src="res/jquery-ui.min.js"></script> -->
</head>
<body>
 <header>
  

 <h1>Research  Databases<?php echo $pageTitle; ?></h1>
<div id="tagline">Los Rios Libraries</div>
 </header>
<nav id="nav">
 
 <div id="tabs">


<?php
if (!isset($alpha)) {

$subjectsClass = 'active-page';
$alphaClass = 'alternative';
$responMenuLabel = 'subjects';
$pageLabel = '<li class="active-page"><a href="index.php">By Subject</a></li><li class="alternative"><a href="index.php?az=all">Alphabetical List</a></li>';
echo "<div id=\"subject-nav\" class=\"nav\">\n";
echo "<h2 id=\"nav-label\">Subject Areas</h2>\n";
echo "<ul id=\"main-nav\">\n";
echo "<li> \n";
echo "<a id=\"subject-all\" href=\"index.php\">Show All</a>\n"; 
echo "</li>\n";

$dbCats = array('General', 'Art History', 'Business', 'Communication', 'Controversial Topics', 'Criminal Justice', 'Current Events', 'Education', 'Environmental Science', 'Health &amp; Life Sciences', 'History', 'Literature', 'Music', 'Philosophy &amp; Religion', 'Political Science', 'Psychology', 'Sociology', 'Theatre &amp; Performing Arts' );
    
    $dbCatsNo = count($dbCats);
    for ($i = 0; $i < $dbCatsNo; $i++){
     makeNavLinks($dbCats[$i]);
    }
    

echo "</ul>\n";
echo "</div>\n";

}
else {
		if(isset($query)) {
		echo '<script>window.onload= function() { document.getElementById("multi-search").removeAttribute("class"); document.getElementById("dbpage-query").value="' .$query .'"; document.getElementsByClassName("db-name")[0].scrollIntoView();} </script>';
	}
$subjectsClass = 'alternative';
$responMenuLabel = 'A-Z';
$alphaClass = 'active-page';
$pageLabel = '<li class="active-page"><a href="index.php?az=all">Alphabetical List</a></li><li class="alternative"><a href="index.php">By Subject</a></li>';
echo "<div id=\"alpha-nav\" class=\"nav\">\n";
echo "<h2 id=\"nav-label\">A-to-Z</h2>\n";
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

 


<section id="main">

  <nav>
  
    <button id="open-search"><img src="search-icon.png" height="32">Search</button>
  <ul id="primary-nav">
<?php echo $pageLabel; ?>

  </ul>

 </nav>
<?php
include 'search-form.php';
// echo "<button onclick=\"location.href='index.php';\">Subject Areas</button>\n";
// echo "<button onclick=\"location.href='index.php?az=all';\">A to Z</button>\n";

if (isset($category)) {
    dbsByCat($category);
    echo "<div><a id=\"show-all\" href=\"index.php\">Show All</a>";
// if necessary - responsive menu means it probably isn't    echo "<script>$(document).ready(function() {if ( $(window).width() < 739) {document.getElementById('main').scrollIntoView();}});</script>";
}
elseif (isset($alpha)) {
    if (($alpha === 'all') | (empty($alpha))) {
    

     for ($k = 0; $k < $azLinksNo; $k++) {
    
     dbsByAlpha($azLinks[$k], $format);
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

   <aside id="filters">
 
     <h3>Filter by format</h3>
    <div id="type-filter">
<?php
echo "<button id=\"all-formats\" onclick='location.reload();'>All Formats</button>\n";
$formats = array('Scholarly Journals', 'Ebooks', 'Magazines', 'Reports', 'Images', 'News', 'Encyclopedias', 'Reference', 'Streaming Audio', 'Trade Publications', 'Legal Research' );
for ($k = 0; $k < count($formats); $k++) {

 echo "<button>" . $formats[$k] ."</button>\n";
}
echo "</div>\n";
echo "</aside>\n";
?>
<!-- <script src="res/jquery.slicknav.min.js"></script>
<script>
	$(function(){
		$('#main-nav').slicknav({
                 label: '<?php // echo $responMenuLabel; ?>'
                });
	});
</script> 
<script src="res/jquery.smartmenus.min.js"></script>
<script>
$(function() {
  $('#main-nav').smartmenus();
});
</script>
<script src="res/tinynav.min.js"></script>
<script>
  $(function () {
    $("#main-nav").tinyNav({ header: 'Navigation'});
  });
</script> -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="db-scripts.js">
 
</script>
</body>
</html>