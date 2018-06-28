<?php
/*
// show errors for debugging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
function findURL($arr, $query) {
    if ($query !== '') {
        return $arr['queryUrl'];
    }
    else {
        return $arr['noquery'];
    }  
}

$dbName = $_POST['db-name'];
$query = '';
if (isset($_POST['query'])) {
 $query = $_POST['query'];
 $query = urlencode($query);
}
$vendor = $_POST['vendor'];
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
                'vendor' => 'ebsco',
                'ehostcode' => $ehostCode,
                'noquery' => $ebscoBase . '&profile=ehost&defaultdb=' . $ehostCode,
                'queryUrl' => $ebscoBase . '&direct=true&db=' . $ehostCode . '&bquery=' .$query . '&site=ehost-live&scope=site'
             ),
             array(
                'vendor' => 'ebsco',
                'dbname' => 'onesearch',
                'noquery' => $ebscoBase . '&profile=eds',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query . '&profile=eds&site=eds-live&scope=site'
             ),
             array(
                'vendor' => 'ebsco',
                'dbname' => 'ebook',
                'noquery' => $ebscoBase . '&profile=eds&defaultdb=nlebk',
                'queryUrl' => $ebscoBase . '&direct=true&db=nlebk&bquery=' . $query . '&profile=ebooks&site=ehost-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'small',
                'noquery' => $ebscoBase . '&profile=sbrc',
                'queryUrl' =>'&direct=true&profile=sbrc&bquery=' . $query .'&site=sbrc-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'business-source',
                'noquery' => $ebscoBase . '&profile=bsc',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&profile=bsc&site=bsc-live&scope=site'
             ),
            
            array(
                'vendor' => 'ebsco',
                'dbname' => 'literary',
                'noquery' => $ebscoBase . '&profile=plus',
                'queryUrl' => $ebscoBase . '&direct=true&db=lkh&bquery=' . $query .'&site=lrc-plus&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'rehabilitation',
                'noquery' =>  $ebscoBase . '&profile=rrc',
                'queryUrl' => $ebscoBase . '&direct=true&db=nrcn&db=rrc&bquery=' . $query .'&site=rrc-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'consumer',
                'noquery' =>  $ebscoBase . '&profile=chc',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&site=chc-live&scope=site'
             ),
            array(
                'vendor' => 'ebsco',
                'dbname' => 'explora',
                'noquery' =>  $ebscoBase . '&profile=src_ic',
                'queryUrl' => $ebscoBase . '&direct=true&bquery=' . $query .'&site=src_ic-live&scope=site'
             ),
             array(
                'vendor' => 'google',
                'dbname' => 'google',
                'noquery' =>  $ezpStr . 'https://scholar.google.com',
                'queryUrl' => $ezpStr . 'https://scholar.google.com/scholar?hl=en&q=' .$query
             ),
             array(
                'vendor' => 'jstor',
                'dbname' => 'jstor',
                'noquery' =>  $ezpStr . 'http://www.jstor.org/action/showAdvancedSearch',
                'queryUrl' => $ezpStr . 'http://www.jstor.org/action/doAdvancedSearch?q0=' .$query
             ),
             array(
                'vendor' => 'pubmed',
                'dbname' => 'pubmed',
                'noquery' =>  $ezpStr . 'http://www.ncbi.nlm.nih.gov/pubmed?myncbishare=casccllib',
                'queryUrl' => $ezpStr . 'http://www.ncbi.nlm.nih.gov/pubmed?/?term=' . $query . '&myncbishare=casccllib'
             ),
             array(
                'vendor' => 'gale',
                'dbname' => 'gale-virtual',
                'noquery' =>  $ezpStr . 'http://infotrac.galegroup.com/itweb?db=GVRL',
                'queryUrl' => $ezpStr . 'http://go.galegroup.com/ps/i.do?dblist=GVRL&st=T003&qt=OQE~' .$query . '&sw=w&ty=bs&it=search&p=GVRL&s=RELEVANCE&u=' . $galeID . '&v=2.1'
             ),
             array(
                'vendor' => 'oxford',
                'dbname' => 'oxford-art',
                'noquery' => $ezpStr . 'http://www.oxfordartonline.com/',
                'queryUrl' => $ezpStr . 'http://www.oxfordartonline.com/groveart/search?siteToSearch=groveart&q=' . $query . '&searchBtn=Search&isQuickSearch=true'
             ),
             array(
                'vendor' => 'oxford',
                'dbname' => 'oxford-english',
                'noquery' =>  $ezpStr . 'http://www.oed.com/',
                'queryUrl' => $ezpStr . 'http://www.oed.com/search?searchType=dictionary&q=' . $query
             ),
             array(
                'vendor' => 'infobase',
                'dbname' => 'films',
                'noquery' =>  $ezpStr . 'http://digital.films.com/PortalPlaylists.aspx?wid=' .$fodWid,
                'queryUrl' => $ezpStr . 'http://digital.films.com/PortalPlaylists.aspx?wid=' .$fodWid .'&rd=a&q=' . $query
             ),
             array(
                'vendor' => 'proquest',
                'dbname' => 'resources',
                'noquery' =>  $ezpStr . 'http://www.rclweb.net',
                'queryUrl' => $ezpStr . 'http://www.rclweb.net/Search/Results?q=rcl-searchall%3A[' . $query . ']&op=1&qs=1'
             ),
             array(
                'vendor' => 'salem',
                'dbname' => 'salem',
                'noquery' =>  $ezpStr . 'http://online.salempress.com/home.do',
                'queryUrl' => $ezpStr . 'http://online.salempress.com/search.do?categoryName=&All=All&numCategories=5&searchInAll=all&searchText=' . $query
             ),
			array(
                'vendor' => 'sage',
                'dbname' => 'sage',
                'noquery' =>  $ezpStr . 'http://journals.sagepub.com/',
                'queryUrl' => $ezpStr . 'http://journals.sagepub.com/action/doSearch?AllField=' . $query
             ),
			array(
				  'vendor' => 'ovid',
				  'dbname' => 'ovid',
				  'noquery' => $ezpStr . 'http://ovidsp.ovid.com/ovidweb.cgi?T=JS&CSC=y&PAGE=main&NEWS=n&DBC=n&D=yrovft',
				  'queryUrl' => $ezpStr . 'http://ovidsp.ovid.com/ovidweb.cgi?T=JS&CSC=y&PAGE=main&NEWS=n&DBC=n&D=yrovft&SEARCH=' . $query
				  ),
			
             array(
                'vendor' => 'naxos',
                'dbname' => 'naxos',
                'noquery' =>  $ezpStr . 'http://losrios.naxosmusiclibrary.com',
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