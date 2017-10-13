<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
$url = $_GET['url'];
$pTitle = $_GET['pageTitle'];
$skipCookie = $_COOKIE["skipPage-" . $pTitle];
if ($skipCookie === 'skip') {
	header('Location: '. $url);
	
}

if (isset($_COOKIE['homeLibrary'])) {
	$homeLibrary = $_COOKIE['homeLibrary'];
}
else {
	$homeLibrary = 'unknown';
}
if ($pTitle === 'films-on-demand') {
	include_once('special/fod-scripts.php');
	
}
if((isset($pTitle)) && (!empty($pTitle))) {
    $pTitlePretty = str_replace('-', ' ', $pTitle);
	$pTitlePretty = ucwords($pTitlePretty);
 $metaTitle = $pTitlePretty .' - ';
 $pageTitle = ': <span id="title-alpha">' .$pTitlePretty . '</span>';
}
include_once('head.php');
?>


<title><?php echo $metaTitle; ?> Research Databases - Los Rios Libraries</title>
</head>
<body>
	<a href="#main" id="skip">Skip to main content</a>
<?php
include_once('header.php');
?>


<section id="main" tabindex="0">
 <div class="category special active" style="display:block !important;">
<?php
include_once('special/' . $pTitle . '.php');
?>
 </div>
    
</section>

<?php
include_once('asides.php');
include_once('footer.php');
?>

<img id="loader" alt="loading" src="loader.gif" class="hidden">

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="res/jquery-ui.min.js"></script>
<!--
 <script src="db-scripts.js?1123a"> 
  -->
</script>     
 <script src="db-scripts.min.js?0407"></script>
</body>
</html>