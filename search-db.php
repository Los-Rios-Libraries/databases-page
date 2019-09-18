<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
function findURL($arr, $query) {
	global $dbUrl;
    if ($query !== '') {
        return $arr['queryUrl'];
    }
    else {
        return $dbUrl;
    }  
}

$dbName = $_POST['db-name'];
$query = '';
if (isset($_POST['query'])) {
 $query = $_POST['query'];
 $query = urlencode($query);
}
$dbUrl = urldecode($_POST['db-url']);
$ehostCode = '';
if (isset($_POST['ehost'])) {
$ehostCode = $_POST['ehost'];
}
$url = '';
$homeLibrary = '';
$galeID = '';
$fodWid = '';
if (isset($_COOKIE['homeLibrary'])) {
$homeLibrary = $_COOKIE['homeLibrary'];
}
$collegeVars = array(
  array(
    'homeLib' => 'arc',
    'galeID' => 'sacr22807',
    'fodWid' => '240535'
    ),
  array(
    'homeLib' => 'crc',
    'galeID' => 'sacr73031',
    'fodWid' => '237206'
    ),
  array(
    'homeLib' => 'flc',
    'galeID' => 'sacr88293',
    'fodWid' => '237742'
    ),
  array(
    'homeLib' => 'scc',
    'galeID' => 'cclc_sac',
    'fodWid' => '106093'
    )
);

for ($i = 0; $i < count($collegeVars); $i++) {
    if ($homeLibrary === $collegeVars[$i]['homeLib']) {
        $galeID = $collegeVars[$i]['galeID'];
        $fodWid = $collegeVars[$i]['fodWid'];
        
    }
}
$proxyStr = '.lasiii.losrios.edu/';
$ezpStr = 'https://ezproxy.losrios.edu/login?url=';
$ebscoBase = $ezpStr . 'http://search.ebscohost.com/login.aspx?authtype=ip';
$dbs = array(
             array( // first array element is ehost patterns - treated differently
                'ehostcode' => $ehostCode,
                'queryUrl' => $ebscoBase . '&direct=true&db=' . $ehostCode . '&bquery=' .$query . '&site=ehost-live&scope=site'
             ),
             array(
                'dbname' => 'onesearch',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query . '&profile=eds&site=eds-live&scope=site'
             ),
             array(
                'dbname' => 'ebook-collection',
                'queryUrl' => $ebscoBase . '&direct=true&db=nlebk&bquery=' . $query . '&profile=ebooks&site=ehost-live&scope=site'
             ),
            array(
                'dbname' => 'small',
                'queryUrl' => $ebscoBase .'&direct=true&profile=sbrc&bquery=' . $query .'&site=sbrc-live&scope=site'
             ),
            array(
                'dbname' => 'business-source',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&profile=bsc&site=bsc-live&scope=site'
             ),
            array(
                'dbname' => 'literary',
                'queryUrl' => $ebscoBase . '&direct=true&db=lkh&bquery=' . $query .'&site=lrc-plus&scope=site'
             ),
            array(
                'dbname' => 'rehabilitation',
                'queryUrl' => $ebscoBase . '&direct=true&db=nrcn&db=rrc&bquery=' . $query .'&site=rrc-live&scope=site'
             ),
            array(
                'dbname' => 'explora',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&site=src_ic-live&scope=site'
             ),
			array(
				  'dbname' => 'artstor',
				  'queryUrl' => $ezpStr . 'http://library.artstor.org/#/search/' . $query
				  ),
             array(
                'dbname' => 'google',
                'queryUrl' => $ezpStr . 'https://scholar.google.com/scholar?hl=en&q=' .$query
             ),
             array(
                'dbname' => 'jstor',
                'queryUrl' => $ezpStr . 'http://www.jstor.org/action/doAdvancedSearch?q0=' .$query
             ),
             array(
                'dbname' => 'pubmed',
                'queryUrl' => $ezpStr . 'http://www.ncbi.nlm.nih.gov/pubmed?/?term=' . $query . '&myncbishare=casccllib'
             ),
             array(
                'dbname' => 'gale-ebooks',
                'queryUrl' => $ezpStr . 'https://go.galegroup.com/ps/i.do?dblist=GVRL&st=T003&qt=OQE~' .$query . '&sw=w&ty=bs&it=search&p=GVRL&s=RELEVANCE&u=' . $galeID . '&v=2.1'
             ),
             array(
                'dbname' => 'oxford-art',
                'queryUrl' => $ezpStr . 'http://www.oxfordartonline.com/groveart/search?siteToSearch=groveart&q=' . $query . '&searchBtn=Search&isQuickSearch=true'
             ),
             array(
                'dbname' => 'oxford-english',
                'queryUrl' => $ezpStr . 'http://www.oed.com/search?searchType=dictionary&q=' . $query
             ),
             array(
                'dbname' => 'films',
                'queryUrl' => $ezpStr . 'http://digital.films.com/PortalPlaylists.aspx?wid=' .$fodWid .'&rd=a&q=' . $query
             ),
             array(
                'dbname' => 'resources',
                'queryUrl' => $ezpStr . 'http://www.rclweb.net/Search/Results?q=rcl-searchall%3A[' . $query . ']&op=1&qs=1'
             ),
             array(
                'dbname' => 'salem',
                'queryUrl' => $ezpStr . 'http://online.salempress.com/search.do?categoryName=&All=All&numCategories=5&searchInAll=all&searchText=' . $query
             ),
			array(
                'dbname' => 'access-world',
                'queryUrl' => $ezpStr . 'https://infoweb.newsbank.com/apps/news/results?p=AWNB&fld-base-0=alltext&val-base-0=' . $query
             ),
			array(
				'dbname' => 'sacramento',
				'queryUrl' => $ezpStr . 'https://infoweb.newsbank.com/apps/news/results?p=AWNB&fld-base-0=alltext&val-base-0=' . $query . '&t=family%3AA1963%21Sacramento%20Bee%20Collection'
			),
			array(
				  'dbname' => 'sciencedirect',
				  'queryUrl' => $ezpStr . 'https://www.sciencedirect.com/search/advanced?qs=' . $query
			),
			array(
				  'dbname' => 'ovid',
				  'queryUrl' => $ezpStr . 'http://ovidsp.ovid.com/ovidweb.cgi?T=JS&CSC=y&PAGE=main&NEWS=n&DBC=n&D=yrovft&SEARCH=' . $query
				  ),
			
             array(
                'dbname' => 'naxos',
                'queryUrl' => $ezpStr . 'http://losrios.naxosmusiclibrary.com/google/searchgoogle.asp?googletext=' . $query
             )
             
             );


if ($ehostCode !== '') {
    $url = findURL($dbs[0], $query);
}
else {
    for ($i = 1; $i < count($dbs); $i++) { // loop starts with second array element
        if (strpos($dbName, $dbs[$i]['dbname']) > -1) {
            $url = findURL($dbs[$i], $query);
            break;
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EDGE">
<meta charset="utf-8" >
<meta name="robots" description="noindex">
 <meta name=viewport content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
<link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<title>Finding Database</title>

<link rel="stylesheet" href="style.css" >



</head>
<body>
    <div id="message">Loading database...</div>
    <img id="loader" alt="loading" src="loader.gif">
<?php
if ($url !== '') {
?>
<script>
location.replace('<?php echo $url; ?>');

// http://stackoverflow.com/a/12135342/1903000
var i = 1;
var sampleMessages = [ "Loading database...", "Still loading...", "Still loading..." ];
var messageBlock = document.getElementById('message');
setInterval(function() {
    var newText = sampleMessages[i++ % sampleMessages.length];
	messageBlock.innerHTML = '';
	setTimeout(function() {
		messageBlock.innerHTML = newText;
	}, 100);
	
	
}, 1 * 4000);
</script>
<?php
}
?>


</body>
</html>