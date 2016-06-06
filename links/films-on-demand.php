<?php
$cName = 'homeLibrary';
if(isset($_COOKIE[$cName])) {
  switch ($_COOKIE[$cName]) {
    case 'arc':
      $wID = '240535';
      break;
    case 'scc':
      $wID = '106093';
      break;
    case 'crc':
      $wID = '237206';
      break;
    case 'flc':
      $wID = '237742';
      break;
    default:
      $wID = '107590'; // default shouldn't be needed, but just in case
  }
  header('Location: http://0-fod.infobase.com.lasiii.losrios.edu/PortalPlayLists.aspx?wid=' . $wID);
}
// if home library isn't set, following displays
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<meta charset="utf-8" >
 <meta name=viewport content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>Films on Demand - Research Databases - Los Rios Libraries</title>

<link rel="stylesheet" href="../style.css?1005" >
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
<?php
// include '../search-form.php';
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
 <h1><a href="../index.php">Research  Databases</a>: Films on Demand</h1>
<div id="tagline">Los Rios Libraries</div>
 </header>
 
 <section id="main" class="problem-description" tabindex="0">
    <div class="current-issue">
    <p>Please select your college</p>
    <ul class="special">
      <li><a href="http://0-fod.infobase.com.lasiii.losrios.edu/PortalPlayLists.aspx?wid=240535" onclick="setCookie('homeLibrary', 'arc', 10);">American River College</a></li>
      <li><a href="http://0-fod.infobase.com.lasiii.losrios.edu/PortalPlayLists.aspx?wid=237206" onclick="setCookie('homeLibrary', 'crc', 10);">Cosumnes River College</a></li>
      <li><a href="http://0-fod.infobase.com.lasiii.losrios.edu/PortalPlayLists.aspx?wid=237742" onclick="setCookie('homeLibrary', 'flc', 10);">Folsom Lake College</a></li>
      <li><a href="http://0-fod.infobase.com.lasiii.losrios.edu/PortalPlayLists.aspx?wid=106093" onclick="setCookie('homeLibrary', 'scc', 10);">Sacramento City College</a></li>
    </ul>
    </div>
    <div>
     <a id="show-all" onclick="goBack(); return false;">Go Back</a>
</div>

 
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="../res/jquery-ui.min.js"></script>
<script src="../db-scripts.min.js"></script>
    <script>
      (function() {
    var newWins = getCookie('newWindowLinks');
    var showAll = $('#show-all');
    if (newWins === 'yes') {
      showAll.text('Close');
      showAll.on('click', function(e) {
	e.preventDefault();
    window.open('', '_self', ''); //open the current window
    window.close();
      });
    }
    else {
      showAll.on('click', function(e) {
	e.preventDefault();
	window.history.back();
	});
      
    }
    
    })();
    </script>    
    
</body>
