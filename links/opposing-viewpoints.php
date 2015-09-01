<?php
include 'location.php';
$path = "itweb/?db=OVIC";
if (isset($oncampus)) {
    $URLbase = "http://infotrac.galegroup.com/";
//		$message = "oncampus";
header ('Location: ' . $URLbase . $path);
}
else {
    
    ?>
    
    
    <!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<meta charset="utf-8" >
 <meta name=viewport content="width=device-width, initial-scale=1">
<title>Outage - Research Databases - Los Rios Libraries</title>

<link rel="stylesheet" href="../style.css" >
<link rel="stylesheet" href="../res/jquery-ui.css">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,400italic' rel='stylesheet' type='text/css'>
 

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44798235-7', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
    	<a href="#main" id="skip">Skip to main content</a>
 <header>
  <nav id="head-nav">
<?php include '../search-form.php';
?>
<ul>
<li id="arc-link" class="headnav">
<abbr title="American River College"><a href="http://www.arc.losrios.edu/arclibrary.htm">ARC</a></abbr>
</li>
<li id="crc-link" class="headnav" >
<abbr title="Cosumnes River College"><a href="http://www.crc.losrios.edu/library">CRC</a></abbr>
</li>
<li id="flc-link" class="headnav" >
<abbr title="Folsom Lake College"><a href="http://www.flc.losrios.edu/libraries">FLC</a></abbr>
</li>
<li id="scc-link" class="headnav">
<abbr title="Sacramento City College"><a href="http://www.scc.losrios.edu/library">SCC</a></abbr>
</li>
</ul>
</nav>
 <h1><a href="index.php">Research  Databases</a><?php echo $pageTitle; ?></h1>
<div id="tagline">Los Rios Libraries</div>
 </header>
 
 <section id="main" tabindex="0">
    <p>Opposing Viewpoints is currently experiencing system issues and is not accessible from off-campus. We're sorry for any inconvenience and have contacted the vendor to fix the problem.</p>
    <div>
     <a id="show-all" onclick="goBack(); return false;">Go Back</a>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>
 </section>
 
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="res/jquery-ui.min.js"></script>
<script src="db-scripts.js">
</body>
    <?php
    
 //   $URLbase = "http://0-infotrac.galegroup.com.lasiii.losrios.edu/";
//		$message = "offcampus";
}
// header ('Location: ' .$URLbase . $path);
//echo $message;

?>